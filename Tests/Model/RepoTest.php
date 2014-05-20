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
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::getAuthors
     * @cover Snide\Bundle\TravinizerBundle\Model\Repo::setAuthors
     */
    public function testAuthors()
    {
        $this->assertNull($this->object->getAuthors());
        $authors = array('name' => 'Pascal DENIS', 'email' => 'pascal.denis.75@gmail.com');
        $this->object->setAuthors($authors);
        $this->assertEquals($authors, $this->object->getAuthors());
    }

    public function testQualityBadgeHash()
    {
        $this->assertNull($this->object->getQualityBadgeHash());
        $hash = "571f31ce1079abf2d200c2fffb4320b244be8533";
        $this->object->setQualityBadgeHash($hash);
        $this->assertEquals($hash, $this->object->getQualityBadgeHash());
    }

    public function testCoverageBadgeHash()
    {
        $this->assertNull($this->object->getCoverageBadgeHash());
        $hash = "571f31ce1079abf2d200c2fffb4320b244be8533";
        $this->object->setCoverageBadgeHash($hash);
        $this->assertEquals($hash, $this->object->getCoverageBadgeHash());
    }

    public function testInsightBadgeHash()
    {
        $this->assertNull($this->object->getInsightHash());
        $hash = "571f31ce1079abf2d200c2fffb4320b244be8533";
        $this->object->setInsightHash($hash);
        $this->assertEquals($hash, $this->object->getInsightHash());
    }

    public function testBuilds()
    {
        $builds = array('build');
        $this->object->setBuilds($builds);
        $this->assertEquals($builds, $this->object->getBuilds());
    }

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

    public function testMetrics()
    {
        $this->assertNull($this->object->getMetrics());
        $metrics = new \Snide\Scrutinizer\Model\Metrics();
        $this->object->setMetrics($metrics);
        $this->assertEquals($metrics, $this->object->getMetrics());
    }

    public function testPdependMetrics()
    {
        $this->assertNull($this->object->getPdependMetrics());
        $metrics = new \Snide\Scrutinizer\Model\Pdepend\Metrics();
        $this->object->setPdependMetrics($metrics);
        $this->assertEquals($metrics, $this->object->getPdependMetrics());
    }

    public function testCoverageMetrics()
    {
        $this->assertNull($this->object->getCoverageMetrics());
        $metrics = new \Snide\Scrutinizer\Model\Coverage\Metrics();
        $this->object->setCoverageMetrics($metrics);
        $this->assertEquals($metrics, $this->object->getCoverageMetrics());
    }

    public function testDependencies()
    {
        $this->assertEquals(array(), $this->object->getDependencies());
        $deps = array('php 5.3');
        $this->object->setDependencies($deps);
        $this->assertEquals($deps, $this->object->getDependencies());
    }
}