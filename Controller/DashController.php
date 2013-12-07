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
        return $this->render(
            $this->getTemplatePath() . 'index.html.twig',
            array(
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
}
