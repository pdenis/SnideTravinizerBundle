<?php

namespace Snide\Bundle\TravinizerBundle\Manager;

use Guzzle\Http\Client;
use Guzzle\Plugin\Cache\CachePlugin;

/**
 * Interface CacheManagerInterface
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
interface CacheManagerInterface
{
    /**
     * Create cache plugin
     *
     * @return CachePlugin
     */
    public function createCachePlugin();
}
