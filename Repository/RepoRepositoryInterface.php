<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Repository;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Interface RepositoryInterface
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
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
     * Find repo by ID
     *
     * @param string $id Repo ID
     * @return Repo|null
     */
    public function find($id);

    /**
     * Find repo by Slug
     *
     * @param string $slug Repo Slug
     * @return Repo|null
     */
    public function findBySlug($slug);

    /**
     * Find repos by criteria
     *
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null);

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
