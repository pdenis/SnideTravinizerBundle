<?php

namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Interface ComposerLoaderInterface
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
interface ComposerLoaderInterface
{
    /**
     * Get composer file
     *
     * @param \Snide\Bundle\TravinizerBundle\Model\Repo $repo
     * @return string
     */
    public function getFile(Repo $repo);
}