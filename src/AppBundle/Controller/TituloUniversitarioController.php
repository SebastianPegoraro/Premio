<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TituloUniversitario;
use AppBundle\Form\TituloUniversitarioType;
use AppBundle\Form\TituloUniversitarioFilterType;

/**
 * TituloUniversitario controller.
 *
 * @Route("/admin/titulouniversitario")
 */
class TituloUniversitarioController extends Controller
{
    /**
     * Lists all TituloUniversitario entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="admin_titulouniversitario_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        list($queryBuilder, $filterForm) = $this->filter($request);

        $tituloUniversitarios = $this->paginate($queryBuilder, $request);

        return $this->render('titulouniversitario/index.html.twig', array(
            'tituloUniversitarios' => $tituloUniversitarios,
            'filterForm' => $filterForm->createView(),
        ));
    }


    /**
     * Filters TituloUniversitario entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request)
    {

        $filterForm = $this->createForm(TituloUniversitarioFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:TituloUniversitario')->createQueryBuilder('e');
        
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
     * Filters TituloUniversitario entities.
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
     * Creates a new TituloUniversitario entity.
     *
     * @Route("/new", name="admin_titulouniversitario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tituloUniversitario = new TituloUniversitario();
        $form = $this->createForm('AppBundle\Form\TituloUniversitarioType', $tituloUniversitario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tituloUniversitario);
            $em->flush();

            return $this->redirectToRoute('admin_titulouniversitario_show', array('id' => $tituloUniversitario->getId()));
        }

        return $this->render('titulouniversitario/new.html.twig', array(
            'tituloUniversitario' => $tituloUniversitario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TituloUniversitario entity.
     *
     * @Route("/{id}", name="admin_titulouniversitario_show")
     * @Method("GET")
     */
    public function showAction(TituloUniversitario $tituloUniversitario)
    {
        $deleteForm = $this->createDeleteForm($tituloUniversitario);

        return $this->render('titulouniversitario/show.html.twig', array(
            'tituloUniversitario' => $tituloUniversitario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TituloUniversitario entity.
     *
     * @Route("/{id}/edit", name="admin_titulouniversitario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TituloUniversitario $tituloUniversitario)
    {
        $deleteForm = $this->createDeleteForm($tituloUniversitario);
        $editForm = $this->createForm('AppBundle\Form\TituloUniversitarioType', $tituloUniversitario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tituloUniversitario);
            $em->flush();

            return $this->redirectToRoute('admin_titulouniversitario_edit', array('id' => $tituloUniversitario->getId()));
        }

        return $this->render('titulouniversitario/edit.html.twig', array(
            'tituloUniversitario' => $tituloUniversitario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TituloUniversitario entity.
     *
     * @Route("/{id}", name="admin_titulouniversitario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TituloUniversitario $tituloUniversitario)
    {
        $form = $this->createDeleteForm($tituloUniversitario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tituloUniversitario);
            $em->flush();
        }

        return $this->redirectToRoute('admin_titulouniversitario_index');
    }

    /**
     * Creates a form to delete a TituloUniversitario entity.
     *
     * @param TituloUniversitario $tituloUniversitario The TituloUniversitario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TituloUniversitario $tituloUniversitario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_titulouniversitario_delete', array('id' => $tituloUniversitario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Select2 Search action
     *
     * @Method("GET")
     * @Route("/select2/search", name="admin_titulouniversitario_select2_search")
     */
    public function select2SearchAction(Request $request)
    {
        $q = $request->get('q');

        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('AppBundle:TituloUniversitario')->createQueryBuilder('tu');
        $qb ->andWhere('tu.nombre LIKE :nombre')
            ->select('tu.id as id, tu.nombre as text')
            ->setParameter('nombre', '%' . $q . '%');

        $titulos = $qb->getQuery()->getArrayResult();

        return new JsonResponse($titulos);
    }
}
