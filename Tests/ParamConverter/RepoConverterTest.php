<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Tests\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Snide\Bundle\TravinizerBundle\ParamConverter\RepoConverter;
use Buzz\Browser;
use Doctrine\Common\Cache\ArrayCache;
use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;
use Snide\Bundle\TravinizerBundle\Loader\ComposerLoader;
use Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoader;
use Snide\Bundle\TravinizerBundle\Loader\TravisLoader;
use Snide\Bundle\TravinizerBundle\Loader\VersionEyeLoader;
use Snide\Bundle\TravinizerBundle\Manager\CacheManager;
use Snide\Bundle\TravinizerBundle\Manager\RepoManager;
use Snide\Bundle\TravinizerBundle\Reader\ComposerReader;
use Snide\Bundle\TravinizerBundle\Repository\Yaml\RepoRepository;
use Snide\Scrutinizer\Client as ScClient;
use Snide\Travis\Client as TravisClient;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RepoConverterTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class RepoConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RepoConverter
     */
    protected $object;
    protected $class;
    protected $repository;
    protected $travisLoader;
    protected $filename;
    protected $scrutinizerLoader;
    protected $composerReader;
    protected $versionEyeLoader;
    protected $manager;

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
        $this->manager = new RepoManager($this->repository, $this->class, $this->travisLoader, $this->scrutinizerLoader, $this->composerReader, $this->versionEyeLoader);
        $this->object = new RepoConverter($this->manager);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testApply()
    {
        $request = Request::createFromGlobals();
        $name = 'repo';
        $class = 'Snide\Bundle\TravinizerBundle\Entity\Repo';

        $converter = new ParamConverter(
            array('name' => $name, 'class' => $class)
        );

        $this->assertFalse($this->object->apply($request, $converter));
        $this->assertFalse($request->attributes->has('repo'));

        $repo = $this->manager->createNew();
        $repo->setSlug('pdenis/scrutinizer-client');
        $repo->setType('g');
        $this->manager->create($repo);

        $request->attributes->set('id', 1);

        $this->assertTrue($this->object->apply($request, $converter));
        $this->assertNotNull($request->attributes->get('repo'));

        $request->attributes->set('slug', 'pdenis/scrutinizer-client');

        $this->assertTrue($this->object->apply($request, $converter));
        $this->assertNotNull($request->attributes->get('repo'));
    }

    public function testSupport()
    {
        $name = 'repo';
        $class = 'Snide\Bundle\TravinizerBundle\Model\Repo';
        $converter = new ParamConverter(
            array('name' => $name, 'class' => $class)
        );

        $this->assertTrue($this->object->supports($converter));

    }
}
