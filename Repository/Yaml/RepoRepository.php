<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Repository\Yaml;

use Snide\Bundle\TravinizerBundle\Model\Repo;
use Snide\Bundle\TravinizerBundle\Repository\RepoRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Repo
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class RepoRepository implements RepoRepositoryInterface
{
    /**
     * Save filename
     *
     * @var string
     */
    protected $filename;
    /**
     * Repo class
     *
     * @var string
     */
    protected $class;

    /**
     * Constructor
     *
     * @param string $class Repo class
     * @param string $filename save file
     */
    public function __construct($class, $filename)
    {
        $this->class = $class;
        $this->filename = $filename;

        $fs = new Filesystem();
        $fs->touch($this->filename);
    }

    /**
     * Retrieve all repos
     *
     * @return array
     */
    public function findAll()
    {
        $repos = array();

        foreach ($this->getRows() as $row) {
            $repo = $this->createNew();
            $repo->setId($row['id']);
            $repo->setSlug($row['slug']);
            $repo->setType($row['type']);
            $repo->setQualityBadgeHash($row['qualityBadgeHash']);
            $repo->setCoverageBadgeHash($row['coverageBadgeHash']);
            $repos[] = $repo;
        }

        return $repos;
    }

    /**
     * Find All repos
     * No criteria will be managed in this repository
     * If you want specific findBy, please use doctrine/ORM repository
     *
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->findAll();
    }

    /**
     * Find repo by ID
     *
     * @param $id Repo id
     * @return Repo|null
     */
    public function find($id)
    {
        foreach ($this->findAll() as $repo) {
            if ($id == $repo->getId()) {
                return $repo;
            }
        }

        return null;
    }

    /**
     * Find repo by Slug
     *
     * @param string $slug Repo Slug
     * @return Repo|null
     */
    public function findBySlug($slug)
    {
        foreach ($this->findAll() as $repo) {
            if ($slug == $repo->getSlug()) {
                return $repo;
            }
        }

        return null;
    }

    /**
     * Create an repo
     *
     * @param Repo $repo
     * @return mixed
     */
    public function create(Repo $repo)
    {
        $rows = $this->getRows();
        $id = sizeof($rows) + 1;

        $rows[] = array(
            'id' => $id,
            'slug' => $repo->getSlug(),
            'type' => $repo->getType(),
            'qualityBadgeHash' => $repo->getQualityBadgeHash(),
            'coverageBadgeHash' => $repo->getCoverageBadgeHash(),
        );

        file_put_contents($this->filename, Yaml::dump($rows));
    }

    /**
     * Delete an repo
     *
     * @param Repo $repo
     * @return mixed
     */
    public function delete(Repo $repo)
    {
        $rows = array();

        foreach ($this->getRows() as $row) {
            if ($row['id'] == $repo->getId()) {
                continue;
            }
            $rows[] = $row;
        }

        file_put_contents($this->filename, Yaml::dump($rows));
    }

    /**
     * Update an repo
     *
     * @param Repo $repo
     * @return mixex
     */
    public function update(Repo $repo)
    {
        $rows = array();

        foreach ($this->getRows() as $row) {
            if ($row['id'] == $repo->getId()) {
                $row = array(
                    'slug' => $repo->getSlug(),
                    'qualityBadgeHash' => $repo->getQualityBadgeHash(),
                    'coverageBadgeHash' => $repo->getCoverageBadgeHash(),
                    'type' => $repo->getType(),
                    'id' => $repo->getId()
                );
            }
            $rows[] = $row;
        }

        file_put_contents($this->filename, Yaml::dump($rows));
    }

    /**
     * Get List of repos rows
     * @return array
     */
    private function getRows()
    {
        return Yaml::parse($this->filename) ? : array();
    }

    /**
     * Create new instance
     *
     * @return Repo
     */
    public function createNew()
    {
        $class = $this->class;

        return new $class;
    }
}
