<?php

namespace Snide\Bundle\TravinizerBundle\Tests\Loader;

use Snide\Bundle\TravinizerBundle\Loader\TravisLoader;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Travis\Client;

/**
 * Class TravisLoaderTest
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
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
        $this->assertTrue($repo->getBuilds()->count() > 0);
        $this->assertNotNull($repo->getDescription());
        $this->assertNotNull($repo->getLastBuildDuration());
        $this->assertNotNull($repo->getLastBuildId());
        $this->assertNotNull($repo->getLastBuildStatus());

        $repo = new Repo();
        $repo->setSlug('pdenis/unknown');
        $this->object->load($repo);
        $this->assertTrue($repo->getBuilds()->count() == 0);
        $this->assertNull($repo->getDescription());
        $this->assertNull($repo->getLastBuildDuration());
        $this->assertNull($repo->getLastBuildId());
        $this->assertNull($repo->getLastBuildStatus());
    }

}