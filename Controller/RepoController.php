<?php


namespace Snide\Bundle\TravinizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Class RepoController
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class RepoController extends Controller
{
    /**
     * Create repository action
     *
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $form = $this->getForm();

        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bind($request);
            if ($form->isValid()) {

                $this->getManager()->create($form->getData());
                $this->get('session')->getFlashBag()->add('success', 'Repository created successfully');

                return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
            } else {
                $this->get('session')->getFlashBag()->add('error', 'Some errors have been found');

            }
        }

        return $this->render(
            $this->getTemplatePath() . 'new.html.twig',
            array(
                'form' => $form->createView(),
                'errors' => $form->getErrors()
            )
        );
    }

    /**
     * Edit repository  action
     *
     * @param $id application ID
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        $repository = $this->getManager()->find($id);
        if (!$repository) {
            return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
        }
        $form = $this->getForm($repository);
        return $this->render(
            $this->getTemplatePath() . 'edit.html.twig',
            array(
                'form' => $form->createView(),
                'id' => $id,
                'errors' => array()
            )
        );
    }

    /**
     * Show repository  action
     *
     * @param $id application ID
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $repository = $this->getManager()->find($id);
        if (!$repository) {
            return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
        }
        return $this->render(
            $this->getTemplatePath() . 'show.html.twig',
            array(
                'repository' => $repository
            )
        );
    }

    /**
     * New repository action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        return $this->render(
            $this->getTemplatePath() . 'new.html.twig',
            array(
                'form' => $this->getForm()->createView(),
                'errors' => array()
            )
        );
    }

    /**
     * Update application action
     *
     * @param $id
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id)
    {
        $form = $this->getForm();
        // Get request
        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                // Save instance
                $this->getManager()->update($form->getData());
                $this->get('session')->getFlashBag()->add('success', 'Repository updated successfully');

                return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
            } else {
                $this->get('session')->getFlashBag()->add('error', 'Some errors found');
            }
        }

        return $this->render(
            $this->getTemplatePath() . 'edit.html.twig',
            array(
                'form' => $form->createView(),
                'errors' => $form->getErrors()
            )
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
     * Get template path for this controller
     *
     * @return string
     */
    protected function getTemplatePath()
    {
        return 'SnideTravinizerBundle:Repo:';
    }

    /**
     * Create repo Form and bind it with repo instance
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