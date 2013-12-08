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
     * Scrutinizer quality badge hash
     *
     * @var string
     */
    protected $qualityBadgeHash;

    /**
     * Scrutinizer coverage badge hash
     * @var string
     */
    protected $coverageBadgeHash;
    /**
     * "g" for github or "b" for bitbucket
     * @var string
     */
    protected $type;

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
    public function setMetrics(Metrics $metrics = null)
    {
        $this->metrics = $metrics;
    }

    /**
     * Getter qualityBadgeHash
     *
     * @return string
     */
    public function getQualityBadgeHash()
    {
        return $this->qualityBadgeHash;
    }

    /**
     * Setter qualityBadgeHash
     *
     * @param $hash Scrutinizer Quality Badge hash
     */
    public function setQualityBadgeHash($hash)
    {
        $this->qualityBadgeHash = $hash;
    }

    /**
     * Getter coverageBadgeHash
     *
     * @return string
     */
    public function getCoverageBadgeHash()
    {
        return $this->coverageBadgeHash;
    }

    /**
     * Setter coverageBadgeHash
     *
     * @param $hash Scrutinizer Coverage Badge hash
     */
    public function setCoverageBadgeHash($hash)
    {
        $this->coverageBadgeHash = $hash;
    }

    public function getFullType()
    {
        return ($this->type == 'g')? 'Github' : 'Bitbucket';
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
