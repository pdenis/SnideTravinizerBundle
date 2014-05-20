<?php


namespace Snide\Bundle\TravinizerBundle\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Snide\Bundle\TravinizerBundle\Manager\RepoManagerInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class RepoConverter
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class RepoConverter implements ParamConverterInterface
{
    /**
     * Repo Manager
     *
     * @var RepoManagerInterface
     */
    protected $repoManager;

    /**
     * Constructor
     *
     * @param RepoManagerInterface $repoManager
     */
    public function __construct(RepoManagerInterface $repoManager)
    {
        $this->repoManager = $repoManager;

    }

    /**
     * Stores the object in the request.
     *
     * @param Request $request       The request
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return boolean True if the object has been successfully set, else false
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $name = $configuration->getName();
        $repo = null;

        if (null != $request->attributes->get('id')) {
            $repo = $this->findById($request);
        } else {
            if (null != $request->attributes->get('slug')) {
                $repo = $this->findBySlug($request);
            }
        }

        if ($repo) {
            $request->attributes->set($name, $repo);

            return true;
        }

        return false;
    }

    /**
     * Checks if the object is supported.
     *
     * @param ConfigurationInterface $configuration Should be an instance of ParamConverter
     *
     * @return boolean True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration)
    {
        return ($configuration->getClass() == 'Snide\Bundle\TravinizerBundle\Model\Repo');
    }

    /**
     * Find Repo by ID
     *
     * @param Request $request
     */
    protected function findById(Request $request)
    {
        return $this->repoManager->find($request->attributes->get('id'));
    }

    /**
     * Find Repo by slug
     *
     * @param Request $request
     */
    protected function findBySlug(Request $request)
    {
        return $this->repoManager->findBySlug($request->attributes->get('slug'));
    }
}
