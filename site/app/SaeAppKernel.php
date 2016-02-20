<?php
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Config\EnvParametersResource;
use Symfony\Component\HttpKernel\DependencyInjection\AddClassesToCachePass;


/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 上午4:10
 */

require_once 'wrapper.php';

class SaeAppKernel extends AppKernel
{
    public function getCacheDir()
    {
        return 'saemc:///var/cache/'.$this->getEnvironment();
    }

    /**
     * Builds the service container.
     *
     * @return ContainerBuilder The compiled service container
     *
     * @throws \RuntimeException
     */
    protected function buildContainer()
    {
        foreach (array('cache' => $this->getCacheDir()) as $name => $dir) {
            if (!is_dir($dir)) {
                if (false === @mkdir($dir, 0777, true) && !is_dir($dir)) {
                    throw new \RuntimeException(sprintf("Unable to create the %s directory (%s)\n", $name, $dir));
                }
            } elseif (!is_writable($dir)) {
                throw new \RuntimeException(sprintf("Unable to write in the %s directory (%s)\n", $name, $dir));
            }
        }

        $container = $this->getContainerBuilder();
        $container->addObjectResource($this);
        $this->prepareContainer($container);

        if (null !== $cont = $this->registerContainerConfiguration($this->getContainerLoader($container))) {
            $container->merge($cont);
        }

        $container->addCompilerPass(new AddClassesToCachePass($this));
        $container->addResource(new EnvParametersResource('SYMFONY__'));

        return $container;
    }

    protected function doLoadClassCache($name, $extension)
    {
        if (!$this->booted && is_file($this->getCacheDir().'/classes.map')) {
            SaeClassCollectionLoader::load(include($this->getCacheDir().'/classes.map'), $this->getCacheDir(), $name, $this->debug, false, $extension);
        }
    }

    public function boot()
    {
        $result = parent::boot();
        $this->getContainer()->setParameter('twig.cache', new TwigSaeMCCache($this->getCacheDir().'/twig'));
        return $result;
    }
}

class TwigSaeMCCache implements Twig_CacheInterface {
    const FORCE_BYTECODE_INVALIDATION = 1;

    private $directory;
    private $options;

    /**
     * @param $directory string The root cache directory
     * @param $options   int    A set of options
     */
    public function __construct($directory, $options = 0)
    {
        $this->directory = rtrim($directory, '\/').'/';
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function generateKey($name, $className)
    {
        $hash = hash('sha256', $className);

        return $this->directory.$hash[0].$hash[1].'/'.$hash.'.php';
    }

    /**
     * {@inheritdoc}
     */
    public function load($key)
    {
        @include_once $key;
    }

    /**
     * {@inheritdoc}
     */
    public function write($key, $content)
    {
        $dir = dirname($key);
        if (!is_dir($dir)) {
            if (false === @mkdir($dir, 0777, true) && !is_dir($dir)) {
                throw new RuntimeException(sprintf('Unable to create the cache directory (%s).', $dir));
            }
        } elseif (!is_writable($dir)) {
            throw new RuntimeException(sprintf('Unable to write in the cache directory (%s).', $dir));
        }

        if (false !== @file_put_contents($key, $content)) {
            @chmod($key, 0666 & ~umask());

            if (self::FORCE_BYTECODE_INVALIDATION == ($this->options & self::FORCE_BYTECODE_INVALIDATION)) {
                // Compile cached file into bytecode cache
                if (function_exists('opcache_invalidate')) {
                    opcache_invalidate($key, true);
                } elseif (function_exists('apc_compile_file')) {
                    apc_compile_file($key);
                }
            }

            return;
        }

        throw new RuntimeException(sprintf('Failed to write cache file "%s".', $key));
    }

    /**
     * {@inheritdoc}
     */
    public function getTimestamp($key)
    {
        if (!file_exists($key)) {
            return 0;
        }

        return (int) @filemtime($key);
    }
}

class SaeClassCollectionLoader
{
    private static $loaded;
    private static $seen;
    private static $useTokenizer = true;

    /**
     * Loads a list of classes and caches them in one big file.
     *
     * @param array  $classes    An array of classes to load
     * @param string $cacheDir   A cache directory
     * @param string $name       The cache name prefix
     * @param bool   $autoReload Whether to flush the cache when the cache is stale or not
     * @param bool   $adaptive   Whether to remove already declared classes or not
     * @param string $extension  File extension of the resulting file
     *
     * @throws \InvalidArgumentException When class can't be loaded
     */
    public static function load($classes, $cacheDir, $name, $autoReload, $adaptive = false, $extension = '.php')
    {
        // each $name can only be loaded once per PHP process
        if (isset(self::$loaded[$name])) {
            return;
        }

        self::$loaded[$name] = true;

        $declared = array_merge(get_declared_classes(), get_declared_interfaces(), get_declared_traits());

        if ($adaptive) {
            // don't include already declared classes
            $classes = array_diff($classes, $declared);

            // the cache is different depending on which classes are already declared
            $name = $name.'-'.substr(hash('sha256', implode('|', $classes)), 0, 5);
        }

        $classes = array_unique($classes);

        $cache = $cacheDir.'/'.$name.$extension;

        // auto-reload
        $reload = false;
        if ($autoReload) {
            $metadata = $cache.'.meta';
            if (!is_file($metadata) || !is_file($cache)) {
                $reload = true;
            } else {
                $time = filemtime($cache);
                $meta = unserialize(file_get_contents($metadata));

                sort($meta[1]);
                sort($classes);

                if ($meta[1] != $classes) {
                    $reload = true;
                } else {
                    foreach ($meta[0] as $resource) {
                        if (!is_file($resource) || filemtime($resource) > $time) {
                            $reload = true;

                            break;
                        }
                    }
                }
            }
        }

        if (!$reload && is_file($cache)) {
            require_once $cache;

            return;
        }

        $files = array();
        $content = '';
        foreach (self::getOrderedClasses($classes) as $class) {
            if (in_array($class->getName(), $declared)) {
                continue;
            }

            $files[] = $class->getFileName();

            $c = preg_replace(array('/^\s*<\?php/', '/\?>\s*$/'), '', file_get_contents($class->getFileName()));

            // fakes namespace declaration for global code
            if (!$class->inNamespace()) {
                $c = "\nnamespace\n{\n".$c."\n}\n";
            }

            $c = self::fixNamespaceDeclarations('<?php '.$c);
            $c = preg_replace('/^\s*<\?php/', '', $c);

            $content .= $c;
        }

        // cache the core classes
        if (!is_dir($cacheDir) && !@mkdir($cacheDir, 0777, true) && !is_dir($cacheDir)) {
            throw new \RuntimeException(sprintf('Class Collection Loader was not able to create directory "%s"', $cacheDir));
        }
        self::writeCacheFile($cache, '<?php '.$content);

        if ($autoReload) {
            // save the resources
            self::writeCacheFile($metadata, serialize(array($files, $classes)));
        }
    }

    /**
     * Adds brackets around each namespace if it's not already the case.
     *
     * @param string $source Namespace string
     *
     * @return string Namespaces with brackets
     */
    public static function fixNamespaceDeclarations($source)
    {
        if (!function_exists('token_get_all') || !self::$useTokenizer) {
            if (preg_match('/(^|\s)namespace(.*?)\s*;/', $source)) {
                $source = preg_replace('/(^|\s)namespace(.*?)\s*;/', "$1namespace$2\n{", $source)."}\n";
            }

            return $source;
        }

        $rawChunk = '';
        $output = '';
        $inNamespace = false;
        $tokens = token_get_all($source);

        for ($i = 0; isset($tokens[$i]); ++$i) {
            $token = $tokens[$i];
            if (!isset($token[1]) || 'b"' === $token) {
                $rawChunk .= $token;
            } elseif (in_array($token[0], array(T_COMMENT, T_DOC_COMMENT))) {
                // strip comments
                continue;
            } elseif (T_NAMESPACE === $token[0]) {
                if ($inNamespace) {
                    $rawChunk .= "}\n";
                }
                $rawChunk .= $token[1];

                // namespace name and whitespaces
                while (isset($tokens[++$i][1]) && in_array($tokens[$i][0], array(T_WHITESPACE, T_NS_SEPARATOR, T_STRING))) {
                    $rawChunk .= $tokens[$i][1];
                }
                if ('{' === $tokens[$i]) {
                    $inNamespace = false;
                    --$i;
                } else {
                    $rawChunk = rtrim($rawChunk)."\n{";
                    $inNamespace = true;
                }
            } elseif (T_START_HEREDOC === $token[0]) {
                $output .= self::compressCode($rawChunk).$token[1];
                do {
                    $token = $tokens[++$i];
                    $output .= isset($token[1]) && 'b"' !== $token ? $token[1] : $token;
                } while ($token[0] !== T_END_HEREDOC);
                $output .= "\n";
                $rawChunk = '';
            } elseif (T_CONSTANT_ENCAPSED_STRING === $token[0]) {
                $output .= self::compressCode($rawChunk).$token[1];
                $rawChunk = '';
            } else {
                $rawChunk .= $token[1];
            }
        }

        if ($inNamespace) {
            $rawChunk .= "}\n";
        }

        $output .= self::compressCode($rawChunk);

        if (PHP_VERSION_ID >= 70000) {
            // PHP 7 memory manager will not release after token_get_all(), see https://bugs.php.net/70098
            unset($tokens, $rawChunk);
            gc_mem_caches();
        }

        return $output;
    }

    /**
     * This method is only useful for testing.
     */
    public static function enableTokenizer($bool)
    {
        self::$useTokenizer = (bool) $bool;
    }

    /**
     * Strips leading & trailing ws, multiple EOL, multiple ws.
     *
     * @param string $code Original PHP code
     *
     * @return string compressed code
     */
    private static function compressCode($code)
    {
        return preg_replace(
            array('/^\s+/m', '/\s+$/m', '/([\n\r]+ *[\n\r]+)+/', '/[ \t]+/'),
            array('', '', "\n", ' '),
            $code
        );
    }

    /**
     * Writes a cache file.
     *
     * @param string $file    Filename
     * @param string $content Temporary file content
     *
     * @throws \RuntimeException when a cache file cannot be written
     */
    private static function writeCacheFile($file, $content)
    {
        if (false !== @file_put_contents($file, $content)) {
            //FIXED: SAE Compat
//            @chmod($file, 0666 & ~umask());

            return;
        }

        throw new \RuntimeException(sprintf('Failed to write cache file "%s".', $file));
    }

    /**
     * Gets an ordered array of passed classes including all their dependencies.
     *
     * @param array $classes
     *
     * @return \ReflectionClass[] An array of sorted \ReflectionClass instances (dependencies added if needed)
     *
     * @throws \InvalidArgumentException When a class can't be loaded
     */
    private static function getOrderedClasses(array $classes)
    {
        $map = array();
        self::$seen = array();
        foreach ($classes as $class) {
            try {
                $reflectionClass = new \ReflectionClass($class);
            } catch (\ReflectionException $e) {
                throw new \InvalidArgumentException(sprintf('Unable to load class "%s"', $class));
            }

            $map = array_merge($map, self::getClassHierarchy($reflectionClass));
        }

        return $map;
    }

    private static function getClassHierarchy(\ReflectionClass $class)
    {
        if (isset(self::$seen[$class->getName()])) {
            return array();
        }

        self::$seen[$class->getName()] = true;

        $classes = array($class);
        $parent = $class;
        while (($parent = $parent->getParentClass()) && $parent->isUserDefined() && !isset(self::$seen[$parent->getName()])) {
            self::$seen[$parent->getName()] = true;

            array_unshift($classes, $parent);
        }

        $traits = array();

        foreach ($classes as $c) {
            foreach (self::resolveDependencies(self::computeTraitDeps($c), $c) as $trait) {
                if ($trait !== $c) {
                    $traits[] = $trait;
                }
            }
        }

        return array_merge(self::getInterfaces($class), $traits, $classes);
    }

    private static function getInterfaces(\ReflectionClass $class)
    {
        $classes = array();

        foreach ($class->getInterfaces() as $interface) {
            $classes = array_merge($classes, self::getInterfaces($interface));
        }

        if ($class->isUserDefined() && $class->isInterface() && !isset(self::$seen[$class->getName()])) {
            self::$seen[$class->getName()] = true;

            $classes[] = $class;
        }

        return $classes;
    }

    private static function computeTraitDeps(\ReflectionClass $class)
    {
        $traits = $class->getTraits();
        $deps = array($class->getName() => $traits);
        while ($trait = array_pop($traits)) {
            if ($trait->isUserDefined() && !isset(self::$seen[$trait->getName()])) {
                self::$seen[$trait->getName()] = true;
                $traitDeps = $trait->getTraits();
                $deps[$trait->getName()] = $traitDeps;
                $traits = array_merge($traits, $traitDeps);
            }
        }

        return $deps;
    }

    /**
     * Dependencies resolution.
     *
     * This function does not check for circular dependencies as it should never
     * occur with PHP traits.
     *
     * @param array            $tree       The dependency tree
     * @param \ReflectionClass $node       The node
     * @param \ArrayObject     $resolved   An array of already resolved dependencies
     * @param \ArrayObject     $unresolved An array of dependencies to be resolved
     *
     * @return \ArrayObject The dependencies for the given node
     *
     * @throws \RuntimeException if a circular dependency is detected
     */
    private static function resolveDependencies(array $tree, $node, \ArrayObject $resolved = null, \ArrayObject $unresolved = null)
    {
        if (null === $resolved) {
            $resolved = new \ArrayObject();
        }
        if (null === $unresolved) {
            $unresolved = new \ArrayObject();
        }
        $nodeName = $node->getName();

        if (isset($tree[$nodeName])) {
            $unresolved[$nodeName] = $node;
            foreach ($tree[$nodeName] as $dependency) {
                if (!$resolved->offsetExists($dependency->getName())) {
                    self::resolveDependencies($tree, $dependency, $resolved, $unresolved);
                }
            }
            $resolved[$nodeName] = $node;
            unset($unresolved[$nodeName]);
        }

        return $resolved;
    }
}