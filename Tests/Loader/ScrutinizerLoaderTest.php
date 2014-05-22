<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Tests\Loader;

use Doctrine\Common\Cache\ArrayCache;
use Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoader;
use Snide\Bundle\TravinizerBundle\Manager\CacheManager;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Scrutinizer\Client;

/**
 * Class ScrutinizerLoaderTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class ScrutinizerLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ScrutinizerLoader
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ScrutinizerLoader(new Client(), new CacheManager(new ArrayCache()));
    }

    /**
     * @covers Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoader::__construct
     * @covers Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoader::load
     */
    public function testLoad()
    {

        $repo = new Repo();
        $repo->setType('g');
        $repo->setSlug('pdenis/monitoring');
        $this->object->load($repo);

        $this->assertNotNull($repo->getMetrics());
        $this->assertNotNull($repo->getPdependMetrics());

        $repo = new Repo();
        $repo->setType('g');
        $repo->setSlug('pdenis/unknown');
        try {
            $this->object->load($repo);
        } catch (\Exception $e) {

        }
        $this->assertNull($repo->getMetrics());
        $this->assertNull($repo->getPdependMetrics());
    }

    public function testCacheManager()
    {
        $cacheManager = new CacheManager(new ArrayCache());
        $this->object->setCacheManager($cacheManager);
        $this->assertEquals($cacheManager, $this->object->getCacheManager());
    }
}