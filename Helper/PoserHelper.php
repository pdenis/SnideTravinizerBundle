<?php

namespace Snide\Bundle\TravinizerBundle\Helper;

/**
 * Class PoserHelper
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class PoserHelper
{
    /**
     * Poser host
     *
     * @var string
     */
    protected $host = 'https://poser.pugx.org';

    /**
     * Get stable version badge Url
     *
     * @param string $slug Packagist slug
     * @return string
     */
    public function getStableVersionBadgeUrl($slug)
    {
        return sprintf('%s/%s/v/stable.png', $this->host, $slug);
    }

    /**
     * Get unstable version badge Url
     *
     * @param string $slug Packagist slug
     * @return string
     */
    public function getUnstableVersionBadgeUrl($slug)
    {
        return sprintf('%s/%s/v/unstable.png', $this->host, $slug);
    }

    /**
     * Get total downloads badge Url
     *
     * @param string $slug Packagist slug
     * @return string
     */
    public function getTotalDownloadBadgeUrl($slug)
    {
        return sprintf('%s/%s/downloads.png', $this->host, $slug);

    }

    /**
     * Get monthly downloads badge Url
     *
     * @param string $slug Packagist slug
     * @return string
     */
    public function getMonthlyDownloadBadgeUrl($slug)
    {
        return sprintf('%s/%s/d/monthly.png', $this->host, $slug);
    }

    /**
     * Get daily downloads badge Url
     *
     * @param string $slug Packagist slug
     * @return string
     */
    public function getDailyDownloadBadgeUrl($slug)
    {
        return sprintf('%s/%s/d/daily.png', $this->host, $slug);
    }

    /**
     * Get license badge Url
     *
     * @param string $slug Packagist slug
     * @return string
     */
    public function getLicenseBadgeUrl($slug)
    {
        return sprintf('%s/%s/license.png', $this->host, $slug);
    }
}
