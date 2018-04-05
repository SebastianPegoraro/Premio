<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CriterioEvaluacion;
use AppBundle\Form\CriterioEvaluacionType;
use AppBundle\Form\CriterioEvaluacionFilterType;

/**
 * CriterioEvaluacion controller.
 *
 * @Route("/admin/criterioevaluacion")
 */
class CriterioEvaluacionController extends Controller
{
    /**
     * Lists all CriterioEvaluacion entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="admin_criterioevaluacion_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        list($queryBuilder, $filterForm) = $this->filter($request);

        $criterioEvaluacions = $this->paginate($queryBuilder, $request);

        return $this->render('criterioevaluacion/index.html.twig', array(
            'criterioEvaluacions' => $criterioEvaluacions,
            'filterForm' => $filterForm->createView(),
        ));
    }


    /**
     * Filters CriterioEvaluacion entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request)
    {

        $filterForm = $this->createForm(CriterioEvaluacionFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:CriterioEvaluacion')->createQueryBuilder('e');
        
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
     * Filters CriterioEvaluacion entities.
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
     * Creates a new CriterioEvaluacion entity.
     *
     * @Route("/new", name="admin_criterioevaluacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $criterioEvaluacion = new CriterioEvaluacion();
        $form = $this->createForm('AppBundle\Form\CriterioEvaluacionType', $criterioEvaluacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($criterioEvaluacion);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('admin_criterioevaluacion_show', array('id' => $criterioEvaluacion->getId()));
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('criterioevaluacion/new.html.twig', array(
            'criterioEvaluacion' => $criterioEvaluacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CriterioEvaluacion entity.
     *
     * @Route("/{id}", name="admin_criterioevaluacion_show")
     * @Method("GET")
     */
    public function showAction(CriterioEvaluacion $criterioEvaluacion)
    {
        $deleteForm = $this->createDeleteForm($criterioEvaluacion);

        return $this->render('criterioevaluacion/show.html.twig', array(
            'criterioEvaluacion' => $criterioEvaluacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CriterioEvaluacion entity.
     *
     * @Route("/{id}/edit", name="admin_criterioevaluacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CriterioEvaluacion $criterioEvaluacion)
    {
        $deleteForm = $this->createDeleteForm($criterioEvaluacion);
        $editForm = $this->createForm('AppBundle\Form\CriterioEvaluacionType', $criterioEvaluacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($criterioEvaluacion);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('admin_criterioevaluacion_edit', array('id' => $criterioEvaluacion->getId()));
        }

        if ($editForm->isSubmitted() && !$editForm->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('criterioevaluacion/edit.html.twig', array(
            'criterioEvaluacion' => $criterioEvaluacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CriterioEvaluacion entity.
     *
     * @Route("/{id}", name="admin_criterioevaluacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CriterioEvaluacion $criterioEvaluacion)
    {
        $form = $this->createDeleteForm($criterioEvaluacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($criterioEvaluacion);
            $em->flush();

            $this->addFlash(
                'success',
                'Datos eliminados correctamente.'
            );
        }

        return $this->redirectToRoute('admin_criterioevaluacion_index');
    }

    /**
     * Creates a form to delete a CriterioEvaluacion entity.
     *
     * @param CriterioEvaluacion $criterioEvaluacion The CriterioEvaluacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CriterioEvaluacion $criterioEvaluacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_criterioevaluacion_delete', array('id' => $criterioEvaluacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
