<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Provincia;
use AppBundle\Form\ProvinciaType;
use AppBundle\Form\ProvinciaFilterType;

/**
 * Provincia controller.
 *
 * @Route("/admin/provincia")
 */
class ProvinciaController extends Controller
{
    /**
     * Lists all Provincia entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="admin_provincia_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        list($queryBuilder, $filterForm) = $this->filter($request);

        $provincias = $this->paginate($queryBuilder, $request);

        return $this->render('provincia/index.html.twig', array(
            'provincias' => $provincias,
            'filterForm' => $filterForm->createView(),
        ));
    }


    /**
     * Filters Provincia entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request)
    {

        $filterForm = $this->createForm(ProvinciaFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Provincia')->createQueryBuilder('e');
        
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
     * Filters Provincia entities.
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
     * Creates a new Provincia entity.
     *
     * @Route("/new", name="admin_provincia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $provincium = new Provincia();
        $form = $this->createForm('AppBundle\Form\ProvinciaType', $provincium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provincium);
            $em->flush();

            return $this->redirectToRoute('admin_provincia_show', array('id' => $provincium->getId()));
        }

        return $this->render('provincia/new.html.twig', array(
            'provincium' => $provincium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Provincia entity.
     *
     * @Route("/{id}", name="admin_provincia_show")
     * @Method("GET")
     */
    public function showAction(Provincia $provincium)
    {
        $deleteForm = $this->createDeleteForm($provincium);

        return $this->render('provincia/show.html.twig', array(
            'provincium' => $provincium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Provincia entity.
     *
     * @Route("/{id}/edit", name="admin_provincia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Provincia $provincium)
    {
        $deleteForm = $this->createDeleteForm($provincium);
        $editForm = $this->createForm('AppBundle\Form\ProvinciaType', $provincium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provincium);
            $em->flush();

            return $this->redirectToRoute('admin_provincia_edit', array('id' => $provincium->getId()));
        }

        return $this->render('provincia/edit.html.twig', array(
            'provincium' => $provincium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Provincia entity.
     *
     * @Route("/{id}", name="admin_provincia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Provincia $provincium)
    {
        $form = $this->createDeleteForm($provincium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($provincium);
            $em->flush();
        }

        return $this->redirectToRoute('admin_provincia_index');
    }

    /**
     * Creates a form to delete a Provincia entity.
     *
     * @param Provincia $provincium The Provincia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Provincia $provincium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_provincia_delete', array('id' => $provincium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
