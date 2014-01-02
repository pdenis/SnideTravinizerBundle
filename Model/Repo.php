<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Model;

use Snide\Scrutinizer\Model\Metrics;
use Travis\Client\Entity\Repository;
use Snide\Scrutinizer\Model\Pdepend\Metrics as PdependMetrics;
use Snide\Scrutinizer\Model\Coverage\Metrics as CoverageMetrics;
/**
 * Class Repository
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
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
     * Pdepend metrics
     *
     * @var PdependMetrics
     */
    protected $pdependMetrics;
    /**
     * Code coverage metrics
     *
     * @var CoverageMetrics
     */
    protected $coverageMetrics;
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
     * Packagist slug
     *
     * @var string
     */
    protected $packagistSlug;
    /**
     * Authors
     *
     * @var array
     */
    protected $authors;

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
     * Getter authors
     *
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Setter authors
     *
     * @param array $authors
     */
    public function setAuthors($authors = array())
    {
        $this->authors = $authors;
    }

    /**
     * Getter pdependMetrics
     *
     * @return PdependMetrics
     */
    public function getPdependMetrics()
    {
        return $this->pdependMetrics;
    }

    /**
     * Setter pdependMetrics
     *
     * @param PdependMetrics $pdependMetrics
     */
    public function setPdependMetrics(PdependMetrics $pdependMetrics = null)
    {
        $this->pdependMetrics = $pdependMetrics;
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

    /**
     * Getter packagist slug
     *
     * @return string
     */
    public function getPackagistSlug()
    {
        return $this->packagistSlug;
    }

    /**
     * Setter packagist slug
     *
     * @param string $slug Packagist slug
     */
    public function setPackagistSlug($slug)
    {
        $this->packagistSlug = $slug;
    }

    /**
     * Getter coverage metrics
     *
     * @return CoverageMetrics
     */
    public function getCoverageMetrics()
    {
        return $this->coverageMetrics;
    }

    /**
     * Setter coverage metrics
     *
     * @param CoverageMetrics $coverageMetrics
     */
    public function setCoverageMetrics(CoverageMetrics $coverageMetrics)
    {
        $this->coverageMetrics = $coverageMetrics;
    }
}
