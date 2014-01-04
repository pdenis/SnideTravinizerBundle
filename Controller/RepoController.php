<?php

/*
 * This file is part of the SnideTravinizer bundle.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Bundle\TravinizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class RepoController
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class RepoController extends Controller
{
    /**
     * Create repository action
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array|RedirectResponse
     *
     * @Template("SnideTravinizerBundle:Repo:new")
     */
    public function createAction(Request $request)
    {
        $form = $this->getForm();

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $this->getManager()->create($form->getData());
                $this->get('session')->getFlashBag()->add('success', 'Repository created successfully');

                return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
            } else {
                $this->get('session')->getFlashBag()->add('error', 'Some errors have been found');

            }
        }

        return array(
            'form' => $form->createView(),
            'errors' => $form->getErrors()
        );
    }

    /**
     * Edit repository  action
     *
     * @param $id application ID
     * @return array|RedirectResponse
     *
     * @Template
     */
    public function editAction($id)
    {
        $repository = $this->getManager()->find($id);
        if (!$repository) {
            return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
        }
        $form = $this->getForm($repository);
        return array(
            'form' => $form->createView(),
            'id' => $id,
            'errors' => array()
        );
    }

    /**
     * Show repository  action
     *
     * @param $id application ID
     * @return array|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Template
     */
    public function showAction($id)
    {
        $repository = $this->getManager()->find($id);
        if (!$repository) {
            return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
        }
        return array(
            'repository' => $repository
        );
    }

    /**
     * New repository action
     *
     * @return array
     *
     * @Template
     */
    public function newAction()
    {
        return  array(
            'form'   => $this->getForm()->createView(),
            'errors' => array()
        );
    }

    /**
     * Update application action
     *
     * @param Request $request
     * @return array|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Template("SnideTravinizerBundle:Repo:edit")
     */
    public function updateAction(Request $request)
    {
        $form = $this->getForm();
        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Save instance
                $this->getManager()->update($form->getData());
                $this->get('session')->getFlashBag()->add('success', 'Repository updated successfully');

                return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
            } else {
                $this->get('session')->getFlashBag()->add('error', 'Some errors found');
            }
        }

        return array(
            'form'   => $form->createView(),
            'errors' => $form->getErrors()
        );
    }

    /**
     * Delete application action
     *
     * @param $id
     * @return RedirectResponse
     */
    public function deleteAction($id)
    {
        $repository = $this->getManager()->find($id);
        if ($repository) {
            $this->getManager()->delete($repository);
            $this->get('session')->getFlashBag()->add('success', 'Repository has been deleted successfully');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'This repository does not exist');
        }

        return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
    }

    /**
     * Create repo Form and submit it with repo instance
     *
     * @param Repo $repo
     * @return \Symfony\Component\Form\Form
     */
    public function getForm($repo = null)
    {
        if ($repo == null) {
            $repo = $this->getManager()->createNew();
        }

        return $this->createForm(
            $this->container->get('snide_travinizer.form.repo_type'),
            $repo
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
