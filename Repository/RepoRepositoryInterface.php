<?php


namespace Snide\Bundle\TravinizerBundle\Repository;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Interface RepositoryInterface
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
interface RepoRepositoryInterface
{
    /**
     * Retrieve all repositories
     *
     * @return array
     */
    public function findAll();

    /**
     * Find repo by Slug
     *
     * @param $slug App Slug
     * @return Repository|null
     */
    public function find($slug);

    /**
     * Create an repo
     *
     * @param Repo $repo
     * @return mixed
     */
    public function create(Repo $repo);

    /**
     * Delete an repo
     *
     * @param Repo $repo
     * @return mixed
     */
    public function delete(Repo $repo);

    /**
     * Update an repo
     *
     * @param Repo $repo
     * @return mixex
     */
    public function update(Repo $repo);
}