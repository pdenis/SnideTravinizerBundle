<?php


namespace Snide\Bundle\TravinizerBundle\Helper;


/**
 * Class PackagistHelper
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class PackagistHelper
{
    /**
     * Packagist host
     *
     * @var string
     */
    protected $host = 'https://packagist.org';

    /**
     * Get package URL
     *
     * @param string $slug Package slug
     * @return mixed
     */
    public function getUrl($slug)
    {
        return sprintf('%s/packages/%s', $this->host, $slug);
    }
}