<?php

namespace Snide\Bundle\TravinizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DashController
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class DashController extends Controller
{

    /**
     * Dashboard Action
     *
     * @Template
     *
     * @return Response
     */
    public function indexAction()
    {
        $repositories = $this->getManager()->findAll();
        return array(
            'repositories' => $repositories
        );
    }

    /**
     * Get Repo manager
     *
     * @return mixed
     */
    public function getManager()
    {
        return $this->get('snide_travinizer.repo_manager');
    }
}
