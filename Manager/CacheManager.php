<?php


namespace Snide\Bundle\TravinizerBundle\Manager;

use Doctrine\Common\Cache\Cache;
use Guzzle\Cache\DoctrineCacheAdapter;
use Guzzle\Http\Client;
use Guzzle\Plugin\Cache\CachePlugin;
use Guzzle\Plugin\Cache\DefaultCacheStorage;


/**
 * Class CacheManager
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class CacheManager implements CacheManagerInterface
{
    /**
     * @var Cache
     */
    protected $cache;

    /**
     * Constructor
     *
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Get cache
     *
     * @return Cache
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Set cache
     *
     * @param Cache $cache
     */
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Create cache plugin
     *
     * @return CachePlugin
     */
    public function createCachePlugin()
    {
        return new CachePlugin(array(
            'storage' => new DefaultCacheStorage(
                new DoctrineCacheAdapter(
                    $this->cache
                )
            )
        ));
    }
}
