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
use Snide\Travis\Client;

/**
 * Class TravisLoader
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class TravisLoader implements TravisLoaderInterface
{
    /**
     * Travis client
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Load travis infos for repository
     * @param Repo $repo
     * @return Repo
     */
    public function load(Repo $repo)
    {
        // Travis own its ID
        $id = $repo->getId();
        $this->client->fetchRepository($repo);
        $repo->setId($id);

        return $repo;
    }
}
