<?php


namespace Snide\Bundle\TravinizerBundle\Helper;


/**
 * Class GithubHelper
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class GithubHelper
{

    /**
     * Github host
     *
     * @var string
     */
    protected $host = 'https://github.com';
    /**
     * Github raw host
     *
     * @var string
     */
    protected $rawHost = 'https://raw.github.com';

    /**
     * Get repository URL
     *
     * @param string $slug Repository slug
     * @return string
     */
    public function getUrl($slug)
    {
        return sprintf('%s/%s', $this->host, $slug);
    }

    /**
     * Get repository commit URL
     *
     * @param string $slug Repository slug
     * @param string $commitSHA Commit SHA
     * @return string
     */
    public function getCommitUrl($slug, $commitSHA)
    {
        return sprintf(
            '%s/%s/commit/%s',
            $this->host,
            $slug,
            $commitSHA
        );
    }

    /**
     * Get repository raw file
     *
     * @param string $slug Repository slug
     * @param string $branch Repository branch
     * @param string $path File path
     * @return string
     */
    public function getRawFileUrl($slug, $branch, $path)
    {
        return sprintf(
            '%s/%s/%s/%s',
            $this->rawHost,
            $slug,
            $branch,
            $path
        );
    }
}
