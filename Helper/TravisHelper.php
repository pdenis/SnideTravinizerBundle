<?php


namespace Snide\Bundle\TravinizerBundle\Helper;


/**
 * Class TravisHelper
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class TravisHelper
{
    /**
     * Travis host
     *
     * @var string
     */
    protected $host = 'https://travis-ci.org';

    /**
     * Get travis repository URL
     *
     * @param string $slug Repository slug
     * @return string
     */
    public function getUrl($slug)
    {
        return sprintf('%s/%s', $this->host, $slug);
    }

    /**
     * Get travis build badge
     * @param string $slug Repository slug
     * @param string $branch Repository branch
     * @return string
     */
    public function getBadgeUrl($slug, $branch = 'master')
    {
        return sprintf('%s/%s.png?branch=%s', $this->host, $slug, $branch);
    }
}
