<?php


namespace Snide\Bundle\TravinizerBundle\Reader;


/**
 * Interface ComposerReaderInterface
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
interface ComposerReaderInterface
{
    /**
     * Load Composer data by reading composer.json file
     *
     * @param string $slug Repository slug
     * @param string $branch Repository branch
     * @throws \UnexpectedValueException
     */
    public function load($slug, $branch = 'master');

    /**
     * Get value data for specific key
     *
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public function get($key);

    /**
     * key exists ?
     *
     * @param $key
     * @return boolean
     */
    public function has($key);
}