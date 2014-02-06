<?php

namespace Snide\Bundle\TravinizerBundle\Reader;

use Buzz\Browser;
use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;

/**
 * Class ComposerReader
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class ComposerReader implements ComposerReaderInterface
{
    /**
     * Github helper
     *
     * @var \Snide\Bundle\TravinizerBundle\Helper\GithubHelper
     */
    protected $helper;
    /**
     * Client browser
     *
     * @var \Buzz\Browser
     */
    protected $browser;
    /**
     * Array of data
     *
     * @var array
     */
    protected $data;

    /**
     * Constructor
     *
     * @param Browser $browser
     * @param GithubHelper $helper
     */
    public function __construct(Browser $browser, GithubHelper $helper)
    {
        $this->helper = $helper;
        $this->browser = $browser;
    }

    /**
     * Load Composer data by reading composer.json file
     *
     * @param string $slug Repository slug
     * @param string $branch Repository branch
     * @throws \UnexpectedValueException
     */
    public function load($slug, $branch = 'master')
    {
        $url = $this->helper->getRawFileUrl($slug, $branch, 'composer.json');
        $this->data = json_decode($this->browser->get($url)->getContent(), true);

        if (!isset($this->data['name'])) {
            throw new \UnexpectedValueException(sprintf('Response is empty for url %s', $url));
        }
    }

    /**
     * Get value data for specific key
     *
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public function get($key)
    {
        if (!isset($this->data[$key])) {
            throw new \Exception(sprintf('%s key does not exist', $key));
        }

        return $this->data[$key];
    }

    /**
     * key exists ?
     *
     * @param $key
     * @return boolean
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * Setter browser
     *
     * @param \Buzz\Browser $browser
     */
    public function setBrowser(Browser $browser)
    {
        $this->browser = $browser;
    }

    /**
     * Getter browser
     *
     * @return \Buzz\Browser
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Setter helper
     *
     * @param \Snide\Bundle\TravinizerBundle\Helper\GithubHelper $helper
     */
    public function setHelper(GithubHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Getter helper
     *
     * @return \Snide\Bundle\TravinizerBundle\Helper\GithubHelper
     */
    public function getHelper()
    {
        return $this->helper;
    }
}