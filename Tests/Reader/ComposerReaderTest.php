<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Tests\Reader;

use Buzz\Browser;
use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Bundle\TravinizerBundle\Reader\ComposerReader;

/**
 * Class ComposerReaderTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class ComposerReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ComposerReader
     */
    protected $object;
    /**
     * @var GithubHelper
     */
    protected $helper;
    /**
     * @var Browser
     */
    protected $browser;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->helper = new GithubHelper();
        $this->browser = new Browser();
        $this->object = new ComposerReader($this->browser, $this->helper);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testLoad()
    {
        $repo = new Repo();
        $repo->setSlug('pdenis/monitoring');
        $this->object->load($repo->getSlug());
        $this->assertEquals('snide/monitoring', $this->object->get('name'));
        $this->assertTrue($this->object->has('name'));
        try {
            $this->object->get('unknown');
            $this->fail('Unknown key');
        }catch(\Exception $e) {

        }

        $repo->setSlug('pdenis/unknown');

        try {
            $this->object->load($repo->getSlug());
            $this->fail('Repository is unknown');
        }catch(\Exception $e) {
            $this->assertFalse($this->object->has('name'));
            $this->assertInstanceOf('\UnexpectedValueException', $e);
        }
    }

    /**
     * Test helper
     */
    public function testHelper()
    {
        $this->assertEquals($this->helper, $this->object->getHelper());
        $helper = new GithubHelper();
        $this->object->setHelper($helper);
        $this->assertEquals($helper, $this->object->getHelper());
    }

    /**
     * Test browser
     */
    public function testBrowser()
    {
        $this->assertEquals($this->browser, $this->object->getBrowser());
        $helper = new Browser();
        $this->object->setBrowser($helper);
        $this->assertEquals($helper, $this->object->getBrowser());
    }
}