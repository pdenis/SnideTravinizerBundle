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

use Snide\Bundle\TravinizerBundle\Helper\PackagistHelper;
use Snide\Bundle\TravinizerBundle\Helper\TravisHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class TravisExtensionTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class PackagistExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Snide\Bundle\TravinizerBundle\Twig\Extension\PackagistExtension
     */
    protected $object;

    /**
     * @var \Snide\Bundle\TravinizerBundle\Model\Repo
     */
    protected $repo;

    /**
     * @var PackagistHelper
     */
    protected $helper;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->helper = new PackagistHelper();
        $this->object = new \Snide\Bundle\TravinizerBundle\Twig\Extension\PackagistExtension($this->helper);
        $this->repo = new Repo();
        $this->repo->setPackagistSlug('snide/monitoring');
        $this->repo->setSlug('pdenis/monitoring');
    }

    public function testUrl()
    {
        $this->assertEquals('https://packagist.org/packages/snide/monitoring', $this->object->getUrl($this->repo));
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\TravisExtension::getName
     */
    public function testName()
    {
        $this->assertEquals('snide_travinizer_packagist', $this->object->getName());
    }


    public function testFunctions()
    {
        $this->assertEquals(array('snide_travinizer_packagist_url'), array_keys($this->object->getFunctions()));
    }

    /**
     * Test helper
     */
    public function testHelper()
    {
        $this->assertEquals($this->helper, $this->object->getHelper());
        $helper = new PackagistHelper();
        $this->object->setHelper($helper);
        $this->assertEquals($helper, $this->object->getHelper());
    }
}