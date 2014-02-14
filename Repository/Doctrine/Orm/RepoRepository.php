<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Repository\Doctrine\Orm;

use Snide\Bundle\TravinizerBundle\Model\Repo;
use Doctrine\ORM\EntityRepository;
use Snide\Bundle\TravinizerBundle\Repository\RepoRepositoryInterface;

/**
 * Class RepoRepository
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class RepoRepository extends EntityRepository implements RepoRepositoryInterface
{

    /**
     * Retrieve all repositories
     *
     * @return array
     */
    public function findAll()
    {
        return $this->findBy(array());
    }

    /**
     * Find repo by ID
     *
     * @param $id Repo id
     * @return Repository|null
     */
    public function find($id)
    {
        return parent::find($id);
    }

    /**
     * Find repos by criteria
     *
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Create an repo
     *
     * @param Repo $repo
     * @return mixed
     */
    public function create(Repo $repo)
    {
        $this->_em->persist($repo);
        $this->_em->flush();

        return $repo;
    }

    /**
     * Update an repo
     *
     * @param Repo $repo
     * @return mixex
     */
    public function update(Repo $repo)
    {
        $repo = $this->_em->merge($repo);
        $this->_em->persist($repo);
        $this->_em->flush($repo);

        return $repo;
    }

    /**
     * Delete an repo
     *
     * @param Repo $repo
     * @return mixed
     */
    public function delete(Repo $repo)
    {
        $this->_em->remove($repo);
        $this->_em->flush();
    }
}