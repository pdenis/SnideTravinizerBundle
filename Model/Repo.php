<?php

namespace Snide\Bundle\TravinizerBundle\Model;

use Snide\Scrutinizer\Model\Metrics;
use Travis\Client\Entity\Repository;

/**
 * Class Repository
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class Repo extends Repository
{
    /**
     * Metrics
     *
     * @var Metrics
     */
    protected $metrics;
    /**
     * Scrutinizer badge hash
     *
     * @var string
     */
    protected $hash;
    /**
     * "g" for github or "b" for bitbucket
     * @var string
     */
    protected $type;
    /**
     * Branch
     *
     * @var string
     */
    protected $branch;

    /**
     * Getter branch
     *
     * @return string
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * Setter branch
     *
     * @param $branch repo branch
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;
    }

    /**
     * Getter metrics
     *
     * @return Metrics
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * Setter metrics
     *
     * @param Metrics $metrics
     */
    public function setMetrics(Metrics $metrics)
    {
        $this->metrics = $metrics;
    }

    /**
     * Getter hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Setter hash
     *
     * @param $hash Scrutinizer Badge hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * Getter type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Setter type
     *
     * @param $type "g" for github or "b" for bitbucket
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
