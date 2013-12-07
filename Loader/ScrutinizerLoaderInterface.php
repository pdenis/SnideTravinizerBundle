<?php


namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Interface ScrutinizerLoaderInterface
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
interface ScrutinizerLoaderInterface
{
    /**
     * Load scruinitzer infos for repository
     * @param Repo $repo
     * @return mixed
     */
    public function load(Repo $repo);
}
