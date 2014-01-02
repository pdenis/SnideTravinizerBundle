<?php


namespace Snide\Bundle\TravinizerBundle\Twig\Extension;

use Snide\Bundle\TravinizerBundle\Helper\PoserHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;


/**
 * Class PoserExtension
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class PoserExtension extends \Twig_Extension
{
    /**
     * Poser helper
     *
     * @var \Snide\Bundle\TravinizerBundle\Helper\PoserHelper
     */
    protected $helper;

    /**
     * Constructor
     *
     * @param PoserHelper $helper
     */
    public function __construct(PoserHelper $helper)
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
            'snide_travinizer_poser_stable_badge'           => new \Twig_Function_Method($this, 'getStableBadge', array('is_safe'=> array('html'))),
            'snide_travinizer_poser_unstable_badge'         => new \Twig_Function_Method($this, 'getUnstableBadge', array('is_safe'=> array('html'))),
            'snide_travinizer_poser_download_badge'         => new \Twig_Function_Method($this, 'getDownloadBadge', array('is_safe'=> array('html'))),
            'snide_travinizer_poser_monthly_download_badge' => new \Twig_Function_Method($this, 'getMonthlyDownloadBadge', array('is_safe'=> array('html'))),
            'snide_travinizer_poser_daily_download_badge'   => new \Twig_Function_Method($this, 'getDailyDownloadBadge', array('is_safe'=> array('html')))
        );
    }

    /**
     * Get stable version badge image
     *
     * @param Repo $repo
     * @return string
     */
    public function getStableBadge(Repo $repo)
    {
        if($repo->getPackagistSlug()) {
            return sprintf('<img src="%s" />', $this->helper->getStableVersionBadgeUrl($repo->getPackagistSlug()));
        }

        return '';
    }

    /**
     * Get unstable version badge image
     *
     * @param Repo $repo
     * @return string
     */
    public function getUnstableBadge(Repo $repo)
    {
        if($repo->getPackagistSlug()) {
            return sprintf('<img src="%s" />', $this->helper->getUnstableVersionBadgeUrl($repo->getPackagistSlug()));
        }

        return '';
    }

    /**
     * Get total downloads badge image
     *
     * @param Repo $repo
     * @return string
     */
    public function getDownloadBadge(Repo $repo)
    {
        if($repo->getPackagistSlug()) {
            return sprintf('<img src="%s" />', $this->helper->getTotalDownloadBadgeUrl($repo->getPackagistSlug()));
        }

        return '';
    }

    /**
     * Get monthly downloads badge image
     *
     * @param Repo $repo
     * @return string
     */
    public function getMonthlyDownloadBadge(Repo $repo)
    {
        if($repo->getPackagistSlug()) {
            return sprintf('<img src="%s" />', $this->helper->getMonthlyDownloadBadgeUrl($repo->getPackagistSlug()));
        }

        return '';
    }

    /**
     * Get daily downloads badge image
     *
     * @param Repo $repo
     * @return string
     */
    public function getDailyDownloadBadge(Repo $repo)
    {
        if($repo->getPackagistSlug()) {
            return sprintf('<img src="%s" />', $this->helper->getDailyDownloadBadgeUrl($repo->getPackagistSlug()));
        }

        return '';
    }

    /**
     * Getter helper
     *
     * @return PoserHelper
     */
    public function getHelper()
    {
        return $this->helper;
    }

    /**
     * Setter helper
     *
     * @param PoserHelper $helper
     */
    public function setHelper(PoserHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'snide_scrutinizer_poser';
    }
}
