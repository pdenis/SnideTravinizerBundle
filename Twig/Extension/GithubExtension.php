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

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Class TravisExtension
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class GithubExtension extends \Twig_Extension
{

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'snide_travinizer_github_url'  => new \Twig_Function_Method($this, 'getUrl', array('is_safe'=> array('html'))),
            'snide_travinizer_github_commit_url' => new \Twig_Function_Method($this, 'getCommitUrl', array('is_safe'=> array('html')))
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
        return sprintf('%s/%s', 'https://github.com', $repo->getSlug());
    }

    /**
     * Get Repo commit url
     *
     * @param Repo $repo
     * @param string $commitSHA
     * @return string
     */
    public function getCommitUrl(Repo $repo, $commitSHA)
    {
        return sprintf('%s/%s/commit/%s', 'https://github.com', $repo->getSlug(), $commitSHA);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'snide_travinizer_github';
    }
}