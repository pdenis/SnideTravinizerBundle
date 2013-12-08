<?php

namespace Snide\Bundle\TravinizerBundle\Twig\Extension;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class ScrutinizerExtension
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class ScrutinizerExtension extends \Twig_Extension
{

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'snide_travinizer_scrutinizer_url'  => new \Twig_Function_Method($this, 'getUrl', array('is_safe'=> array('html'))),
            'snide_travinizer_scrutinizer_quality_badge' => new \Twig_Function_Method($this, 'getQualityBadge', array('is_safe'=> array('html'))),
            'snide_travinizer_scrutinizer_coverage_badge' => new \Twig_Function_Method($this, 'getCoverageBadge', array('is_safe'=> array('html')))
        );
    }

    /**
     * Get Repo url
     *
     * @param Repo $repo
     * @return string
     */
    public function getUrl(Repo $repo)
    {
        return sprintf(
            '%s/%s/%s',
            'https://scrutinizer-ci.com',
            $repo->getType(),
            $repo->getSlug()
        );
    }

    /**
     * Get Repo quality badge
     *
     * @param Repo $repo
     * @return string
     */
    public function getQualityBadge(Repo $repo)
    {
        if($repo->getQualityBadgeHash()) {
            return sprintf(
                '<img src="%s/%s/%s/%s?s=%s" />',
                'https://scrutinizer-ci.com',
                $repo->getType(),
                $repo->getSlug(),
                'badges/quality-score.png',
                $repo->getQualityBadgeHash()
            );
        }
        return '';
    }

    /**
     * Get Repo coverage badge
     *
     * @param Repo $repo
     * @return string
     */
    public function getCoverageBadge(Repo $repo)
    {
        if($repo->getCoverageBadgeHash()) {
            return sprintf(
                '<img src="%s/%s/%s/%s?s=%s" />',
                'https://scrutinizer-ci.com',
                $repo->getType(),
                $repo->getSlug(),
                'badges/coverage.png',
                $repo->getCoverageBadgeHash()
            );
        }
        return '';
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'snide_travinizer_scrutinizer';
    }
}
