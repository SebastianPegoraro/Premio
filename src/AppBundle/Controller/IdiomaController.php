<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Idioma;
use AppBundle\Form\IdiomaType;
use AppBundle\Form\IdiomaFilterType;

/**
 * Idioma controller.
 *
 * @Route("/admin/idioma")
 */
class IdiomaController extends Controller
{
    /**
     * Lists all Idioma entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="admin_idioma_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        list($queryBuilder, $filterForm) = $this->filter($request);

        $idiomas = $this->paginate($queryBuilder, $request);

        return $this->render('idioma/index.html.twig', array(
            'idiomas' => $idiomas,
            'filterForm' => $filterForm->createView(),
        ));
    }


    /**
     * Filters Idioma entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request)
    {

        $filterForm = $this->createForm(IdiomaFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Idioma')->createQueryBuilder('e');
        
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
     * Filters Idioma entities.
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
     * Creates a new Idioma entity.
     *
     * @Route("/new", name="admin_idioma_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $idioma = new Idioma();
        $form = $this->createForm('AppBundle\Form\IdiomaType', $idioma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($idioma);
            $em->flush();

            return $this->redirectToRoute('admin_idioma_show', array('id' => $idioma->getId()));
        }

        return $this->render('idioma/new.html.twig', array(
            'idioma' => $idioma,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Idioma entity.
     *
     * @Route("/{id}", name="admin_idioma_show")
     * @Method("GET")
     */
    public function showAction(Idioma $idioma)
    {
        $deleteForm = $this->createDeleteForm($idioma);

        return $this->render('idioma/show.html.twig', array(
            'idioma' => $idioma,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Idioma entity.
     *
     * @Route("/{id}/edit", name="admin_idioma_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Idioma $idioma)
    {
        $deleteForm = $this->createDeleteForm($idioma);
        $editForm = $this->createForm('AppBundle\Form\IdiomaType', $idioma);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($idioma);
            $em->flush();

            return $this->redirectToRoute('admin_idioma_edit', array('id' => $idioma->getId()));
        }

        return $this->render('idioma/edit.html.twig', array(
            'idioma' => $idioma,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Idioma entity.
     *
     * @Route("/{id}", name="admin_idioma_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Idioma $idioma)
    {
        $form = $this->createDeleteForm($idioma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($idioma);
            $em->flush();
        }

        return $this->redirectToRoute('admin_idioma_index');
    }

    /**
     * Creates a form to delete a Idioma entity.
     *
     * @param Idioma $idioma The Idioma entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Idioma $idioma)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_idioma_delete', array('id' => $idioma->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Select2 Search action
     *
     * @Method("GET")
     * @Route("/select2/search", name="admin_idioma_select2_search")
     */
    public function select2SearchAction(Request $request)
    {
        $q = $request->get('q');

        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('AppBundle:Idioma')->createQueryBuilder('i');
        $qb ->andWhere('i.nombre LIKE :nombre')
            ->select('i.id as id, i.nombre as text')
            ->setParameter('nombre', '%' . $q . '%');

        $idiomas = $qb->getQuery()->getArrayResult();

        return new JsonResponse($idiomas);
    }
}
