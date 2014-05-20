<?php


namespace Snide\Bundle\TravinizerBundle\Loader;

use Snide\Bundle\TravinizerBundle\Helper\GithubHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;


/**
 * Class ComposerLoader
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class ComposerLoader implements ComposerLoaderInterface
{
    /**
     * Github helper
     *
     * @var GithubHelper
     */
    protected $helper;

    /**
     * Constructor
     *
     * @param GithubHelper $helper
     */
    public function __construct(GithubHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Get composer file
     *
     * @param \Snide\Bundle\TravinizerBundle\Model\Repo $repo
     * @return string
     */
    public function getFile(Repo $repo)
    {
        $file = tempnam(sys_get_temp_dir(), 'composer');
        $content = file_get_contents($this->helper->getRawFileUrl($repo->getSlug(), 'master', 'composer.json'));
        file_put_contents($file, $content);

        return $file;
    }
}
