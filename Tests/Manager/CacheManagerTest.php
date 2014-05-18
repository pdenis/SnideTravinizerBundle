<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Tests\Manager;

use Buzz\Browser;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\PhpFileCache;
use Snide\Bundle\TravinizerBundle\Manager\CacheManager;
use Snide\Travis\Client as TravisClient;
use Snide\Scrutinizer\Client as ScClient;

/**
 * Class CacheManagerTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class CacheManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CacheManager
     */
    protected $object;

    /**
     * @var Cache
     */
    protected $cache;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->cache = new ArrayCache();
        $this->object = new CacheManager($this->cache);
    }

    public function testConstruct()
    {
        $this->assertEquals($this->cache, $this->object->getCache());
    }

    public function testCache()
    {
        $cache = new PhpFileCache('/tmp');
        $this->object->setCache($cache);
        $this->assertEquals($cache, $this->object->getCache());
    }
}