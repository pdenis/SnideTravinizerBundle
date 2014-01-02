<?php


namespace Snide\Bundle\TravinizerBundle\Twig\Extension;

use Snide\Bundle\TravinizerBundle\Helper\PackagistHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;


/**
 * Class PackagistExtension
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class PackagistExtension  extends \Twig_Extension
{
    /**
     * Github helper
     *
     * @var PackagistHelper
     */
    protected $helper;

    /**
     * Constructor
     *
     * @param PackagistHelper $helper
     */
    public function __construct(PackagistHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'snide_travinizer_packagist_url'  => new \Twig_Function_Method(
                $this,
                'getUrl',
                array('is_safe'=> array('html'))
            ),
        );
    }

    /**
     * Get Package  url
     *
     * @param Repo $repo
     * @return string
     */
    public function getUrl(Repo $repo)
    {
        return $this->helper->getUrl($repo->getPackagistSlug());
    }
    
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'snide_travinizer_packagist';
    }

    /**
     * Setter helper
     *
     * @param \Snide\Bundle\TravinizerBundle\Helper\PackagistHelper $helper
     */
    public function setHelper(PackagistHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Getter helper
     *
     * @return \Snide\Bundle\TravinizerBundle\Helper\PackagistHelper
     */
    public function getHelper()
    {
        return $this->helper;
    }

}