<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\EvaluadorPremio;
use AppBundle\Form\EvaluadorPremioFilterType;
use AppBundle\Entity\Premio;
use AppBundle\Entity\FormularioEvaluadorPremio;
use AppBundle\Entity\RespuestaEvaluacion;
use AppBundle\Entity\CriterioEvaluacion;
use AppBundle\Utils\Utils;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * EvaluadorPremio controller.
 *
 * @Route("/admin/evaluadorpremio")
 */
class EvaluadorPremioController extends Controller
{
    /**
     * Lists all EvaluadorPremio entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="admin_evaluadorpremio_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);

        $evaluadorPremios = $this->paginate($queryBuilder, $request);

        return $this->render('evaluadorpremio/index.html.twig', array(
            'evaluadorPremios' => $evaluadorPremios,
            'filterForm'       => $filterForm->createView(),
            'premioActual'     => $premioActual,
        ));
    }


    /**
     * Filters EvaluadorPremio entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request, Premio $premio)
    {
        $filterForm = $this->createForm(EvaluadorPremioFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:EvaluadorPremio')
            ->createQueryBuilder('ep')
            ->innerJoin('ep.evaluador', 'e')
            ->andWhere('ep.premio = :premio')
            ->orderBy('e.apellido')
            ->addOrderBy('e.nombre')
            ->setParameter('premio', $premio);

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
     * Filters EvaluadorPremio entities.
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
     * Finds and displays a EvaluadorPremio entity.
     *
     * @Route("/{id}/show", name="admin_evaluadorpremio_show")
     * @Method("GET")
     */
    public function showAction(EvaluadorPremio $evaluadorPremio)
    {
        $deleteForm = $this->createDeleteForm($evaluadorPremio);

        return $this->render('evaluadorpremio/show.html.twig', array(
            'evaluadorPremio' => $evaluadorPremio,
            'delete_form'     => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and generates a pdf file of an Evaluador entity.
     *
     * @Route("/{id}/pdf", name="admin_evaluadorpremio_pdf")
     * @Method("GET")
     */
    public function pdfAction(EvaluadorPremio $evaluadorPremio)
    {
        $html = $this->renderView('evaluadorpremio/pdf.html.twig', array(
            'evaluadorPremio' => $evaluadorPremio,
        ));

        $filename = $evaluadorPremio->getEvaluador()
                  . ' - Premio Provincial a la Calidad '
                  . $evaluadorPremio->getPremio()->getAnio();

        $filename = Utils::sanitizeForFileName($filename) . '.pdf';

        $pdfOptions = array(
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
     * Finds and displays a Evaluador entity.
     *
     * @Route("/pdf", name="admin_evaluadorpremio_list_pdf")
     * @Method("GET")
     */
    public function listPdfAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);

        $evaluadorPremios = $queryBuilder->getQuery()->getResult();

        $html = $this->renderView('evaluadorpremio/pdf-list.html.twig', array(
            'evaluadorPremios' => $evaluadorPremios,
            'premioActual'     => $premioActual,
            'filterForm'       => $filterForm->createView(),
        ));

        $filename = 'evaluadores - Premio Provincial a la Calidad ' . $premioActual->getAnio();
        $filename = Utils::sanitizeForFileName($filename) . '.pdf';

        $pdfOptions = array(
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
     * Displays a form to edit an existing EvaluadorPremio entity.
     *
     * @Route("/{id}/edit", name="admin_evaluadorpremio_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EvaluadorPremio $evaluadorPremio)
    {
        //$this->get('app.service.evaluador')->verificarUsuarioParaVerOEditar($evaluadorPremio->getEvaluador());
        $this->get('app.service.evaluador')->agregarCiteriosPremio($evaluadorPremio->getEvaluador());

        $deleteForm = $this->createDeleteForm($evaluadorPremio);
        $editForm = $this->createForm('AppBundle\Form\EvaluadorPremioType', $evaluadorPremio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluadorPremio);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('admin_evaluadorpremio_edit', array('id' => $evaluadorPremio->getId()));
        }

        if ($editForm->isSubmitted() && !$editForm->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('evaluadorpremio/edit.html.twig', array(
            'evaluadorPremio' => $evaluadorPremio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Evaluador entity.
     *
     * @Route("/{id}", name="admin_evaluadorpremio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EvaluadorPremio $evaluadorPremio)
    {
        $form = $this->createDeleteForm($evaluadorPremio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evaluadorPremio);
            $em->flush();

            $this->addFlash(
                'success',
                'Datos eliminados correctamente.'
            );
        }

        return $this->redirectToRoute('admin_evaluadorpremio_index');
    }

    /**
     * Creates a form to delete a Evaluador entity.
     *
     * @param Evaluador $evaluador The Evaluador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EvaluadorPremio $evaluadorPremio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_evaluadorpremio_delete', array('id' => $evaluadorPremio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/evaluadores.{_format}", defaults={"_format"="xlsx"}, requirements={"_format"="csv|xls|xlsx"}, name="admin_evaluadorpremio_list_excel")
     * @Template(":evaluadorpremio:list-excel.xls.twig")
     */
    public function listExcelAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);
        $evaluadorPremios = $queryBuilder->getQuery()->getResult();

        return array(
            'evaluadorPremios' => $evaluadorPremios,
            'premioActual' => $premioActual,
        );
    }

    /**
     * Planilla de Evaluación individual.
     *
     * @Route("/formulario-evaluacion/{id}", name="admin_evaluadorpremio_form-evaluacion")
     * @Method({"GET", "POST"})
     */
    public function formEvaluacionAction(Request $request, EvaluadorPremio $evaluadorPremio)
    {
        $this->get('app.service.evaluador')->verificarUsuarioParaVerOEditar($evaluadorPremio->getEvaluador());
        if ($evaluadorPremio->getEstado() != EvaluadorPremio::ESTADO_ACTIVO) {
            $msg = sprintf(
                'Este evaluador no se encuentra en estado "%s". No puede completar el formulario de evaluación.',
                EvaluadorPremio::ESTADO_ACTIVO
            );
            throw new \Exception($msg);
        }

        $fep = $this->get('app.service.evaluador_premio')
            ->crearFormularioSiEsNecesario($evaluadorPremio);

        if ($fep->getEnviado()) {
            throw new \Exception('El formulario ya ha sido enviado. No puede ser modificado.');
        }

        $form = $this->createForm('AppBundle\Form\FormularioEvaluadorPremioType', $fep);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fep);
            $em->flush();
            
            $this->addFlash(
              'success',
              'Los datos fueron guardados correctamente.'
            );
            
            $sc = $this->container->get('security.authorization_checker');

            $toRoute = !$sc->isGranted('ROLE_ADMIN') && $sc->isGranted('ROLE_EVALUADOR')
                     ? 'evaluador_panel' : 'admin_evaluadorpremio_index';

            return $this->redirectToRoute($toRoute);
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render(
            'evaluadorpremio/formulario-evaluacion.html.twig',
            array(
                'form' => $form->createView(),
                'fep' => $fep
            )
        );
    }

    /**
     * Envío de la planilla de evaluación individual.
     *
     * @Route("/envio-formulario-evaluacion/{id}", name="admin_evaluadorpremio_envio-form-evaluacion")
     * @Method({"GET"})
     */
    public function envioFormEvaluacionAction(Request $request, EvaluadorPremio $evaluadorPremio)
    {
        $this->get('app.service.evaluador')->verificarUsuarioParaVerOEditar($evaluadorPremio->getEvaluador());
        if ($evaluadorPremio->getEstado() != EvaluadorPremio::ESTADO_ACTIVO) {
            $msg = sprintf(
                'Este evaluador no se encuentra en estado "%s". No puede completar el formulario de evaluación.',
                EvaluadorPremio::ESTADO_ACTIVO
            );
            throw new \Exception($msg);
        }

        $fe = $evaluadorPremio->getFormularioEvaluacion();

        if (!$fe) {
            $msg = 'Este evaluador NO HA COMPLETADO el formulario de evaluación para el Premio Actual.';
            throw new \Exception($msg);
        }

        if (!$fe->getEnviado()){
            $em = $this->getDoctrine()->getManager();
            $fe->setEnviado(true);
            $em->persist($fe);
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
     * @Route("/show-formulario-evaluacion/{id}", name="admin_evaluadorpremio_show-form-evaluacion")
     * @Method({"GET"})
     */
    public function showFormEvaluacionAction(EvaluadorPremio $evaluadorPremio) {
      $this->get('app.service.evaluador')
        ->verificarUsuarioParaVerOEditar($evaluadorPremio->getEvaluador());

      $fep = $evaluadorPremio->getFormularioEvaluacion();

      if (!$fep) {
        $this->addFlash(
            'warning',
            'El evaluador no completó el formulario.'
        );

        $sc = $this->container->get('security.authorization_checker');

        $toRoute = !$sc->isGranted('ROLE_ADMIN') && $sc->isGranted('ROLE_EVALUADOR')
                 ? 'evaluador_panel' : 'admin_evaluadorpremio_index';

        return $this->redirectToRoute($toRoute);
      }

      return $this->render(
        'evaluadorpremio/formulario-evaluacion.show.html.twig',
        array('fep' => $fep)
      );
    }

    /**
     * Pdf del Formulario de Evaluación.
     *
     * @Route("/pdf-formulario-evaluacion/{id}", name="admin_evaluadorpremio_pdf-formulario-evaluacion")
     * @Method("GET")
     */
    public function pdfFormularioEvaluacionAction(EvaluadorPremio $evaluadorPremio)
    {
        $this->get('app.service.evaluador')->verificarUsuarioParaVerOEditar($evaluadorPremio->getEvaluador());

        $fep = $evaluadorPremio->getFormularioEvaluacion();

        if (!$fep) {
            $this->addFlash(
                'warning',
                'El evaluador no completó el formulario.'
            );

            $sc = $this->container->get('security.authorization_checker');

            $toRoute = !$sc->isGranted('ROLE_ADMIN') && $sc->isGranted('ROLE_EVALUADOR')
                 ? 'evaluador_panel' : 'admin_evaluadorpremio_index';

            return $this->redirectToRoute($toRoute);
        }


        $html = $this->renderView(
            'evaluadorpremio/pdf-formulario-evaluacion.html.twig',
            array('fep' => $fep)
        );

        $filename = 'Planilla de Evaluación Individual'
                  . ' - ' . $evaluadorPremio->getEvaluador()
                  . ' - PPC'
                  . $evaluadorPremio->getPremio()->getAnio();

        $filename = Utils::sanitizeForFileName($filename) . '.pdf';

        $pdfOptions = array(
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
