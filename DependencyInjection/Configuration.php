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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('snide_travinizer')
            ->children()
            ->scalarNode('filesystem_cache_path')->end()
            ->scalarNode('version_eye_key')->end()
            ->arrayNode('manager')
            ->children()
            ->scalarNode('class')->isRequired()->end()
            ->end()
            ->end()
            ->arrayNode('repository')
            ->children()
            ->scalarNode('type')->isRequired()->end()
            ->scalarNode('class')->end()
            ->arrayNode('repo')
            ->children()
            ->scalarNode('filename')->end()
            ->scalarNode('class')->end()
            ->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
