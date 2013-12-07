<?php


namespace Snide\Bundle\TravinizerBundle\Repo;

use Snide\Bundle\TravinizerBundle\Model\Repo;


/**
 * Class Repo
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
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
            $repo->setId($row['slug']);
            $repo->setName($row['name']);
            $repo->setUrl($row['url']);

            $repos[] = $repo;
        }

        return $repos;
    }

    /**
     * Find repo by Slug
     *
     * @param $slug App Slug
     * @return Repo|null
     */
    public function find($slug)
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
        $slug = sizeof($rows) + 1;

        $rows[] = array(
            'slug' => $slug
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
            if ($row['slug'] == $repo->getSlug()) {
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
            if ($row['slug'] == $repo->getSlug()) {
                $row = array(
                    'slug'   => $repo->getSlug()
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