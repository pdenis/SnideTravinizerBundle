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
use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;
use Snide\Bundle\TravinizerBundle\Loader\ComposerLoader;
use Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoader;
use Snide\Bundle\TravinizerBundle\Loader\TravisLoader;
use Snide\Bundle\TravinizerBundle\Loader\VersionEyeLoader;
use Snide\Bundle\TravinizerBundle\Manager\CacheManager;
use Snide\Bundle\TravinizerBundle\Manager\RepoManager;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Bundle\TravinizerBundle\Reader\ComposerReader;
use Snide\Bundle\TravinizerBundle\Repository\Yaml\RepoRepository;
use Snide\Scrutinizer\Client as ScClient;
use Snide\Travis\Client as TravisClient;

/**
 * Class RepoManagerTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
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
    protected $composerReader;
    protected $versionEyeLoader;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->filename = '/tmp/filename.yml';
        $this->class = 'Snide\\Bundle\\TravinizerBundle\\Model\\Repo';
        $this->repository = new RepoRepository($this->class, $this->filename);
        $this->travisLoader = new TravisLoader(new TravisClient(), new CacheManager(new ArrayCache()));
        $this->scrutinizerLoader = new ScrutinizerLoader(new ScClient(), new CacheManager(new ArrayCache()));
        $this->composerReader = new ComposerReader(new CacheManager(new ArrayCache()), new GithubHelper());
        $this->versionEyeLoader = new VersionEyeLoader(new ComposerLoader(new GithubHelper()), new \Snide\VersionEye\Client());
        $this->object = new RepoManager($this->repository, $this->class, $this->travisLoader, $this->scrutinizerLoader, $this->composerReader, $this->versionEyeLoader);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
    }

    public function testConstruct()
    {
        $this->object = new RepoManager($this->repository, $this->class, $this->travisLoader, $this->scrutinizerLoader, $this->composerReader, $this->versionEyeLoader);
        $this->assertEquals($this->repository, $this->object->getRepository());
        $this->assertInstanceOf($this->class, $this->object->createNew());
    }

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

    public function testLoadPackagistInfos()
    {
        $repo = new Repo();
        $repo->setSlug('pdenis/monitoring');
        $this->object->loadPackagistInfos($repo);
        $this->assertEquals('snide/monitoring', $repo->getPackagistSlug());
        $this->assertEquals(
            array(array('name' => 'Pascal DENIS', 'email' => 'pascal.denis.75@gmail.com')),
            $repo->getAuthors()
        );
    }

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

    public function testFindBySlug()
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

        $this->assertNull($this->object->find('unknown'));
        $repos = $this->object->findAll();

        $this->assertNotNull($this->object->findBySlug($repos[1]->getSlug()));
    }

    public function testIsExists()
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
        $this->assertTrue($this->object->isExists($repo));
        $repo->setSlug('anotherSlug');
        $this->assertFalse($this->object->isExists($repo));
    }

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
