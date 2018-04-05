<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Premio;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Evaluador;
use AppBundle\Entity\Localizacion;
use AppBundle\Entity\EvaluadorEstudioUniversitario;
use AppBundle\Entity\EvaluadorCriterioPremio;
use AppBundle\Entity\EvaluadorPremio;
use AppBundle\Form\EvaluadorType;
use AppBundle\Form\EvaluadorFilterType;

use AppBundle\Utils\Utils;

/**
 * Evaluador controller.
 *
 * @Route("/evaluador")
 */
class EvaluadorController extends Controller
{
    /**
     * Lists all Evaluador entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="evaluador_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        list($queryBuilder, $filterForm) = $this->filter($request);

        $evaluadors = $this->paginate($queryBuilder, $request);

        return $this->render('evaluador/index.html.twig', array(
            'evaluadors' => $evaluadors,
            'filterForm' => $filterForm->createView(),
        ));
    }


    /**
     * Filters Evaluador entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request)
    {

        $filterForm = $this->createForm(EvaluadorFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Evaluador')->createQueryBuilder('e');

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
     * Filters Evaluador entities.
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
     * Creates a new Evaluador entity.
     *
     * @Route("/new", name="evaluador_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $premioService = $this->get('app.service.premio'); 
        $premioService->verificarCondicionesParaInscripcion();

        $premioActual = $premioService->getPremioActual();

        $evaluador = $this->get('app.service.evaluador')->getNuevaEntidadEvaluador();

        $form = $this->createForm('AppBundle\Form\EvaluadorType', $evaluador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $evaluadorPremio = new EvaluadorPremio();
            $evaluadorPremio->setPremio($premioActual);
            $evaluador->addEvaluadorPremio($evaluadorPremio);

            $em->persist($evaluador);
            $em->flush();

            $this->get('app.service.evaluador')->generarUsuarioParaEvaluador($evaluador);
            $this->get('app.service.evaluador')->sendNuevoUsuarioEmail($evaluador);

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            if (!$this->getUser()) {
                return  $this->redirectToRoute('evaluador_registered', array('id' => $evaluador->getId()));
            }

            return $this->redirectToRoute('evaluador_show', array('id' => $evaluador->getId()));
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('evaluador/new.html.twig', array(
            'evaluador' => $evaluador,
            'form' => $form->createView(),
        ));
    }

    /**
     * Show Registered message
     * 
     * @Route("/{id}/registered", name="evaluador_registered")
     */
    public function registeredMessageAction(Evaluador $evaluador)
    {
        $premioActual = $this->get('app.service.premio')->getPremioActual(); 

        return $this->render(
            'evaluador/registered.html.twig',
            array(
                'evaluador'    => $evaluador,
                'premioActual' => $premioActual,
            )
        );
    }

    /**
     * Finds and displays a Evaluador entity.
     *
     * @Route("/{id}/show", name="evaluador_show")
     * @Method("GET")
     */
    public function showAction(Evaluador $evaluador)
    {
        //$this->get('app.service.evaluador')->sendNuevoUsuarioEmail($evaluador);
        $this->get('app.service.evaluador')->verificarUsuarioParaVerOEditar($evaluador);

        $deleteForm = $this->createDeleteForm($evaluador);

        return $this->render('evaluador/show.html.twig', array(
            'evaluador' => $evaluador,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and generates a pdf file of an Evaluador entity.
     *
     * @Route("/{id}/pdf", name="evaluador_pdf")
     * @Method("GET")
     */
    public function pdfAction(Evaluador $evaluador)
    {
        $this->get('app.service.evaluador')->verificarUsuarioParaVerOEditar($evaluador);

        $html = $this->renderView('evaluador/pdf.html.twig', array(
            'evaluador' => $evaluador,
        ));

        $filename = 'evaluador';
        $filename = Utils::sanitizeForFileName($filename) . '.pdf';

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            )
        );
    }

    /**
     * Pdf of Evaluador entity list.
     *
     * @Route("/pdf", name="evaluador_list_pdf")
     * @Method("GET")
     */
    public function listPdfAction(Request $request)
    {
        list($queryBuilder, $filterForm) = $this->filter($request);

        $evaluadores = $queryBuilder->getQuery()->getResult();

        $html = $this->renderView('evaluador/pdf-list.html.twig', array(
            'evaluadors' => $evaluadores,
        ));

        $filename = 'lista_evaluador';
        $filename = Utils::sanitizeForFileName($filename) . '.pdf';

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            )
        );
    }

    /**
     * Displays a form to edit an existing Evaluador entity.
     *
     * @Route("/{id}/edit", name="evaluador_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Evaluador $evaluador)
    {
        $this->get('app.service.evaluador')->verificarUsuarioParaVerOEditar($evaluador);
        $this->get('app.service.evaluador')->agregarCiteriosPremio($evaluador);

        $deleteForm = $this->createDeleteForm($evaluador);
        $editForm = $this->createForm('AppBundle\Form\EvaluadorType', $evaluador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluador);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('evaluador_edit', array('id' => $evaluador->getId()));
        }

        if ($editForm->isSubmitted() && !$editForm->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('evaluador/edit.html.twig', array(
            'evaluador' => $evaluador,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Evaluador entity.
     *
     * @Route("/{id}", name="evaluador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Evaluador $evaluador)
    {
        $form = $this->createDeleteForm($evaluador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$evaluador->setUsuario(null);
            $em->remove($evaluador);
            $em->flush();

            $this->addFlash(
                'success',
                'Datos eliminados correctamente.'
            );
        }

        return $this->redirectToRoute('evaluador_index');
    }


    /**
     * @Route("/panel", name="evaluador_panel") 
     */
    public function panelAction()
    {
        $evaluador = $this->getUser()->getEvaluador();
        $premioActual = $this->get( 'app.service.premio' )->getPremioActual();

        if (!$evaluador) {
            throw new \Exception(
                'Ud. no es un usuario evaluador.'
            );
        }
        
        return $this->render('evaluador/panel.html.twig', array(
            'evaluador' => $evaluador, 'premioActual' => $premioActual));
    }


    /**
     * Creates a form to delete a Evaluador entity.
     *
     * @param Evaluador $evaluador The Evaluador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evaluador $evaluador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evaluador_delete', array('id' => $evaluador->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * ESTO ES SOLO PARA EVALUADORES YA EXISTENTES
     *
     * @Route("/{id}/inscripcion-premio-actual", name="evaluador_inscripcion-permio-actual")
     * @Method({"GET"})
     */
    public function inscripcionPremioActualAction(Request $request, Evaluador $evaluador)
    {
        $this->get('app.service.evaluador')->verificarUsuarioParaVerOEditar($evaluador);

        /** @var Premio $premioActual */
        $premioActual = $this->get( 'app.service.premio' )->getPremioActual();

        if (!$premioActual) {
            throw new \Exception('No se definió la instancia de premio actual');
        }

        if (!$evaluador->getInscripcionEn($premioActual)) {
            $em = $this->getDoctrine()->getManager();

            $evaluadorPremio = new EvaluadorPremio();
            $evaluadorPremio->setPremio($premioActual);
            $evaluador->addEvaluadorPremio($evaluadorPremio);

            $em->persist($evaluador);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Se ha inscripto correctamente al %s', $premioActual->getNombre())
            );

        } else {
            $this->addFlash('info', 'El evaluador ya se encuentra inscripto en el premio actual.');
        }

        return $this->redirectToRoute('evaluador_panel');
    }

    /**
     * @Route("/{id}/prueba-email")
     */
    public function pruebaEmailAction(Evaluador $evaluador) {
        /** @var Premio $premioActual */
        $premioActual = $this->get( 'app.service.premio' )->getPremioActual();

        if (!$premioActual) {
            throw new \Exception('No se definió la instancia de premio actual');
        }

        //$this->get('app.service.evaluador')->sendNuevoUsuarioEmail($evaluador);

        return $this->render(
            'evaluador/email-nuevo_usuario.html.twig',
            array(
                //'bgImg'        => $assets->getUrl('images/fondo-contenido-light.png'),
                //'logoImg'      => $assets->getUrl('images/logo-premio-calidad-negro-email.png'),
                'evaluador'    => $evaluador,
                'premioActual' => $premioActual,
            )
        );
    }
}
