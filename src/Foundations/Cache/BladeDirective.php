<?php

namespace Orbitali\Foundations\Cache;

use Exception;

class BladeDirective
{
    /**
     * The cache instance.
     *
     * @var RussianCaching
     */
    protected $cache;
    /**
     * A list of model cache keys.
     *
     * @param array $keys
     */
    protected $keys = [];

    /**
     * Create a new instance.
     *
     * @param RussianCaching $cache
     */
    public function __construct(RussianCaching $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Handle the @cache setup.
     *
     * @param mixed $model
     * @param string|null $key
     */
    public function setUp($model, $key = null): bool
    {
        ob_start();
        $this->keys[] = $key = $this->normalizeKey($model, $key);
        return $this->cache->has($key);
    }

    /**
     * Handle the @endcache teardown.
     */
    public function tearDown(): string
    {
        return $this->cache->put(array_pop($this->keys), ob_get_clean());
    }

    /**
     * Normalize the cache key.
     *
     * @param mixed $item
     * @param string|null $key
     */
    protected function normalizeKey($item, $key = null): string
    {
        $name = null;
        // If the user wants to provide their own cache
        // key, we'll opt for that.
        if (is_string($item) || is_string($key)) {
            $name = is_string($item) ? $item : $key;
        } else if (is_object($item) && method_exists($item, 'getCacheKey')) {
            // Otherwise we'll try to use the item to calculate
            // the cache key, itself.
            $name = $item->getCacheKey();
        } else if ($item instanceof \Illuminate\Support\Collection) {
            // If we're dealing with a collection, we'll
            // use a hashed version of its contents.
            $name = md5($item);
        }

        if ($name != null) {
            return "orbitali.cache.views." . $name;
        }
        throw new Exception('Could not determine an appropriate cache key.');
    }
}
