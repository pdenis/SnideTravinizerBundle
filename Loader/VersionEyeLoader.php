<?php


namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\VersionEye\Client;
use Snide\VersionEye\Model\Project;


/**
 * Class VersionEyeLoader
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class VersionEyeLoader implements VersionEyeLoaderInterface
{
    /**
     * @var ComposerLoaderInterface
     */
    protected $composerLoader;

    /**
     * Version Eye client
     *
     * @var \Snide\VersionEye\Client
     */
    protected $client;

    /**
     * Constructor
     *
     * @param ComposerLoaderInterface $composerLoader
     * @param Client $client
     */
    public function __construct(ComposerLoaderInterface $composerLoader, Client $client)
    {
        $this->composerLoader = $composerLoader;
        $this->client = $client;
    }

    /**
     * Load dependencies info
     *
     * @param Repo $repo
     * @return Repo $repo
     */
    public function load(Repo $repo)
    {
        $project = $this->client->createProject($this->composerLoader->getFile($repo));

        $repo->setDependencies($project->getDependencies());

        return $repo;
    }
}