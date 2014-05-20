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
use Snide\Bundle\TravinizerBundle\Entity\Repo;
use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;
use Snide\Bundle\TravinizerBundle\Loader\ComposerLoader;
use Snide\Bundle\TravinizerBundle\Loader\VersionEyeLoader;
use Snide\VersionEye\Client;

/**
 * Class VersionEyeLoaderTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class VersionEyeLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VersionEyeLoader
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new VersionEyeLoader(new ComposerLoader(new GithubHelper()), new Client());
    }

    public function testLoad()
    {
        $repo = new Repo();
        $repo->setSlug('snide/memetor');
        try {
            $this->object->load('snide/memetor');
            $this->fail('Version eye must fail because no key provided');
        } catch (\Exception $e) {

        }
    }

}