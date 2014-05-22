<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Tests\Repository\Yaml;

use Snide\Bundle\TravinizerBundle\Repository\Yaml\RepoRepository;

/**
 * Class RepoRepositoryTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class RepoRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ApplicationRepository
     */
    protected $object;
    /**
     * Filename
     *
     * @var string
     */
    protected $filename;

    /**
     * Class
     *
     * @var string
     */
    protected $class;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->filename = '/tmp/filename.yml';
        $this->class = 'Snide\\Bundle\\TravinizerBundle\\Model\\Repo';

        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
        $this->object = new RepoRepository($this->class, $this->filename);
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
        $this->assertTrue(file_exists($this->filename));
        $this->assertInstanceOf($this->class, $this->object->createNew());

    }


    public function testFindAll()
    {
        $this->assertEquals(array(), $this->object->findAll());
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/monitoring');
        $repo->setType('g');
        $this->object->create($repo);
        $repo->setId(1);
        $repoTwo = $this->object->createNew();
        $repoTwo->setSlug('pdenis/scrutinizer-client');
        $repoTwo->setType('g');
        $this->object->create($repoTwo);
        $repoTwo->setId(2);
        $this->assertEquals(array($repo, $repoTwo), $this->object->findAll());
    }

    public function testFindBy()
    {
        $this->assertEquals($this->object->findAll(), $this->object->findBy());
    }

    public function testFind()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/monitoring');
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

        $this->assertEquals($repos[1], $this->object->find($repos[1]->getId()));
    }

    public function testFindBySlug()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/monitoring');
        $repo->setType('g');
        $this->object->create($repo);
        $repo->setId(1);
        $repoTwo = $this->object->createNew();
        $repoTwo->setSlug('pdenis/scrutinizer-client');
        $repoTwo->setType('g');
        $this->object->create($repoTwo);
        $repoTwo->setId(2);

        $this->assertNull($this->object->findBySlug('unknown'));
        $repos = $this->object->findAll();

        $this->assertEquals($repos[1], $this->object->findBySlug($repos[1]->getSlug()));
        $this->assertEquals($repos[0], $this->object->findBySlug($repos[0]->getSlug()));
    }

    public function testCreate()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/TravinizerBundle');
        $repo->setType('g');

        $repos = $this->object->findAll();
        $repo->setId(sizeof($repos) + 1);
        $repos[] = $repo;
        $this->object->create($repo);

        $this->assertEquals($repos, $this->object->findAll());

    }

    public function testDelete()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/monitoring');
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
        $this->assertEquals(array_values($repos), $this->object->findAll());
    }

    public function testUpdate()
    {
        $repo = $this->object->createNew();
        $repo->setSlug('pdenis/monitoring');
        $repo->setType('g');
        $this->object->create($repo);
        $repo = $this->object->find(1);
        $this->assertEquals('pdenis/monitoring', $repo->getSlug());
        $repo->setSlug('pdenis/zibase-lib');
        $this->object->update($repo);
        $repo = $this->object->find(1);
        $this->assertEquals('pdenis/zibase-lib', $repo->getSlug());

    }

}