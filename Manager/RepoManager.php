<?php

namespace Snide\Bundle\TravinizerBundle\Manager;

use Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoaderInterface;
use Snide\Bundle\TravinizerBundle\Loader\TravisLoaderInterface;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Bundle\TravinizerBundle\Repository\RepoRepositoryInterface;

/**
 * Class RepositoryManager
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class RepoManager implements RepoManagerInterface
{
    /**
     * Repo repository
     *
     * @var RepoRepositoryInterface
     */
    protected $repository;
    /**
     * Repo class
     *
     * @var string
     */
    protected $class;
    /**
     * Travis loader
     *
     * @var TravisLoaderInterface
     */
    protected $travisLoader;
    /**
     * ScrutinizerLoader
     *
     * @var ScrutinizerLoaderInterface
     */
    protected $scrutinizerLoader;

    /**
     * Constructor
     *
     * @param RepoRepositoryInterface $repository Repo repository
     * @param $class
     * @param \Snide\Bundle\TravinizerBundle\Loader\TravisLoaderInterface $travisLoader
     * @param \Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoaderInterface $scrutinizerLoader
     */
    public function __construct(RepoRepositoryInterface $repository, $class,
        TravisLoaderInterface $travisLoader, ScrutinizerLoaderInterface $scrutinizerLoader)
    {
        $this->repository = $repository;
        $this->travisLoader = $travisLoader;
        $this->scrutinizerLoader = $scrutinizerLoader;
        $this->class = $class;
    }

    /**
     * Create and save an repo
     *
     * @param Repo $repo
     */
    public function create(Repo $repo)
    {
        $this->repository->create($repo);
    }

    /**
     * Delete an repo
     *
     * @param Repo $repo
     */
    public function delete(Repo $repo)
    {
        $this->repository->delete($repo);
    }

    /**
     * Find an repo
     *
     * @param string $slug Repo Slug
     * @return Repo
     */
    public function find($slug)
    {
        $repo = $this->repository->find($slug);
        if(null == $repo) {
            return null;
        }
        $this->loadExtraInfos($repo);
        return $repo;
    }

    /**
     * Find all repos
     *
     * @return array
     */
    public function findAll()
    {
        $repos = array();
        foreach ($this->repository->findAll() as $repo) {
            // Load tests
            $this->loadExtraInfos($repo);
            $repos[] = $repo;
        }

        return $repos;
    }

    /**
     * Load infos from travis & scrutinizer
     *
     * @param Repo $repo
     */
    public function loadExtraInfos(Repo $repo)
    {
        $this->scrutinizerLoader->load($repo);
        $this->travisLoader->load($repo);
    }

    /**
     * Update an repo
     *
     * @param Repo $repo
     */
    public function update(Repo $repo)
    {
        $this->repository->update($repo);
    }

    /**
     * Create an repo instance
     *
     * @return Repo
     */
    public function createNew()
    {
        $class = $this->class;

        return new $class;
    }

    /**
     * Getter repository
     *
     * @return RepoRepositoryInterface
     */
    public function getRepository()
    {
        return $this->repository;
    }
}
