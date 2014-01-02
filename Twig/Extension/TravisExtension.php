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

use Snide\Bundle\TravinizerBundle\Helper\TravisHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class TravisExtension
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class TravisExtension extends \Twig_Extension
{
    /**
     * Travis helper
     *
     * @var \Snide\Bundle\TravinizerBundle\Helper\TravisHelper
     */
    protected $helper;

    /**
     * Constructor
     *
     * @param TravisHelper $helper
     */
    public function __construct(TravisHelper $helper)
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
        return $this->helper->getUrl($repo->getSlug());
    }

    /**
     * Get Repo badge for a slug
     *
     * @param Repo $repo
     * @return string
     */
    public function getBadge(Repo $repo)
    {
        return sprintf(
            '<img src="%s" />',
            $this->helper->getBadgeUrl($repo->getSlug())
        );
    }

    /**
     * Setter helper
     *
     * @param \Snide\Bundle\TravinizerBundle\Helper\TravisHelper $helper
     */
    public function setHelper(TravisHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Getter helper
     *
     * @return \Snide\Bundle\TravinizerBundle\Helper\TravisHelper
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
        return 'snide_travinizer_travis';
    }
}