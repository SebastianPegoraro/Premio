<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Premio;
use AppBundle\Form\PremioType;
use AppBundle\Form\PremioFilterType;

/**
 * Premio controller.
 *
 * @Route("/admin/premio")
 */
class PremioController extends Controller
{
    /**
     * Lists all Premio entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="admin_premio_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        list($queryBuilder, $filterForm) = $this->filter($request);

        $premios = $this->paginate($queryBuilder, $request);

        return $this->render('premio/index.html.twig', array(
            'premios' => $premios,
            'filterForm' => $filterForm->createView(),
        ));
    }


    /**
     * Filters Premio entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request)
    {

        $filterForm = $this->createForm(PremioFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Premio')->createQueryBuilder('e');
        
        $data = array();
        if ($request->getMethod() == 'POST') {
            if ($request->get('filter') == 'search') {
                $filterForm->handleRequest($request);
                if ($filterForm->isSubmitted() && $filterForm->isValid()) {
                    $data = $request->get($filterForm->getName());
                    $session->set($filterForm->getName(), $data);
                    $this->get('lexik_form_filter.query_builder_updater')
                        ->addFilterConditions($filterForm, $queryBuilder);    
                }
            } else {
                $session->remove($filterForm->getName());
            }
        } else {
            $data = $session->get($filterForm->getName(), array());
            $filterForm->submit($data);
            $this->get('lexik_form_filter.query_builder_updater')
                ->addFilterConditions($filterForm, $queryBuilder);
        }


        return array($queryBuilder, $filterForm);
    }

    /**
     * Filters Premio entities.
     *
     * @param mixed   $queryBuilder QueryBuilder object
     * @param Request $request      Request object
     *
     * @return array
     */
    protected function paginate($queryBuilder, Request $request)
    {
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10 /*limit per page*/
        );

        return $pagination;
    }
    /**
     * Creates a new Premio entity.
     *
     * @Route("/new", name="admin_premio_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $premio = new Premio();
        $form = $this->createForm('AppBundle\Form\PremioType', $premio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($premio);
            $em->flush();

            return $this->redirectToRoute('admin_premio_show', array('id' => $premio->getId()));
        }

        return $this->render('premio/new.html.twig', array(
            'premio' => $premio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Premio entity.
     *
     * @Route("/{id}", name="admin_premio_show")
     * @Method("GET")
     */
    public function showAction(Premio $premio)
    {
        $deleteForm = $this->createDeleteForm($premio);

        return $this->render('premio/show.html.twig', array(
            'premio' => $premio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Premio entity.
     *
     * @Route("/{id}/edit", name="admin_premio_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Premio $premio)
    {
        $deleteForm = $this->createDeleteForm($premio);
        $editForm = $this->createForm('AppBundle\Form\PremioType', $premio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($premio);
            $em->flush();

            return $this->redirectToRoute('admin_premio_edit', array('id' => $premio->getId()));
        }

        return $this->render('premio/edit.html.twig', array(
            'premio' => $premio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Premio entity.
     *
     * @Route("/{id}", name="admin_premio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Premio $premio)
    {
        $form = $this->createDeleteForm($premio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($premio);
            $em->flush();
        }

        return $this->redirectToRoute('admin_premio_index');
    }

    /**
     * Creates a form to delete a Premio entity.
     *
     * @param Premio $premio The Premio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Premio $premio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_premio_delete', array('id' => $premio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
