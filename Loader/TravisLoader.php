<?php


namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Model\Repo;
use Travis\Client;

/**
 * Class TravisLoader
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
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
            $repo->setLastBuildFinishedAt($travisRepo->getLastBuildFinishedAt());
            $repo->setLastBuildId($travisRepo->getLastBuildId());
            $repo->setLastBuildNumber($travisRepo->getLastBuildNumber());
            $repo->setLastBuildStartedAt($travisRepo->getLastBuildStartedAt());
            $repo->setLastBuildStatus($travisRepo->getLastBuildStatus());
        }
    }
}
