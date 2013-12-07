<?php

namespace Snide\Bundle\TravinizerBundle\Twig\Extension;

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
            'snide_travinizer_travis_link'  => new \Twig_Function_Method($this, 'getLink', array('is_safe'=> array('html'))),
            'snide_travinizer_travis_badge' => new \Twig_Function_Method($this, 'getBadge', array('is_safe'=> array('html')))
        );
    }

    /**
     * Get Repo link for a slug
     *
     * @param $slug (user/repo)
     * @return string
     */
    public function getLink($slug)
    {

    }

    /**
     * Get Repo badge for a slug
     *
     * @param $slug (user/repo)
     * @return string
     */
    public function getBadge($slug)
    {

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