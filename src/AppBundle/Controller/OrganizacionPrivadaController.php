<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Organizacion;
use AppBundle\Entity\OrganizacionPrivada;
use AppBundle\Entity\Localizacion;
use AppBundle\Entity\Premio;
use AppBundle\Form\OrganizacionPrivadaType;
use AppBundle\Form\OrganizacionPrivadaFilterType;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Utils\Utils;

/**
 * OrganizacionPrivada controller.
 *
 * @Route("/organizacionprivada")
 */
class OrganizacionPrivadaController extends Controller
{
    /**
     * Lists all OrganizacionPrivada entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="organizacionprivada_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);

        $organizacionPrivadas = $this->paginate($queryBuilder, $request);

        return $this->render('organizacionprivada/index.html.twig', array(
            'organizacionPrivadas' => $organizacionPrivadas,
            'filterForm' => $filterForm->createView(),
            'premioActual' => $premioActual,
        ));
    }

    /**
     * Filters OrganizacionPrivada entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request, Premio $premio)
    {
        $filterForm = $this->createForm(OrganizacionPrivadaFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:OrganizacionPrivada')
            ->createQueryBuilder('opr')
            ->andWhere('opr.premio = :premio')
            ->orderBy('opr.nombre')
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
     * Filters OrganizacionPrivada entities.
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
     * Creates a new OrganizacionPrivada entity.
     *
     * @Route("/new", name="organizacionprivada_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $premioService = $this->get('app.service.premio');
        $premioService->verificarCondicionesParaInscripcion();

        $premioActual = $premioService->getPremioActual();

        $organizacionPrivada = new OrganizacionPrivada();
        $organizacionPrivada->setPremio($premioActual);
        $organizacionPrivada->addLocalizacione(new Localizacion());

        $form = $this->createForm('AppBundle\Form\OrganizacionPrivadaType', $organizacionPrivada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organizacionPrivada);
            $em->flush();

            $this->get('app.service.organizacion')->sendEmailInscripcion($organizacionPrivada);

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            if (!$this->getUser()) {
                return  $this->redirectToRoute('organizacionprivada_enrolled', array('id' => $organizacionPrivada->getId()));
            }

            return $this->redirectToRoute('organizacionprivada_show', array('id' => $organizacionPrivada->getId()));
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('organizacionprivada/new.html.twig', array(
            'organizacionPrivada' => $organizacionPrivada,
            'form' => $form->createView(),
        ));
    }

    /**
     * Show Enrolled message
     *
     * @Route("/{id}/enrolled", name="organizacionprivada_enrolled")
     */
    public function enrolledMessageAction(Organizacion $organizacion)
    {
        $premioActual = $this->get('app.service.premio')->getPremioActual();

        return $this->render(
            'organizacion/enrolled.html.twig',
            array(
                'organizacion' => $organizacion,
                'premioActual' => $premioActual,
            )
        );
    }

    /**
     * Finds and displays a OrganizacionPrivada entity.
     *
     * @Route("/{id}/show", name="organizacionprivada_show")
     * @Method("GET")
     */
    public function showAction(OrganizacionPrivada $organizacionPrivada)
    {
        $deleteForm = $this->createDeleteForm($organizacionPrivada);

        return $this->render('organizacionprivada/show.html.twig', array(
            'organizacionPrivada' => $organizacionPrivada,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing OrganizacionPrivada entity.
     *
     * @Route("/{id}/edit", name="organizacionprivada_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, OrganizacionPrivada $organizacionPrivada)
    {
        $deleteForm = $this->createDeleteForm($organizacionPrivada);
        $editForm = $this->createForm('AppBundle\Form\OrganizacionPrivadaType', $organizacionPrivada);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organizacionPrivada);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('organizacionprivada_edit', array('id' => $organizacionPrivada->getId()));
        }

        if ($editForm->isSubmitted() && !$editForm->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('organizacionprivada/edit.html.twig', array(
            'organizacionPrivada' => $organizacionPrivada,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a OrganizacionPrivada entity.
     *
     * @Route("/{id}", name="organizacionprivada_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, OrganizacionPrivada $organizacionPrivada)
    {
        $form = $this->createDeleteForm($organizacionPrivada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($organizacionPrivada);
            $em->flush();
        }

        return $this->redirectToRoute('organizacionprivada_index');
    }

    /**
     * Creates a form to delete a OrganizacionPrivada entity.
     *
     * @param OrganizacionPrivada $organizacionPrivada The OrganizacionPrivada entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OrganizacionPrivada $organizacionPrivada)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organizacionprivada_delete', array('id' => $organizacionPrivada->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Finds and displays a Evaluador entity.
     *
     * @Route("/{id}/pdf", name="organizacionprivada_pdf")
     * @Method("GET")
     */
    public function pdfAction(OrganizacionPrivada $organizacionPrivada)
    {
        $html = $this->renderView('organizacionprivada/pdf.html.twig', array(
            'organizacionPrivada' => $organizacionPrivada,
        ));

        $filename = $organizacionPrivada->getNombre()
                  . ' - Premio Provincial a la Calidad '
                  . $organizacionPrivada->getPremio()->getAnio();

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
     * OrganizacionPublica list pdf.
     *
     * @Route("/pdf", name="organizacionprivada_list_pdf")
     * @Method("GET")
     */
    public function listPdfAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);

        $organizacionPrivadas = $queryBuilder->getQuery()->getResult();

        $html = $this->renderView('organizacionprivada/pdf-list.html.twig', array(
            'organizacionPrivadas' => $organizacionPrivadas,
            'premioActual'         => $premioActual,
            'filterForm'           => $filterForm->createView(),
        ));

        $filename = 'Organizaciones Privadas - Premio Provincial a la Calidad ' . $premioActual->getAnio();
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
     * @Route("/organizaciones-privadas.{_format}", defaults={"_format"="xlsx"}, requirements={"_format"="csv|xls|xlsx"}, name="organizacionprivada_list_excel")
     * @Template(":organizacionprivada:list-excel.xls.twig")
     */
    public function listExcelAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);

        $organizacionPrivadas = $queryBuilder->getQuery()->getResult();

        return array(
            'organizacionPrivadas' => $organizacionPrivadas,
            'premioActual' => $premioActual,
        );
    }
}
