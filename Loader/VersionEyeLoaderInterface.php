<?php


namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Model\Repo;


/**
 * Class VersionEyeLoaderInterface
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
interface VersionEyeLoaderInterface
{
    /**
     * Load dependencies info
     *
     * @param Repo $repo
     * @return mixed
     */
    public function load(Repo $repo);
}