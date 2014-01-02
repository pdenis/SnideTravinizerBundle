<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Twig\Extension;

use Snide\Bundle\TravinizerBundle\Helper\ScrutinizerHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class ScrutinizerExtension
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class ScrutinizerExtension extends \Twig_Extension
{
    /**
     * Scrutinizer helper
     *
     * @var \Snide\Bundle\TravinizerBundle\Helper\ScrutinizerHelper
     */
    protected $helper;

    /**
     * constructor
     *
     * @param ScrutinizerHelper $helper
     */
    public function __construct(ScrutinizerHelper $helper)
    {
        $this->helper = $helper;
    }

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
        return $this->helper->getUrl(
            $repo->getSlug(),
            $repo->getType()
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
                '<img src="%s" />',
                $this->helper->getQualityBadgeUrl(
                    $repo->getSlug(),
                    $repo->getType(),
                    $repo->getQualityBadgeHash()
                )
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
                '<img src="%s" />',
                $this->helper->getCoverageBadgeUrl(
                    $repo->getSlug(),
                    $repo->getType(),
                    $repo->getCoverageBadgeHash()
                )
            );
        }

        return '';
    }

    /**
     * Setter helper
     *
     * @param \Snide\Bundle\TravinizerBundle\Helper\ScrutinizerHelper $helper
     */
    public function setHelper(ScrutinizerHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Getter helper
     *
     * @return \Snide\Bundle\TravinizerBundle\Helper\ScrutinizerHelper
     */
    public function getHelper()
    {
        return $this->helper;
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
