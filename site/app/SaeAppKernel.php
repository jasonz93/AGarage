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
class SaeAppKernel extends AppKernel
{
    public function getCacheDir()
    {
        return 'mysaemc:///var/cache/'.$this->getEnvironment();
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
}

class SaeClassCollectionLoader extends \Symfony\Component\ClassLoader\ClassCollectionLoader
{
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
        $tmpFile = tempnam(dirname($file), basename($file));
        if (false !== @file_put_contents($tmpFile, $content) && @rename($tmpFile, $file)) {

            return;
        }

        throw new \RuntimeException(sprintf('Failed to write cache file "%s".', $file));
    }
}
