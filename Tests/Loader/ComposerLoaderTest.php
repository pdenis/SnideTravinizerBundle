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
use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;
use Snide\Bundle\TravinizerBundle\Loader\ComposerLoader;
use Snide\Bundle\TravinizerBundle\Manager\CacheManager;
use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class ComposerLoaderTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class ComposerLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ComposerLoader
     */
    protected $object;

    /**
     * @var string
     */
    protected $file;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ComposerLoader(new GithubHelper());
    }

    protected function tearDown()
    {
        if (file_exists($this->file)) {
            unlink($this->file);
        }
    }


    public function testGetFile()
    {
        $repo = new Repo();
        $repo->setSlug('pdenis/memetor');
        $this->file = $this->object->getFile($repo);
        $this->assertTrue(file_exists($this->file));
        $data = json_decode(file_get_contents($this->file), true);
        $this->assertEquals('snide/memetor', $data['name']);
    }

}