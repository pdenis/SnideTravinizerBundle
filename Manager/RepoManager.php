<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Manager;

use Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoaderInterface;
use Snide\Bundle\TravinizerBundle\Loader\TravisLoaderInterface;
use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Bundle\TravinizerBundle\Reader\ComposerReaderInterface;
use Snide\Bundle\TravinizerBundle\Repository\RepoRepositoryInterface;

/**
 * Class RepositoryManager
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
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
     * Composer json file reader
     *
     * @var ComposerReaderInterface
     */
    protected $composerReader;

    /**
     * Constructor
     *
     * @param RepoRepositoryInterface $repository Repo repository
     * @param $class
     * @param \Snide\Bundle\TravinizerBundle\Loader\TravisLoaderInterface $travisLoader
     * @param \Snide\Bundle\TravinizerBundle\Loader\ScrutinizerLoaderInterface $scrutinizerLoader
     * @param ComposerReaderInterface $composerReader
     */
    public function __construct(
        RepoRepositoryInterface $repository,
        $class,
        TravisLoaderInterface $travisLoader,
        ScrutinizerLoaderInterface $scrutinizerLoader,
        ComposerReaderInterface $composerReader
    ) {
        $this->repository        = $repository;
        $this->travisLoader      = $travisLoader;
        $this->scrutinizerLoader = $scrutinizerLoader;
        $this->composerReader    = $composerReader;
        $this->class             = $class;
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
        return $this->loadRepo($this->repository->find($slug));
    }

    /**
     * Find a repo by his slug
     *
     * @param string $slug Repo slug
     * @return Repo
     */
    public function findBySlug($slug)
    {
        return $this->loadRepo($this->repository->findBySlug($slug));
    }


    /**
     * Find all repos
     *
     * @return array
     */
    public function findAll()
    {
        $repos = array();
        foreach($this->repository->findAll() as $repo) {
            $this->loadPackagistInfos($repo);
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
        try {
            $this->scrutinizerLoader->load($repo);
            $this->travisLoader->load($repo);
        } catch(\Exception $e) {
            // We do not want to throw exception here!
            // Travis or Scrutinizer may not be configured
        }
    }

    /**
     * Load packagist infos by reading composer json file
     *
     * @param Repo $repo
     */
    public function loadPackagistInfos(Repo $repo)
    {
        try {
            $this->composerReader->load($repo->getSlug());

            // Load package name
            if ($this->composerReader->has('name')) {
                $repo->setPackagistSlug($this->composerReader->get('name'));
            }

            // Load authors
            if ($this->composerReader->has('authors')) {
               $repo->setAuthors($this->composerReader->get('authors'));
            }

            // Load dependencies
            if($this->composerReader->has('require')) {
                $repo->setDependencies($this->composerReader->get('require'));
            }
        } catch(\Exception $e) {
            // We do not want to throw exception here!
        }
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

    /**
     * Load repo infos
     *
     * @param Repo $repo
     * @return Repo
     */
    protected function loadRepo(Repo $repo = null)
    {
        if (null == $repo) {
            return null;
        }
        $this->loadExtraInfos($repo);
        $this->loadPackagistInfos($repo);

        return $repo;
    }
}
