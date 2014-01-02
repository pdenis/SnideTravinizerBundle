<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Tests\Helper;

use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class TravisLoaderTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class GithubHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GithubHelper
     */
    protected $object;
    /**
     * @var Repo
     */
    protected $repo;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new GithubHelper();
        $this->repo = new Repo();
        $this->repo->setSlug('pdenis/monitoring');
    }

    /**
     * Test get raw file
     */
    public function testRawFileUrl()
    {
        $this->assertEquals(
            'https://raw.github.com/pdenis/monitoring/master/composer.json',
            $this->object->getRawFileUrl($this->repo->getSlug(), 'master', 'composer.json')
        );
    }

}