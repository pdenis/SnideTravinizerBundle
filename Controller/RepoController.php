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

use Snide\Bundle\TravinizerBundle\Model\Repo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Template("SnideTravinizerBundle:Repo:new.html.twig")
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
     * @param \Snide\Bundle\TravinizerBundle\Model\Repo $repo
     * @return array|RedirectResponse
     *
     * @ParamConverter("repo", converter="snide_travinizer.repo_converter", class="Snide\Bundle\TravinizerBundle\Model\Repo")
     * @Template
     */
    public function editAction(Repo $repo = null)
    {
        if (!$repo) {
            return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
        }
        $form = $this->getForm($repo);
        return array(
            'form' => $form->createView(),
            'repo' => $repo,
            'slug' => $repo->getSlug(),
            'errors' => array()
        );
    }

    /**
     * Show repository  action
     *
     * @param \Snide\Bundle\TravinizerBundle\Model\Repo $repo
     * @return array|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("repo", converter="snide_travinizer.repo_converter", class="Snide\Bundle\TravinizerBundle\Model\Repo")
     * @Template
     */
    public function showAction(Repo $repo = null)
    {
        if (!$repo) {
            return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
        }
        return array(
            'repository' => $repo
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
            'form' => $this->getForm()->createView(),
            'errors' => array()
        );
    }

    /**
     * Update application action
     *
     * @param Repo $repo
     * @return array|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("repo", converter="snide_travinizer.repo_converter", class="Snide\Bundle\TravinizerBundle\Model\Repo")
     * @Template("SnideTravinizerBundle:Repo:edit.html.twig")
     */
    public function updateAction(Repo $repo)
    {
        $form = $this->getForm();
        $slug = $repo->getSlug();
        $form->handleRequest($this->get('request'));
        $repo = $form->getData();
        if ($form->isValid()) {
            // Save instance

            $this->getManager()->update($repo);
            $this->get('session')->getFlashBag()->add('success', 'Repository updated successfully');

            return new RedirectResponse($this->generateUrl('snide_travinizer_dashboard'));
        }
        $this->get('session')->getFlashBag()->add('error', 'Some errors found');


        return array(
            'repo'   => $repo,
            'form'   => $form->createView(),
            'errors' => $form->getErrors(),
            'slug'   => $slug
        );
    }

    /**
     * Delete application action
     *
     * @param \Snide\Bundle\TravinizerBundle\Model\Repo $repo
     * @return RedirectResponse
     *
     * @ParamConverter("repo", converter="snide_travinizer.repo_converter", class="Snide\Bundle\TravinizerBundle\Model\Repo")
     */
    public function deleteAction(Repo $repo)
    {
        if ($repo) {
            $this->getManager()->delete($repo);
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
    protected function getForm($repo = null)
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
    protected function getManager()
    {
        return $this->get('snide_travinizer.repo_manager');
    }
}
