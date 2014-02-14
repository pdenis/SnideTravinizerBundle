<?php


namespace Snide\Bundle\TravinizerBundle\Twig\Extension;

use Snide\Bundle\TravinizerBundle\Helper\InsightHelper;
use Snide\Bundle\TravinizerBundle\Model\Repo;


/**
 * Class InsightExtension
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class InsightExtension extends \Twig_Extension
{
    /**
     * Github helper
     *
     * @var InsightHelper
     */
    protected $helper;

    /**
     * Constructor
     *
     * @param InsightHelper $helper
     */
    public function __construct(InsightHelper $helper)
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
            'snide_travinizer_insight_url'  => new \Twig_Function_Method(
                $this,
                'getUrl',
                array('is_safe'=> array('html'))
            ),
            'snide_travinizer_insight_badge' => new \Twig_Function_Method(
                $this,
                'getBadge',
                array('is_safe'=> array('html'))
            )
        );
    }

    /**
     * Get Repo url
     *
     * @param Repo $repo
     * @return string
     */
    public function getUrl(Repo $repo)
    {
        return $this->helper->getUrl($repo->getInsightHash());
    }

    /**
     * Get Badge
     *
     * @param Repo $repo
     * @param string $type
     * @return string
     */
    public function getBadge(Repo $repo, $type = 'mini')
    {
        if ($repo->getInsightHash()) {
            return sprintf(
                '<img src="%s" />',
                $this->helper->getBadgeUrl($repo->getInsightHash(), $type)
            );
        }

        return '';
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'snide_travinizer_insight';
    }

    /**
     * Setter helper
     *
     * @param \Snide\Bundle\TravinizerBundle\Helper\InsightHelper $helper
     */
    public function setHelper(InsightHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Getter helper
     *
     * @return \Snide\Bundle\TravinizerBundle\Helper\InsightHelper
     */
    public function getHelper()
    {
        return $this->helper;
    }
}
