<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Tests\Twig\Extension;

use Snide\Bundle\TravinizerBundle\Helper\TravisHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class TravisExtensionTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class TravisExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Snide\Bundle\TravinizerBundle\Twig\Extension\TravisExtension
     */
    protected $object;

    /**
     * @var \Snide\Bundle\TravinizerBundle\Model\Repo
     */
    protected $repo;

    /**
     * @var TravisHelper
     */
    protected $helper;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->helper = new TravisHelper();
        $this->object = new \Snide\Bundle\TravinizerBundle\Twig\Extension\TravisExtension($this->helper);
        $this->repo = new Repo();
        $this->repo->setSlug('pdenis/monitoring');
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\TravisExtension::getUrl
     */
    public function testUrl()
    {
        $this->assertEquals('https://travis-ci.org/pdenis/monitoring', $this->object->getUrl($this->repo));
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\TravisExtension::getBadge
     */
    public function testBadge()
    {

        $this->assertEquals(
            '<img src="https://travis-ci.org/pdenis/monitoring.png?branch=master" />',
            $this->object->getBadge($this->repo)
        );
    }


    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\TravisExtension::getName
     */
    public function testName()
    {
        $this->assertEquals('snide_travinizer_travis', $this->object->getName());
    }


    public function testFunctions()
    {
        $this->assertEquals(
            array('snide_travinizer_travis_url', 'snide_travinizer_travis_badge'),
            array_keys($this->object->getFunctions())
        );
    }

    /**
     * Test helper
     */
    public function testHelper()
    {
        $this->assertEquals($this->helper, $this->object->getHelper());
        $helper = new TravisHelper();
        $this->object->setHelper($helper);
        $this->assertEquals($helper, $this->object->getHelper());
    }
}