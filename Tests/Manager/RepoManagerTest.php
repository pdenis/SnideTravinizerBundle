<?php

namespace Snide\Bundle\TravinizerBundle\Tests\Manager\RepoManagerTest;

use Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoader;
use Snide\Bundle\TravinizerBundle\Loader\TravisLoader;
use Snide\Bundle\TravinizerBundle\Manager\RepoManager;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Bundle\TravinizerBundle\Repository\Yaml\RepoRepository;
use Travis\Client as TravisClient;
use Snide\Scrutinizer\Client as ScClient;

/**
 * Class RepoManagerTest
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class RepoManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RepoManager
     */
    protected $object;

    protected $class;
    protected $repository;
    protected $travisLoader;
    protected $filename;
    protected $scrutinizerLoader;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->filename = '/tmp/filename.yml';
        $this->class = 'Snide\\Bundle\\TravinizerBundle\\Model\\Repo';
        $this->repository = new RepoRepository($this->class, $this->filename);
        $this->travisLoader = new TravisLoader(new TravisClient());
        $this->scrutinizerLoader = new ScrutinizerLoader(new ScClient());
        $this->object = new RepoManager($this->repository, $this->class, $this->travisLoader, $this->scrutinizerLoader);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        if(file_exists($this->filename)) {
            unlink($this->filename);
        }
    }


    /**
     * @covers Snide\Bundle\TravinizerBundle\Manager\RepoManager::__construct
     * @covers Snide\Bundle\TravinizerBundle\Manager\RepoManager::createNew
     * @covers Snide\Bundle\TravinizerBundle\Manager\RepoManager::getRepository
     */
    public function testConstruct()
    {
        $this->object = new RepoManager($this->repository, $this->class, $this->travisLoader, $this->scrutinizerLoader);
        $this->assertEquals($this->repository, $this->object->getRepository());
        $this->assertInstanceOf($this->class, $this->object->createNew());

    }

    /**
     * @covers Snide\Bundle\TravinizerBundle\Manager\RepoManager::create
     */
    public function testCreate()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/monitoring');
        $repo->setType('g/3');

        $repos = $this->object->findAll();
        $repo->setId(sizeof($repos) + 1);
        $repos[] = $repo;
        $this->object->create($repo);

        $this->assertEquals(sizeof($repos), sizeof($this->object->findAll()));
    }

    /**
     * @covers Snide\Bundle\TravinizerBundle\Manager\RepoManager::delete
     */
    public function testDelete()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/scrutinizer-client');
        $repo->setType('g');
        $this->object->create($repo);
        $repo->setId(1);
        $repoTwo = $this->object->createNew();
        $repoTwo->setSlug('pdenis/scrutinizer-client');
        $repoTwo->setType('g');
        $this->object->create($repoTwo);
        $repoTwo->setId(2);

        $repos = $this->object->findAll();

        $this->object->delete($repos[0]);
        unset($repos[0]);
        $this->assertEquals(sizeof($repos), sizeof($this->object->findAll()));
    }

    /**
     * @covers Snide\Bundle\TravinizerBundle\Manager\RepoManager::find
     */
    public function testFind()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/scrutinizer-client');
        $repo->setType('g');
        $this->object->create($repo);
        $repo->setId(1);
        $repoTwo = $this->object->createNew();
        $repoTwo->setSlug('pdenis/scrutinizer-client');
        $repoTwo->setType('g');
        $this->object->create($repoTwo);
        $repoTwo->setId(2);

        $this->assertNull($this->object->find(-1));
        $repos = $this->object->findAll();

        $this->assertNotNull($this->object->find($repos[1]->getId()));
    }

    /**
     * @covers Snide\Bundle\TravinizerBundle\Manager\RepoManager::findAll
     */
    public function testFindAll()
    {
        $this->assertEquals(array(), $this->object->findAll());
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/scrutinizer-client');
        $repo->setType('g');
        $this->object->create($repo);
        $repo->setId(1);
        $repoTwo = $this->object->createNew();
        $repoTwo->setSlug('pdenis/scrutinizer-client');
        $repoTwo->setType('g');
        $this->object->create($repoTwo);
        $repoTwo->setId(2);
        $this->assertEquals(sizeof(array($repo, $repoTwo)), sizeof($this->object->findAll()));
    }

    /**
     * @covers Snide\Bundle\TravinizerBundle\Manager\RepoManager::update
     */
    public function testUpdate()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/scrutinizer-client');
        $repo->setType('g');
        $this->object->create($repo);
        $repo = $this->object->find(1);
        $this->assertEquals('pdenis/scrutinizer-client', $repo->getSlug());
        $repo->setSlug('pdenis/monitoring');
        $this->object->update($repo);
        $repo = $this->object->find(1);
        $this->assertEquals('pdenis/monitoring', $repo->getSlug());
    }

    /**
     * @covers Snide\Bundle\TravinizerBundle\Manager\RepoManager::loadExtraInfos
     */
    public function testLoadExtraInfos()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/scrutinizer-client');
        $repo->setType('g');
        $this->object->loadExtraInfos($repo);
        $this->assertNotNull($repo->getBuilds());
        $this->assertNotNull($repo->getMetrics());
        $this->assertNotNull($repo->getDescription());

    }
}