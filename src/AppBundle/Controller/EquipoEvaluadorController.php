<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\EquipoEvaluador;
use AppBundle\Entity\Premio;
use AppBundle\Form\EquipoEvaluadorType;
use AppBundle\Form\EquipoEvaluadorFilterType;

use AppBundle\Utils\Utils;

/**
 * EquipoEvaluador controller.
 *
 * @Route("/admin/equipoevaluador")
 */
class EquipoEvaluadorController extends Controller
{
    /**
     * Lists all EquipoEvaluador entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="admin_equipoevaluador_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        $equipos = $this->get('app.service.equipo_evaluador')
            ->getEquiposDelPremio($premioActual);

        /*list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);

        $equipoEvaluadors = $this->paginate($queryBuilder, $request);

        return $this->render('equipoevaluador/index.html.twig', array(
            'equipoEvaluadors' => $equipoEvaluadors,
            'filterForm' => $filterForm->createView(),
            'premioActual' => $premioActual,
        ));*/
        

        return $this->render('equipoevaluador/index.html.twig', array(
            'equipos'      => $equipos,
            'premioActual' => $premioActual,
        ));
    }


    /**
     * Filters EquipoEvaluador entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request, Premio $premio)
    {

        $filterForm = $this->createForm(EquipoEvaluadorFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:EquipoEvaluador')
            ->getEquiposDelPremioQb($premio);
        
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
     * Filters EquipoEvaluador entities.
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
     * Creates a new EquipoEvaluador entity.
     *
     * @Route("/new", name="admin_equipoevaluador_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        $equipoEvaluador = new EquipoEvaluador();
        $equipoEvaluador->setPremio($premioActual);

        $form = $this->createForm('AppBundle\Form\EquipoEvaluadorType', $equipoEvaluador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipoEvaluador);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('admin_equipoevaluador_show', array('id' => $equipoEvaluador->getId()));
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('equipoevaluador/new.html.twig', array(
            'equipoEvaluador' => $equipoEvaluador,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a EquipoEvaluador entity.
     *
     * @Route("/{id}/show", name="admin_equipoevaluador_show")
     * @Method("GET")
     */
    public function showAction(EquipoEvaluador $equipoEvaluador)
    {
        $deleteForm = $this->createDeleteForm($equipoEvaluador);

        return $this->render('equipoevaluador/show.html.twig', array(
            'equipoEvaluador' => $equipoEvaluador,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EquipoEvaluador entity.
     *
     * @Route("/{id}/edit", name="admin_equipoevaluador_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EquipoEvaluador $equipoEvaluador)
    {
        $deleteForm = $this->createDeleteForm($equipoEvaluador);
        $editForm = $this->createForm('AppBundle\Form\EquipoEvaluadorType', $equipoEvaluador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipoEvaluador);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('admin_equipoevaluador_edit', array('id' => $equipoEvaluador->getId()));
        }

        if ($editForm->isSubmitted() && !$editForm->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('equipoevaluador/edit.html.twig', array(
            'equipoEvaluador' => $equipoEvaluador,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a EquipoEvaluador entity.
     *
     * @Route("/{id}", name="admin_equipoevaluador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EquipoEvaluador $equipoEvaluador)
    {
        $form = $this->createDeleteForm($equipoEvaluador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipoEvaluador);
            $em->flush();

            $this->addFlash(
                'success',
                'Datos eliminados correctamente.'
            );
        }

        return $this->redirectToRoute('admin_equipoevaluador_index');
    }

    /**
     * Creates a form to delete a EquipoEvaluador entity.
     *
     * @param EquipoEvaluador $equipoEvaluador The EquipoEvaluador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EquipoEvaluador $equipoEvaluador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_equipoevaluador_delete', array('id' => $equipoEvaluador->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Asignación de equipos a evaluadores
     *
     * @Route("/asignaciones", name="admin_equipoevaluador_asignaciones")
     * @Method({"GET", "POST"})
     */
    public function asignacionesAction(Request $request) {
        /* Obtiene la instancia del premio actual */
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        /* Crea automáticamente los equipos de premio actual si fuera necesario. */
        $this->get('app.service.equipo_evaluador')
            ->createEquiposFaltantes($premioActual);

        $em = $this->getDoctrine()->getManager();

        $evaluadoresDelPremio = $em->getRepository('AppBundle:EvaluadorPremio')
            ->getEvaluadoresAprobadosYActivosDelPremio($premioActual);

        $form = $this->createForm(
            'AppBundle\Form\AsignacionEquiposType',
            array('evaluadores' => $evaluadoresDelPremio)
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();

            if (count($data['evaluadores'])) {
                foreach ($data['evaluadores'] as $ep) {
                    $em->persist($ep);
                }

                $em->flush();
            }

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('admin_equipoevaluador_index');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('equipoevaluador/asignaciones.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Muesta las respuestas de los evaluadores
     * 
     * @Route("/respuestas-evaluadores/{id}", name="admin_equipoevaluador_respuestas-evaluadores")
     */
    public function showRespuestasEvaluadoresAction(EquipoEvaluador $equipo)
    {
        $this->get('app.service.equipo_evaluador')
            ->verificarUsuarioParaVerOEditar($equipo);

        if (!$equipo->getPremio()->getFormularioEvaluacion()) {
          throw new \Exception(
            "No se ha seleccionado formulario para el premio."
          );
        }

        return $this->render(
          'equipoevaluador/respuestas-evaluadores.html.twig',
          array('equipo' => $equipo)
        );
    }

    /**
     * pdf las respuestas de los evaluadores
     * 
     * @Route("/pdf-respuestas-evaluadores/{id}", name="admin_equipoevaluador_pdf-respuestas-evaluadores")
     */
    public function pdfRespuestasEvaluadoresAction(EquipoEvaluador $equipo)
    {
        $this->get('app.service.equipo_evaluador')
            ->verificarUsuarioParaVerOEditar($equipo);

        if (!$equipo->getPremio()->getFormularioEvaluacion()) {
          throw new \Exception(
            "No se ha seleccionado formulario para el premio."
          );
        }

        $html = $this->renderView(
            'equipoevaluador/pdf-respuestas-evaluadores.html.twig',
            array('equipo' => $equipo)
        );

        $filename = 'Evaluaciones del equipo - ' . $equipo
                  . ' - PPC'
                  . $equipo->getPremio()->getAnio();

        $filename = Utils::sanitizeForFileName($filename) . '.pdf';

        $pdfOptions = array(
            'orientation' => "Landscape",
            'page-size'   => "Legal",
            'header-html' => $this->renderView('::base-pdf-header.html.twig'),
            'footer-html' => $this->renderView('::base-pdf-footer.html.twig'),
        );

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html, $pdfOptions),
            200,
            array(
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            )
        );
    }

    /**
     * Planilla de evaluacion consensuada (del equipo).
     *
     * @Route("/formulario-evaluacion/{id}", name="admin_equipoevaluador_form-evaluacion")
     * @Method({"GET", "POST"})
     */
    public function formEvaluacionAction(Request $request, EquipoEvaluador $equipo)
    {
        $this->get('app.service.equipo_evaluador')
            ->verificarUsuarioParaVerOEditar($equipo);

        $feq = $this->get('app.service.equipo_evaluador')
            ->crearFormularioSiEsNecesario($equipo);

        //die(var_dump($feq->getRespuestas()->count()));
        $formType = !$feq->getEnviado()
                  ? 'AppBundle\Form\FormularioEquipoConsensuadoType'
                  : 'AppBundle\Form\FormularioEquipoPostVisitaType';

        $form = $this->createForm($formType, $feq);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feq);
            $em->flush();
            
            $this->addFlash(
              'success',
              'Los datos fueron guardados correctamente.'
            );

            $sc = $this->container->get('security.authorization_checker');

            $toRoute = !$sc->isGranted('ROLE_ADMIN') && $sc->isGranted('ROLE_EVALUADOR')
                    ? 'evaluador_panel' : 'admin_equipoevaluador_index';
            
            return $this->redirectToRoute($toRoute);
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render(
            'equipoevaluador/formulario-evaluacion.html.twig',
            array(
                'form' => $form->createView(),
                'fep'  => $feq
            )
        );
    }

    /**
     * Envío de la planilla de evaluación individual.
     *
     * @Route("/envio-formulario-evaluacion/{id}", name="admin_equipoevaluador_envio-form-evaluacion")
     * @Method({"GET"})
     */
    public function envioFormEvaluacionAction(Request $request, EquipoEvaluador $equipo)
    {
        $this->get('app.service.equipo_evaluador')
            ->verificarUsuarioParaVerOEditar($equipo);

        $feq = $equipo->getFormulario();

        if (!$feq) {
            $msg = 'NO SE HA COMPLETADO el formulario de evaluación de CONSENSO.';
            throw new \Exception($msg);
        }

        if (!$feq->getEnviado()){
            $em = $this->getDoctrine()->getManager();
            $feq->setEnviado(true);
            $em->persist($feq);
            $em->flush();

            $this->addFlash(
                'success',
                'El formulario fue enviado correctamente.'
            );
        } else {
            $this->addFlash(
                'success',
                'El formulario ya había sido enviado anteriormente.'
            );
        }

        return $this->redirectToRoute('evaluador_panel');
    }

    /**
     * Envío de la planilla de evaluación individual.
     *
     * @Route("/envio-formulario-evaluacion-post-visita/{id}", name="admin_equipoevaluador_envio-form-evaluacion-post-visita")
     * @Method({"GET"})
     */
    public function envioFormEvaluacionPostVisitaAction(Request $request, EquipoEvaluador $equipo)
    {
        $this->get('app.service.equipo_evaluador')
            ->verificarUsuarioParaVerOEditar($equipo);

        $feq = $equipo->getFormulario();

        if (!$feq) {
            $msg = 'PRIMERO DEBE COMPLETAR el formulario de evaluación de CONSENSO.';
            throw new \Exception($msg);
        }

        if (!$feq->getEnviado()) {
            $msg = 'PRIMERO DEBE ENVIAR el formulario de evaluación de CONSENSO.';
            throw new \Exception($msg);
        }

        if (!$feq->getEnviadoPostVisita()){
            $em = $this->getDoctrine()->getManager();
            $feq->setEnviadoPostVisita(true);
            $em->persist($feq);
            $em->flush();

            $this->addFlash(
                'success',
                'El formulario fue enviado correctamente.'
            );
        } else {
            $this->addFlash(
                'success',
                'El formulario ya había sido enviado anteriormente.'
            );
        }

        return $this->redirectToRoute('evaluador_panel');
    }

    /**
     * Envío de la planilla de evaluación individual.
     *
     * @Route("/show-formulario-evaluacion/{id}", name="admin_equipoevaluador_show-form-evaluacion")
     * @Method({"GET"})
     */
    public function showFormEvaluacionAction(Request $request, EquipoEvaluador $equipo) {
        $showPostVisita = $request->query->get('pv') == 'true' ? true : false;

        $this->get('app.service.equipo_evaluador')
            ->verificarUsuarioParaVerOEditar($equipo);

        $feq = $equipo->getFormulario();

        if (!$feq) {

          $this->addFlash(
              'warning',
              'NO SE HA COMPLETADO el formulario de evaluación de CONSENSO.'
          );

          $sc = $this->container->get('security.authorization_checker');

          $toRoute = !$sc->isGranted('ROLE_ADMIN') && $sc->isGranted('ROLE_EVALUADOR')
                   ? 'evaluador_panel' : 'admin_equipoevaluador_index';
                   
          return $this->redirectToRoute($toRoute);
        }

        return $this->render(
          'equipoevaluador/formulario-evaluacion.show.html.twig',
          array(
            'feq' => $feq,
            'showPostVisita' => $showPostVisita
          )
        );
    }

    /**
     * Pdf del Formulario de Evaluación de Consenso.
     *
     * @Route("/pdf-formulario-evaluacion/{id}", name="admin_equipoevaluador_pdf-formulario-evaluacion")
     * @Method("GET")
     */
    public function pdfFormularioEvaluacionAction(Request $request, EquipoEvaluador $equipo)
    {
        $showPostVisita = $request->query->get('pv') == 'true' ? true : false;

        $this->get('app.service.equipo_evaluador')
            ->verificarUsuarioParaVerOEditar($equipo);

        $feq = $equipo->getFormulario();

        if (!$feq) {
          $this->addFlash(
              'warning',
              'NO SE HA COMPLETADO el formulario de evaluación de CONSENSO.'
          );

          $sc = $this->container->get('security.authorization_checker');

          $toRoute = !$sc->isGranted('ROLE_ADMIN') && $sc->isGranted('ROLE_EVALUADOR')
                   ? 'evaluador_panel' : 'admin_equipoevaluador_index';

          return $this->redirectToRoute($toRoute);
        }

        $html = $this->renderView(
            'equipoevaluador/pdf-formulario-evaluacion.html.twig',
            array(
              'feq' => $feq,
              'showPostVisita' => $showPostVisita,
            )
        );

        $filename = ($showPostVisita ? 'Planilla de Evaluación Post Visita' : 'Planilla de Evaluación de consenso')
                  . ' - ' . $equipo
                  . ' - PPC'
                  . $equipo->getPremio()->getAnio();

        $filename = Utils::sanitizeForFileName($filename) . '.pdf';

        $pdfOptions = array(
            'orientation' => "Landscape",
            'page-size'   => "Legal",
            'header-html' => $this->renderView('::base-pdf-header.html.twig'),
            'footer-html' => $this->renderView('::base-pdf-footer.html.twig'),
        );

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html, $pdfOptions),
            200,
            array(
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            )
        );
    }
}
