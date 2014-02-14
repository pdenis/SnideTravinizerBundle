<?php


namespace Snide\Bundle\TravinizerBundle\Helper;


/**
 * Class InsightHelper
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class InsightHelper
{
    /**
     * Scrutinizer host
     *
     * @var string
     */
    protected $host = 'https://insight.sensiolabs.com';

    /**
     * Get repository Url
     *
     * @param string $hash Project hash
     * @return string
     */
    public function getUrl($hash)
    {
        return sprintf(
            '%s/projects/%s',
            $this->host,
            $hash
        );
    }

    /**
     * Get quality badge url
     *
     * @param string $hash Repository hash
     * @param string $type Image type (mini, small, big)
     * @return string
     */
    public function getBadgeUrl($hash, $type)
    {
        return sprintf(
            '%s/projects/%s/%s.png',
            $this->host,
            $hash,
            $type
        );
    }
}