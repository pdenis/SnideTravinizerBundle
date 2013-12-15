<?php

namespace Snide\Bundle\TravinizerBundle\Twig\Extension;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class TravisExtension
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class TravisExtension extends \Twig_Extension
{

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'snide_travinizer_travis_url'   => new \Twig_Function_Method($this, 'getUrl', array('is_safe'=> array('html'))),
            'snide_travinizer_travis_badge' => new \Twig_Function_Method($this, 'getBadge', array('is_safe'=> array('html')))
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
        return sprintf('%s/%s', 'https://travis-ci.org', $repo->getSlug());
    }

    /**
     * Get Repo badge for a slug
     *
     * @param Repo $repo
     * @return string
     */
    public function getBadge(Repo $repo)
    {
        return sprintf('<img src="%s/%s.png?%s" />', 'https://travis-ci.org', $repo->getSlug(), 'master');
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'snide_travinizer_travis';
    }
}