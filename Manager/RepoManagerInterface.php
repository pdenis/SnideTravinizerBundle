<?php

namespace Snide\Bundle\TravinizerBundle\Manager;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Interface RepositoryManagerInterface
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
interface RepoManagerInterface
{
    /**
     * Create and save an repo
     *
     * @param Repo $repo
     */
    public function create(Repo $repo);

    /**
     * Delete an repo
     *
     * @param Repo $repo
     */
    public function delete(Repo $repo);

    /**
     * Update an repo
     *
     * @param Repo $repo
     */
    public function update(Repo $repo);

    /**
     * Create an repo instance
     *
     * @return Repo
     */
    public function createNew();

    /**
     * Find an repo
     *
     * @param string $id App ID
     * @return Repo
     */
    public function find($id);

    /**
     * Find all repos
     *
     * @return array
     */
    public function findAll();
}
