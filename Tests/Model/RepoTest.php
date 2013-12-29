<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class RepoTest
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class RepoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Snide\Bundle\TravinizerBundle\Model\Repo
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \Snide\Bundle\TravinizerBundle\Model\Repo();
    }

  

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getSlug
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::setSlug
     */
    public function testSlug()
    {
        $this->assertNull($this->object->getSlug());
        $slug = 'pdenis/monitoring';
        $this->object->setSlug($slug);
        $this->assertEquals($slug, $this->object->getSlug());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getDescription
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::setDescription
     */
    public function testDescription()
    {
        $this->assertNull($this->object->getDescription());
        $description = "This is my description";
        $this->object->setDescription($description);
        $this->assertEquals($description, $this->object->getDescription());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getQualityBadgeHash
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::setQualityBadgeHash
     */
    public function testQualityBadgeHash()
    {
        $this->assertNull($this->object->getQualityBadgeHash());
        $hash = "571f31ce1079abf2d200c2fffb4320b244be8533";
        $this->object->setQualityBadgeHash($hash);
        $this->assertEquals($hash, $this->object->getQualityBadgeHash());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getCoverageBadgeHash
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::setCoverageBadgeHash
     */
    public function testCoverageBadgeHash()
    {
        $this->assertNull($this->object->getCoverageBadgeHash());
        $hash = "571f31ce1079abf2d200c2fffb4320b244be8533";
        $this->object->setCoverageBadgeHash($hash);
        $this->assertEquals($hash, $this->object->getCoverageBadgeHash());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getBuilds
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::setBuilds
     */
    public function testBuilds()
    {
        $this->assertNull($this->object->getBuilds());
        $builds = new \Travis\Client\Entity\BuildCollection();
        $this->object->setBuilds($builds);
        $this->assertEquals($builds, $this->object->getBuilds());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getType
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::setType
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getFullType
     */
    public function testType()
    {
        $this->assertNull($this->object->getType());
        $this->object->setType('g');
        $this->assertEquals('g', $this->object->getType());
        $this->assertEquals('Github', $this->object->getFullType());
        $this->object->setType('b');
        $this->assertEquals('b', $this->object->getType());
        $this->assertEquals('Bitbucket', $this->object->getFullType());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getMetrics
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::setMetrics
     */
    public function testMetrics()
    {
        $this->assertNull($this->object->getMetrics());
        $metrics = new \Snide\Scrutinizer\Model\Metrics();
        $this->object->setMetrics($metrics);
        $this->assertEquals($metrics, $this->object->getMetrics());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getPdependMetrics
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::setPdependMetrics
     */
    public function testPdependMetrics()
    {
        $this->assertNull($this->object->getPdependMetrics());
        $metrics = new \Snide\Scrutinizer\Model\Pdepend\Metrics();
        $this->object->setPdependMetrics($metrics);
        $this->assertEquals($metrics, $this->object->getPdependMetrics());
    }
}