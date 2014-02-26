<?php

namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Manager\CacheManagerInterface;

/**
 * Class AbstractLoader
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
abstract class AbstractLoader
{
    /**
     * @var CacheManagerInterface
     */
    protected $cacheManager;

    /**
     * Constructor
     *
     * @param CacheManagerInterface $cacheManager
     */
    public function __construct(CacheManagerInterface $cacheManager)
    {
        $this->cacheManager = $cacheManager;
        $this->loadCache();
    }

    /**
     * Get cache manager
     *
     * @return CacheManagerInterface
     */
    public function getCacheManager()
    {
        return $this->cacheManager;
    }

    /**
     * Set cache maanager
     *
     * @param CacheManagerInterface $cacheManager
     */
    public function setCacheManager(CacheManagerInterface $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    /**
     * Load cache
     *
     * @return void
     */
    abstract public function loadCache();
}