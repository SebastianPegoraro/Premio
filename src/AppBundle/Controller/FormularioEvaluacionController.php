<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\FormularioEvaluacion;
use AppBundle\Form\FormularioEvaluacionType;
use AppBundle\Form\FormularioEvaluacionFilterType;

/**
 * FormularioEvaluacion controller.
 *
 * @Route("/admin/formularioevaluacion")
 */
class FormularioEvaluacionController extends Controller
{
    /**
     * Lists all FormularioEvaluacion entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="admin_formularioevaluacion_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        list($queryBuilder, $filterForm) = $this->filter($request);

        $formularioEvaluacions = $this->paginate($queryBuilder, $request);

        return $this->render('formularioevaluacion/index.html.twig', array(
            'formularioEvaluacions' => $formularioEvaluacions,
            'filterForm' => $filterForm->createView(),
        ));
    }


    /**
     * Filters FormularioEvaluacion entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request)
    {

        $filterForm = $this->createForm(FormularioEvaluacionFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:FormularioEvaluacion')->createQueryBuilder('e');
        
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
     * Filters FormularioEvaluacion entities.
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
     * Creates a new FormularioEvaluacion entity.
     *
     * @Route("/new", name="admin_formularioevaluacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formularioEvaluacion = new FormularioEvaluacion();
        $form = $this->createForm('AppBundle\Form\FormularioEvaluacionType', $formularioEvaluacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formularioEvaluacion);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('admin_formularioevaluacion_show', array('id' => $formularioEvaluacion->getId()));
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('formularioevaluacion/new.html.twig', array(
            'formularioEvaluacion' => $formularioEvaluacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FormularioEvaluacion entity.
     *
     * @Route("/{id}", name="admin_formularioevaluacion_show")
     * @Method("GET")
     */
    public function showAction(FormularioEvaluacion $formularioEvaluacion)
    {
        $deleteForm = $this->createDeleteForm($formularioEvaluacion);

        return $this->render('formularioevaluacion/show.html.twig', array(
            'formularioEvaluacion' => $formularioEvaluacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FormularioEvaluacion entity.
     *
     * @Route("/{id}/edit", name="admin_formularioevaluacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FormularioEvaluacion $formularioEvaluacion)
    {
        $deleteForm = $this->createDeleteForm($formularioEvaluacion);
        $editForm = $this->createForm('AppBundle\Form\FormularioEvaluacionType', $formularioEvaluacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formularioEvaluacion);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('admin_formularioevaluacion_edit', array('id' => $formularioEvaluacion->getId()));
        }

        if ($editForm->isSubmitted() && !$editForm->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('formularioevaluacion/edit.html.twig', array(
            'formularioEvaluacion' => $formularioEvaluacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a FormularioEvaluacion entity.
     *
     * @Route("/{id}", name="admin_formularioevaluacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FormularioEvaluacion $formularioEvaluacion)
    {
        $form = $this->createDeleteForm($formularioEvaluacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formularioEvaluacion);
            $em->flush();

            $this->addFlash(
                'success',
                'Datos eliminados correctamente.'
            );
        }

        return $this->redirectToRoute('admin_formularioevaluacion_index');
    }

    /**
     * Creates a form to delete a FormularioEvaluacion entity.
     *
     * @param FormularioEvaluacion $formularioEvaluacion The FormularioEvaluacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FormularioEvaluacion $formularioEvaluacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_formularioevaluacion_delete', array('id' => $formularioEvaluacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
