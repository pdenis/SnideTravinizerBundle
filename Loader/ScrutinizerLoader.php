<?php


namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Scrutinizer\Client;


/**
 * Class ScrutinizerLoader
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
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
        $scrutinizerRepo = $this->client->fetch($repo->getSlug());

        if($scrutinizerRepo) {
            // Inject scrutinizer data into repository
            $repo->setMetrics($scrutinizerRepo->getMetrics());
        }
    }
}
