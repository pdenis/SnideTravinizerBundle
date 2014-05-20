<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
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
        $loader->load('helper.xml');
        $loader->load('reader.xml');
        $loader->load('converter.xml');
        $loader->load('loader.xml');
        $loader->load('manager.xml');
        $loader->load('twig_extension.xml');
        $loader->load('validator.xml');
        $loader->load('cache.xml');

        $this->loadRepository($loader, $container, $config);
        $this->loadManager($loader, $container, $config);
        $this->loadRepoClass($loader, $container, $config);
        $this->loadCachePath($container, $config);
        $this->loadVersionEyeKey($container, $config);
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
                    throw new InvalidConfigurationException(
                        'You must define filename parameter for repo yaml repository'
                    );
                }
                $container->setParameter(
                    'snide_travinizer.repo_repository.filename',
                    $config['repository']['repo']['filename']
                );
            }

            $loader->load('repository/' . strtr($config['repository']['type'], '_', '/') . '.xml');
        } else {
            throw new InvalidConfigurationException('You must define repository type parameter');
        }

        if (isset($config['repository']['class'])) {
            $container->setParameter('snide_travinizer.repo_repository.class', $config['repository']['class']);
        }
    }

    /**
     * Load manager
     *
     * @param XmlFileLoader $loader
     * @param ContainerBuilder $container
     * @param array $config
     * @throws \Exception
     */
    protected function loadManager($loader, ContainerBuilder $container, array $config)
    {
        if (isset($config['manager']['class'])) {
            $container->setParameter('snide_travinizer.repo_manager.class', $config['manager']['class']);
        }
    }

    /**
     * Load repoClass entity
     *
     * @param XmlFileLoader $loader
     * @param ContainerBuilder $container
     * @param array $config
     * @throws \Exception
     */
    protected function loadRepoClass($loader, ContainerBuilder $container, array $config)
    {

        if (isset($config['repository']['repo']['class'])) {
            $container->setParameter('snide_travinizer.model.repo.class', $config['repository']['repo']['class']);
        }
    }

    /**
     * Load cache
     *
     * @param ContainerBuilder $container
     * @param array $config
     * @throws \Exception
     */
    protected function loadCachePath(ContainerBuilder $container, array $config)
    {
        if (isset($config['filesystem_cache_path'])) {
            $container->setParameter('snide_travinizer.cache_path', $config['filesystem_cache_path']);
        }
    }

    /**
     * Load version eye key
     *
     * @param ContainerBuilder $container
     * @param array $config
     * @throws \Exception
     */
    protected function loadVersionEyeKey(ContainerBuilder $container, array $config)
    {
        if (isset($config['version_eye_key'])) {
            $container->setParameter('snide_travinizer.version_eye_client.key', $config['version_eye_key']);
        }
    }
}
