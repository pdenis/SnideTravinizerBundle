<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright ad license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Manager;

use Snide\Bundle\TravinizerBundle\Model\Repo;

/**
 * Interface RepositoryMaagerInterface
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
interface RepoManagerInterface
{
    /**
     * Create ad save a repo
     *
     * @param Repo $repo
     */
    public function create(Repo $repo);

    /**
     * Delete a repo
     *
     * @param Repo $repo
     */
    public function delete(Repo $repo);

    /**
     * Update a repo
     *
     * @param Repo $repo
     */
    public function update(Repo $repo);

    /**
     * Create a repo instace
     *
     * @return Repo
     */
    public function createNew();

    /**
     * Find a repo
     *
     * @param string $id App ID
     * @return Repo
     */
    public function find($id);

    /**
     * Find a repo by his slug
     *
     * @param string $slug Repo slug
     * @return Repo
     */
    public function findBySlug($slug);

    /**
     * Find all repos
     *
     * @return array
     */
    public function findAll();
}
