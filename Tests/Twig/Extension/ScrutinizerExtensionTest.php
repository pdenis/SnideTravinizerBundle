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

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class ScrutinizerExtensionTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class ScrutinizerExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Snide\Bundle\TravinizerBundle\Twig\Extension\ScrutinizerExtension
     */
    protected $object;

    /**
     * @var \Snide\Bundle\TravinizerBundle\Model\Repo
     */
    protected $repo;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \Snide\Bundle\TravinizerBundle\Twig\Extension\ScrutinizerExtension();
        $this->repo = new Repo();
        $this->repo->setSlug('pdenis/monitoring');
        $this->repo->setType('g');
        $this->repo->setCoverageBadgeHash('48847d533c0c42fc3c288d54d946a58951360ca7');
        $this->repo->setQualityBadgeHash('571f31ce1079abf2d200c2fffb4320b244be8533');
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\ScrutinizerExtension::getUrl
     */
    public function testUrl()
    {
        $this->assertEquals('https://scrutinizer-ci.com/g/pdenis/monitoring', $this->object->getUrl($this->repo));
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\ScrutinizerExtension::getQualityBadge
     */
    public function testQualityBadge()
    {

        $this->assertEquals('<img src="https://scrutinizer-ci.com/g/pdenis/monitoring/badges/quality-score.png?s=571f31ce1079abf2d200c2fffb4320b244be8533" />', $this->object->getQualityBadge($this->repo));
        $this->repo->setQualityBadgeHash(null);
        $this->assertEquals('', $this->object->getQualityBadge($this->repo));

    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\ScrutinizerExtension::getCoverageBadge
     */
    public function testCoverageBadge()
    {

        $this->assertEquals('<img src="https://scrutinizer-ci.com/g/pdenis/monitoring/badges/coverage.png?s=48847d533c0c42fc3c288d54d946a58951360ca7" />', $this->object->getCoverageBadge($this->repo));

        $this->repo->setCoverageBadgeHash(null);
        $this->assertEquals('', $this->object->getCoverageBadge($this->repo));
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\ScrutinizerExtension::getName
     */
    public function testName()
    {
        $this->assertEquals('snide_travinizer_scrutinizer', $this->object->getName());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getFunctions
     */
    public function testFunctions()
    {
        $this->assertEquals(array('snide_travinizer_scrutinizer_url', 'snide_travinizer_scrutinizer_quality_badge', 'snide_travinizer_scrutinizer_coverage_badge'), array_keys($this->object->getFunctions()));
    }

}