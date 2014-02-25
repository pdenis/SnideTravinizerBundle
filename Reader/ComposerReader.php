<?php

namespace Snide\Bundle\TravinizerBundle\Reader;

use Buzz\Browser;
use Guzzle\Http\Client;
use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

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
     * Guzzle client
     *
     * @var Client
     */
    protected $httpClient;
    /**
     * Array of data
     *
     * @var array
     */
    protected $data;

    /**
     * Constructor
     *
     * @param GithubHelper $helper
     */
    public function __construct(GithubHelper $helper)
    {
        $this->helper = $helper;
        $this->httpClient = new Client();
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
        $this->data = array();
        $this->httpClient->setBaseUrl($this->helper->getRawFileUrl($slug, $branch, ''));

        $this->data = $this->getResponse('composer.json');
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

    public function addSubscriber(EventSubscriberInterface $subscriber)
    {

    }

    /**
     * Get composer json
     *
     * @param $uri
     * @return array|bool|float|int|string
     */
    protected function getResponse($uri)
    {
        $request = $this->httpClient->get($uri);

        return $request->send()->json();
    }


}