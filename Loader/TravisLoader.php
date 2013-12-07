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

    }
}
