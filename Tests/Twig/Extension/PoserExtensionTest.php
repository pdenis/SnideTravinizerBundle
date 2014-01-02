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

use Snide\Bundle\TravinizerBundle\Helper\PoserHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class PoserExtensionTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class PoserExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Snide\Bundle\TravinizerBundle\Twig\Extension\PoserExtension
     */
    protected $object;

    /**
     * @var \Snide\Bundle\TravinizerBundle\Model\Repo
     */
    protected $repo;
    /**
     * @var PoserHelper
     */
    protected $helper;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->helper = new PoserHelper();
        $this->object = new \Snide\Bundle\TravinizerBundle\Twig\Extension\PoserExtension($this->helper);
        $this->repo = new Repo();
        $this->repo->setSlug('pdenis/monitoring');
        $this->repo->setPackagistSlug('snide/monitoring');
        $this->repo->setType('g');
        $this->repo->setCoverageBadgeHash('48847d533c0c42fc3c288d54d946a58951360ca7');
        $this->repo->setQualityBadgeHash('571f31ce1079abf2d200c2fffb4320b244be8533');
    }

    public function testStableBadge()
    {
        $this->assertEquals('<img src="https://poser.pugx.org/snide/monitoring/v/stable.png" />', $this->object->getStableBadge($this->repo));
        $this->repo->setPackagistSlug(null);
        $this->assertEquals('', $this->object->getStableBadge($this->repo));

    }

    public function testUnstableBadge()
    {
        $this->assertEquals('<img src="https://poser.pugx.org/snide/monitoring/v/unstable.png" />', $this->object->getUnstableBadge($this->repo));
        $this->repo->setPackagistSlug(null);
        $this->assertEquals('', $this->object->getUnstableBadge($this->repo));

    }

    public function testDownloadBadge()
    {
        $this->assertEquals('<img src="https://poser.pugx.org/snide/monitoring/downloads.png" />', $this->object->getDownloadBadge($this->repo));
        $this->repo->setPackagistSlug(null);
        $this->assertEquals('', $this->object->getDownloadBadge($this->repo));

    }

    public function testMonthlyDownloadBadge()
    {
        $this->assertEquals('<img src="https://poser.pugx.org/snide/monitoring/d/monthly.png" />', $this->object->getMonthlyDownloadBadge($this->repo));
        $this->repo->setPackagistSlug(null);
        $this->assertEquals('', $this->object->getMonthlyDownloadBadge($this->repo));

    }

    public function testDailyDownloadBadge()
    {
        $this->assertEquals('<img src="https://poser.pugx.org/snide/monitoring/d/daily.png" />', $this->object->getDailyDownloadBadge($this->repo));
        $this->repo->setPackagistSlug(null);
        $this->assertEquals('', $this->object->getDailyDownloadBadge($this->repo));

    }
    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\ScrutinizerExtension::getName
     */
    public function testName()
    {
        $this->assertEquals('snide_travinizer_poser', $this->object->getName());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getFunctions
     */
    public function testFunctions()
    {
        $this->assertEquals(
            array(
                'snide_travinizer_poser_stable_badge',
                'snide_travinizer_poser_unstable_badge',
                'snide_travinizer_poser_download_badge',
                'snide_travinizer_poser_monthly_download_badge',
                'snide_travinizer_poser_daily_download_badge'
            ), array_keys($this->object->getFunctions()));
    }

    /**
     * Test helper
     */
    public function testHelper()
    {
        $this->assertEquals($this->helper, $this->object->getHelper());
        $helper = new PoserHelper();
        $this->object->setHelper($helper);
        $this->assertEquals($helper, $this->object->getHelper());
    }
}