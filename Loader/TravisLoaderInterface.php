<?php

namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Interface TravisLoaderInterface
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
interface TravisLoaderInterface
{
    /**
     * Load travis infos for repository
     * @param Repo $repo
     * @return mixed
     */
    public function load(Repo $repo);
}
