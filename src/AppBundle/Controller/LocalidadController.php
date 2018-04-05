<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Localidad;
use AppBundle\Form\LocalidadType;
use AppBundle\Form\LocalidadFilterType;
use AppBundle\Utils\Utils;

/**
 * Localidad controller.
 *
 * @Route("/admin/localidad")
 */
class LocalidadController extends Controller
{
    /**
     * Lists all Localidad entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="admin_localidad_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        list($queryBuilder, $filterForm) = $this->filter($request);

        $localidads = $this->paginate($queryBuilder, $request);

        return $this->render('localidad/index.html.twig', array(
            'localidads' => $localidads,
            'filterForm' => $filterForm->createView(),
        ));
    }


    /**
     * Filters Localidad entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request)
    {

        $filterForm = $this->createForm(LocalidadFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Localidad')->createQueryBuilder('e');
        
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
     * Filters Localidad entities.
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
     * Creates a new Localidad entity.
     *
     * @Route("/new", name="admin_localidad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $localidad = new Localidad();
        $form = $this->createForm('AppBundle\Form\LocalidadType', $localidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($localidad);
            $em->flush();

            return $this->redirectToRoute('admin_localidad_show', array('id' => $localidad->getId()));
        }

        return $this->render('localidad/new.html.twig', array(
            'localidad' => $localidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Localidad entity.
     *
     * @Route("/{id}", name="admin_localidad_show")
     * @Method("GET")
     */
    public function showAction(Localidad $localidad)
    {
        $deleteForm = $this->createDeleteForm($localidad);

        return $this->render('localidad/show.html.twig', array(
            'localidad' => $localidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Localidad entity.
     *
     * @Route("/{id}/edit", name="admin_localidad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Localidad $localidad)
    {
        $deleteForm = $this->createDeleteForm($localidad);
        $editForm = $this->createForm('AppBundle\Form\LocalidadType', $localidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($localidad);
            $em->flush();

            return $this->redirectToRoute('admin_localidad_edit', array('id' => $localidad->getId()));
        }

        return $this->render('localidad/edit.html.twig', array(
            'localidad' => $localidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Localidad entity.
     *
     * @Route("/{id}", name="admin_localidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Localidad $localidad)
    {
        $form = $this->createDeleteForm($localidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($localidad);
            $em->flush();
        }

        return $this->redirectToRoute('admin_localidad_index');
    }

    /**
     * Creates a form to delete a Localidad entity.
     *
     * @param Localidad $localidad The Localidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Localidad $localidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_localidad_delete', array('id' => $localidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Select2 Search action
     *
     * @Method("GET")
     * @Route("/select2/search", name="admin_localidad_select2_search")
     */
    public function select2SearchAction(Request $request)
    {
        $q = $request->get('q');

        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('AppBundle:Localidad')->createQueryBuilder('l');
        $qb ->innerJoin('l.provincia', 'p');

        $terms = Utils::strToWords($q);

        foreach ($terms as $k => $v) {
            $qb ->andWhere(
                    'l.nombre LIKE :lnombre' . $k .
                    ' OR l.codigoPostal LIKE :lcodigoPostal' . $k .
                    ' OR p.nombre LIKE :pnombre' .$k
                )
                ->setParameter('lnombre' . $k, '%' . $v . '%')
                ->setParameter('lcodigoPostal' . $k, '%' . $v . '%')
                ->setParameter('pnombre' . $k, '%' . $v . '%')
            ;
        }

        $results = $qb->getQuery()->getResult();

        $localidades = array();
        foreach ($results as $r) {
            $localidades[] = array('id' => $r->getId(), 'text' => $r->__toString());
        }

        return new JsonResponse($localidades);
    }
}
