<?php

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
        $treeBuilder->root('snide_travinizer')->children()
            ->arrayNode('repository')
            ->children()
                ->scalarNode('type')->isRequired()->end()
                ->arrayNode('repo')
                    ->children()
                        ->scalarNode('filename')->isRequired()->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
