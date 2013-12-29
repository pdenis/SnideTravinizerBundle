<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Interface ScrutinizerLoaderInterface
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
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
