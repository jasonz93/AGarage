<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午5:04
 */

namespace AGarage\Extensions;


use Illuminate\Contracts\Cache\Store;

class SaeKVCacheStore implements Store
{
    private $kv;
    private $prefix;

    public function __construct($prefix)
    {
        $this->kv = new SaeKV();
        $this->kv->init();
        $this->prefix = $prefix;
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string|array $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->kv->get($key);
    }

    /**
     * Retrieve multiple items from the cache by key.
     *
     * Items not found in the cache will have a null value.
     *
     * @param  array $keys
     * @return array
     */
    public function many(array $keys)
    {
        return $this->kv->mget($keys);
    }

    /**
     * Store an item in the cache for a given number of minutes.
     *
     * @param  string $key
     * @param  mixed $value
     * @param  int $minutes
     * @return void
     */
    public function put($key, $value, $minutes)
    {
        $this->kv->set($key, $value);
    }

    /**
     * Store multiple items in the cache for a given number of minutes.
     *
     * @param  array $values
     * @param  int $minutes
     * @return void
     */
    public function putMany(array $values, $minutes)
    {
        foreach ($values as $key =>$value) {
            $this->kv->set($key, $value);
        }
    }

    /**
     * Increment the value of an item in the cache.
     *
     * @param  string $key
     * @param  mixed $value
     * @return int|bool
     */
    public function increment($key, $value = 1)
    {
        // TODO: Implement increment() method.
    }

    /**
     * Decrement the value of an item in the cache.
     *
     * @param  string $key
     * @param  mixed $value
     * @return int|bool
     */
    public function decrement($key, $value = 1)
    {
        // TODO: Implement decrement() method.
    }

    /**
     * Store an item in the cache indefinitely.
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function forever($key, $value)
    {
        $this->kv->set($key, $value);
    }

    /**
     * Remove an item from the cache.
     *
     * @param  string $key
     * @return bool
     */
    public function forget($key)
    {
        $this->kv->delete($key);
    }

    /**
     * Remove all items from the cache.
     *
     * @return void
     */
    public function flush()
    {
        // TODO: Implement flush() method.
    }

    /**
     * Get the cache key prefix.
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }
}