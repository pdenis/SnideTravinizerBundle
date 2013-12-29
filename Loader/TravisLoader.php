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
use Travis\Client;

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
     * @return mixed
     */
    public function load(Repo $repo)
    {
        $travisRepo = $this->client->fetchRepository($repo->getSlug());

        if($travisRepo) {
            // Inject travis data into repository
            $repo->setBuilds($travisRepo->getBuilds());
            $repo->setDescription($travisRepo->getDescription());
            $repo->setLastBuildDuration($travisRepo->getLastBuildDuration());
            $repo->setLastBuildId($travisRepo->getLastBuildId());
            $repo->setLastBuildNumber($travisRepo->getLastBuildNumber());
            $repo->setLastBuildStatus($travisRepo->getLastBuildStatus());
        }
    }
}
