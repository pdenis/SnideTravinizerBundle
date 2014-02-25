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
use Snide\Scrutinizer\Client;
use Snide\Scrutinizer\Model\Repository;

/**
 * Class ScrutinizerLoader
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class ScrutinizerLoader implements ScrutinizerLoaderInterface
{
    protected $client;

    /**
     * Constructor
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Load scruinitzer infos for repository
     * @param Repo $repo
     * @return mixed
     */
    public function load(Repo $repo)
    {
        $scrutinizerRepo = $this->client->fetchRepository(new Repository($repo->getSlug(), $repo->getType()));

        if ($scrutinizerRepo) {
            // Inject scrutinizer data into repository
            $repo->setMetrics($scrutinizerRepo->getMetrics());
            $repo->setPdependMetrics($scrutinizerRepo->getPdependMetrics());
        }
    }
}
