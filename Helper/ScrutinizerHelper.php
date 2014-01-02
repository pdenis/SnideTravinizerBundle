<?php


namespace Snide\Bundle\TravinizerBundle\Helper;


/**
 * Class ScrutinizerHelper
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class ScrutinizerHelper
{
    /**
     * Scrutinizer host
     *
     * @var string
     */
    protected $host = 'https://scrutinizer-ci.com';

    /**
     * Get repository Url
     *
     * @param string $slug Repository slug
     * @param string $type Repository type (g=github, b=bitbucket)
     * @return string
     */
    public function getUrl($slug, $type)
    {
        return sprintf(
            '%s/%s/%s',
            $this->host,
            $type,
            $slug
        );
    }

    /**
     * Get quality badge url
     *
     * @param string $slug Repository slug
     * @param string $type Repository type (g=github, b=bitbucket)
     * @param string $qualityBadgeHash Badge hash
     * @return string
     */
    public function getQualityBadgeUrl($slug, $type, $qualityBadgeHash)
    {
        return sprintf(
            '%s/%s/%s/%s?s=%s',
            $this->host,
            $type,
            $slug,
            'badges/quality-score.png',
            $qualityBadgeHash
        );
    }

    /**
     * Get coverage badge url
     *
     * @param string $slug Repository slug
     * @param string $type Repository type (g=github, b=bitbucket)
     * @param string $coverageBadgeHash Badge hash
     * @return string
     */
    public function getCoverageBadgeUrl($slug, $type, $coverageBadgeHash)
    {
        return sprintf(
            '%s/%s/%s/%s?s=%s',
            $this->host,
            $type,
            $slug,
            'badges/coverage.png',
            $coverageBadgeHash
        );
    }
}
