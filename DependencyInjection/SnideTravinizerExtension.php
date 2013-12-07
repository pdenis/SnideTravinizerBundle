<?php

namespace Snide\Bundle\TravinizerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class SnideTravinizerExtension
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class SnideTravinizerExtension extends Extension
{
    /**
     * Load configuration of Bundle
     *
     * @param array $configs Configuration parameters
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('model.xml');
        $loader->load('form.xml');
        $loader->load('loader.xml');
        $loader->load('manager.xml');
        $loader->load('twig_extension.xml');

        $this->loadRepository($loader, $container, $config);
     }

    /**
     * Load repository
     *
     * @param XmlFileLoader $loader
     * @param ContainerBuilder $container
     * @param array $config
     * @throws \Exception
     */
    protected function loadRepository($loader, ContainerBuilder $container, array $config)
    {

        if (isset($config['repository']['type'])) {
            if ($config['repository']['type'] == 'yaml') {
                if (!isset($config['repository']['repo']['filename'])) {
                    throw new InvalidConfigurationException('You must define filename parameter for repo yaml repository');
                }
                $container->setParameter(
                    'snide_travinizer.repo_repository.filename',
                    $config['repository']['repo']['filename']
                );
            }

            $loader->load('repository/' . $config['repository']['type'] . '.xml');
        } else {
            throw new InvalidConfigurationException('You must define repository type parameter');
        }

    }
}