<?php

namespace Snide\Bundle\TravinizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * @return Response
     */
    public function indexAction()
    {
        $repositories = $this->getManager()->findAll();
        return $this->render(
            $this->getTemplatePath() . 'index.html.twig',
            array(
                'repositories' => $repositories
            )
        );
    }

    /**
     * Get the template path for this controller
     *
     * @return string
     */
    protected function getTemplatePath()
    {
        return 'SnideTravinizerBundle:Dash:';
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
