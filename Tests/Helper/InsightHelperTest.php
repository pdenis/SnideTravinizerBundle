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

use Snide\Bundle\TravinizerBundle\Helper\InsightHelper;

/**
 * Class TravisLoaderTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class InsightHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InsightHelper
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new InsightHelper();
    }

    public function testGetUrl()
    {
        $url = 'https://insight.sensiolabs.com/projects/aSimpleHash';
        $this->assertEquals($url, $this->object->getUrl('aSimpleHash'));
    }

    public function testGetBadgeUrl()
    {
        $url = 'https://insight.sensiolabs.com/projects/aSimpleHash/mini.png';
        $this->assertEquals($url, $this->object->getBadgeUrl('aSimpleHash', 'mini'));
    }
}