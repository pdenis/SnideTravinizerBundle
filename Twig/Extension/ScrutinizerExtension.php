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
            'snide_travinizer_scrutinizer_link'  => new \Twig_Function_Method($this, 'getLink', array('is_safe'=> array('html'))),
            'snide_travinizer_scrutinizer_badge' => new \Twig_Function_Method($this, 'getBadge', array('is_safe'=> array('html')))
        );
    }

    /**
     * Get Repo link
     *
     * @param Repo $repo
     * @return string
     */
    public function getLink(Repo $repo)
    {
        return sprintf(
            '%s/%s/%s',
            'https://scrutinizer-ci.com',
            $repo->getType(),
            $repo->getSlug()
        );
    }

    /**
     * Get Repo badge
     *
     * @param Repo $repo
     * @return string
     */
    public function getBadge(Repo $repo)
    {
        return sprintf(
            '%s/%s/%s?s=%s',
            'https://scrutinizer-ci.com',
            $repo->getType(),
            $repo->getSlug(),
            'badges/quality-score.png',
            $repo->getHash()
        );
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
