<?php

namespace Snide\Bundle\TravinizerBundle\Tests\DependencyInjection;

use Snide\Bundle\TravinizerBundle\DependencyInjection\SnideTravinizerExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

/**
 * Class SnideTravinizerExtensionTest
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class SnideTravinizerExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerBuilder */
    protected $configuration;

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testRepositoryLoadThrowsExceptionUnlessRepositorySet()
    {
        $loader = new SnideTravinizerExtension();
        $config = $this->getConfig();
        unset($config['repository']);
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testApplicationRepositoryLoadThrowsExceptionUnlessApplicationSet()
    {
        $loader = new SnideTravinizerExtension();
        $config = $this->getConfig();
        unset($config['repository']['repo']);
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testRepositoryApplicationLoadThrowsExceptionUnlessApplicationFilenameSet()
    {
        $loader = new SnideTravinizerExtension();
        $config = $this->getConfig();
        unset($config['repository']['repo']['filename']);
        $loader->load(array($config), new ContainerBuilder());
    }

    public function testLoadForm()
    {
        $this->loadConfiguration();
        $this->assertHasDefinition('snide_travinizer.form.repo_type');
    }

    public function testLoadLoader()
    {
        $this->loadConfiguration();
        $this->assertHasDefinition('snide_travinizer.travis_loader');
        $this->assertHasDefinition('snide_travinizer.scrutinizer_loader');
        $this->assertInstanceOf('Snide\Bundle\TravinizerBundle\Loader\TravisLoaderInterface', $this->configuration->get('snide_travinizer.travis_loader'));
        $this->assertInstanceOf('Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoaderInterface', $this->configuration->get('snide_travinizer.scrutinizer_loader'));
    }

    public function testLoadModel()
    {
        $this->loadConfiguration();
        $this->assertHasDefinition('snide_travinizer.model.repo');
        $this->assertInstanceOf('Snide\Bundle\TravinizerBundle\Model\Repo', $this->configuration->get('snide_travinizer.model.repo'));
    }

    public function testLoadRepository()
    {
        $this->loadConfiguration();
        $this->assertHasDefinition('snide_travinizer.repo_repository');
        $this->assertInstanceOf('Snide\Bundle\TravinizerBundle\Repository\RepoRepositoryInterface', $this->configuration->get('snide_travinizer.repo_repository'));
    }

    public function testLoadManager()
    {
        $this->loadConfiguration();
        $this->assertHasDefinition('snide_travinizer.repo_manager');
        $this->assertInstanceOf('Snide\Bundle\TravinizerBundle\Manager\RepoManagerInterface', $this->configuration->get('snide_travinizer.repo_manager'));
    }

    /**
     * @param string $id
     */
    private function assertHasDefinition($id)
    {
        $this->assertTrue(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    protected function loadConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new SnideTravinizerExtension();
        $config = $this->getConfig();
        $loader->load(array($config), $this->configuration);
    }
    /**
     * getConfig
     *
     * @return array
     */
    protected function getConfig()
    {
        $yaml = <<<EOF
repository:
    type: yaml
    repo:
        filename: /var/tmp/applications.yml
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }
}