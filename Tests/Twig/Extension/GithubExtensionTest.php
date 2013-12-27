<?php

namespace Snide\Bundle\TravinizerBundle\Tests\Twig\Extension;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class GithubExtensionTest
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class GithubExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Snide\Bundle\TravinizerBundle\Twig\Extension\GithubExtension
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
        $this->object = new \Snide\Bundle\TravinizerBundle\Twig\Extension\GithubExtension();
        $this->repo = new Repo();
        $this->repo->setSlug('pdenis/monitoring');
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\GithubExtension::getUrl
     */
    public function testUrl()
    {
        $this->assertEquals('https://github.com/pdenis/monitoring', $this->object->getUrl($this->repo));
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\GithubExtension::getCommitUrl
     */
    public function testCommitUrl()
    {

        $this->assertEquals('https://github.com/pdenis/monitoring/commit/afe67014751025113ed1257c48e49346f184783b', $this->object->getCommitUrl($this->repo, 'afe67014751025113ed1257c48e49346f184783b'));
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\GithubExtension::getName
     */
    public function testName()
    {
        $this->assertEquals('snide_travinizer_github', $this->object->getName());
    }

    /**
     * @cover Snide\Bundle\TravinizerBundle\Twig\Extension\GithubExtension::getFunctions
     */
    public function testFunctions()
    {
        $this->assertEquals(array('snide_travinizer_github_url', 'snide_travinizer_github_commit_url'), array_keys($this->object->getFunctions()));
    }
}