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

use Snide\Bundle\TravinizerBundle\Loader\TravisLoader;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Travis\Client;

/**
 * Class TravisLoaderTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class TravisLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TravisLoader
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {

    }

    /**
     * @covers Snide\Bundle\TravinizerBundle\Loader\TravisLoader::__construct
     * @covers Snide\Bundle\TravinizerBundle\Loader\TravisLoader::load
     */
    public function testLoad()
    {
        $this->object = new TravisLoader(new Client());
        $repo = new Repo();
        $repo->setSlug('pdenis/monitoring');
        $this->object->load($repo);
        $this->assertTrue(count($repo->getBuilds()) > 0);
        $this->assertNotNull($repo->getDescription());
        $this->assertNotNull($repo->getLastBuildDuration());
        $this->assertNotNull($repo->getLastBuildId());
     
        $repo = new Repo();
        $repo->setSlug('pdenis/unknown');
        try {
            $this->object->load($repo);
        }catch(\Exception $e) {

        }

        $this->assertNull($repo->getDescription());
        $this->assertNull($repo->getLastBuildDuration());
        $this->assertNull($repo->getLastBuildId());
        $this->assertNull($repo->getLastBuildState());
    }

}