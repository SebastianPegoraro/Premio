<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Organizacion;
use AppBundle\Entity\OrganizacionPublica;
use AppBundle\Entity\Localizacion;
use AppBundle\Entity\OrganizacionPublicaPresupuesto;
use AppBundle\Entity\Premio;
use AppBundle\Form\OrganizacionPublicaType;
use AppBundle\Form\OrganizacionPublicaFilterType;

use AppBundle\Utils\Utils;

/**
 * OrganizacionPublica controller.
 *
 * @Route("/admin/gestionpremio/organizacionpublica")
 */
class AdminPremioOrganizacionPublicaController extends Controller
{
    /**
     * Lists all OrganizacionPublica entities.
     *
     * @param Request $request Request object
     *
     * @Route("/", name="adminpremio_organizacionpublica_index")
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);

        $organizacionPremioPublicas = $this->paginate($queryBuilder, $request);

        return $this->render('adminpremioorganizacionpublica/index.html.twig', array(
            'organizacionPremioPublicas' => $organizacionPremioPublicas,
            'filterForm'           => $filterForm->createView(),
            'premioActual'         => $premioActual,
        ));
    }


    /**
     * Filters OrganizacionPublica entities.
     *
     * @param Request $request Request object
     *
     * @return array
     */
    protected function filter(Request $request, Premio $premio)
    {

        $filterForm = $this->createForm(OrganizacionPublicaFilterType::class);
        $session = $request->getSession();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:OrganizacionPremio')
            ->createQueryBuilder('op')
            ->innerJoin('op.organizacion', 'o')
            ->andWhere('op.premio = :premio')
            ->andWhere('o INSTANCE OF AppBundle:OrganizacionPublica')
            ->orderBy('o.nombre')
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
     * Filters OrganizacionPublica entities.
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
     * Creates a new OrganizacionPublica entity.
     *
     * @Route("/new", name="adminpremio_organizacionpublica_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $premioService = $this->get('app.service.premio');
        $premioService->verificarCondicionesParaInscripcion();

        $premioActual = $premioService->getPremioActual();

        $organizacionPublica = new OrganizacionPublica();
        $organizacionPublica->setPremio($premioActual);
        $organizacionPublica->addLocalizacione(new Localizacion());

        $anioPremio = $premioActual->getAnio();
        for ($i=$anioPremio - 3; $i < $anioPremio; $i++) {
            $presupuesto = new OrganizacionPublicaPresupuesto();
            $presupuesto->setAnio($i);
            $organizacionPublica->addPresupuesto($presupuesto);
        }

        $form = $this->createForm('AppBundle\Form\OrganizacionPublicaType', $organizacionPublica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organizacionPublica);
            $em->flush();

            $this->get('app.service.organizacion')->sendEmailInscripcion($organizacionPublica);

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            if (!$this->getUser()) {
                return  $this->redirectToRoute('organizacionpublica_enrolled', array('id' => $organizacionPublica->getId()));
            }

            return $this->redirectToRoute('organizacionpublica_show', array('id' => $organizacionPublica->getId()));
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('adminpremioorganizacionpublica/new.html.twig', array(
            'organizacionPublica' => $organizacionPublica,
            'form' => $form->createView(),
        ));
    }

    /**
     * Show Enrolled message
     *
     * @Route("/{id}/enrolled", name="adminpremio_organizacionpublica_enrolled")
     */
    public function enrolledMessageAction(Organizacion $organizacion)
    {
        $premioActual = $this->get('app.service.premio')->getPremioActual();

        return $this->render(
            'adminpremioorganizacion/enrolled.html.twig',
            array(
                'organizacion' => $organizacion,
                'premioActual' => $premioActual,
            )
        );
    }

    /**
     * Finds and displays a OrganizacionPublica entity.
     *
     * @Route("/{id}/show", name="adminpremio_organizacionpublica_show")
     * @Method("GET")
     */
    public function showAction(OrganizacionPublica $organizacionPublica)
    {
        //$this->get('app.service.organizacion')->sendEmailInscripcion($organizacionPublica);

        $deleteForm = $this->createDeleteForm($organizacionPublica);

        return $this->render('adminpremioorganizacionpublica/show.html.twig', array(
            'organizacionPublica' => $organizacionPublica,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a Evaluador entity.
     *
     * @Route("/{id}/pdf", name="adminpremio_organizacionpublica_pdf")
     * @Method("GET")
     */
    public function pdfAction(OrganizacionPublica $organizacionPublica)
    {
        $html = $this->renderView('adminpremioorganizacionpublica/pdf.html.twig', array(
            'organizacionPublica' => $organizacionPublica,
        ));

        $filename = $organizacionPublica->getNombre()
                  . ' - Premio Provincial a la Calidad '
                  . $organizacionPublica->getPremio()->getAnio();

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
     * @Route("/pdf", name="adminpremio_organizacionpublica_list_pdf")
     * @Method("GET")
     */
    public function listPdfAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);

        $organizacionPublicas = $queryBuilder->getQuery()->getResult();

        $html = $this->renderView('adminpremioorganizacionpublica/pdf-list.html.twig', array(
            'organizacionPublicas' => $organizacionPublicas,
            'premioActual'         => $premioActual,
            'filterForm'           => $filterForm->createView(),
        ));

        $filename = 'Organizaciones Públicas - Premio Provincial a la Calidad ' . $premioActual->getAnio();
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
     * Displays a form to edit an existing OrganizacionPublica entity.
     *
     * @Route("/{id}/edit", name="adminpremio_organizacionpublica_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, OrganizacionPublica $organizacionPublica)
    {
        $deleteForm = $this->createDeleteForm($organizacionPublica);
        $editForm = $this->createForm('AppBundle\Form\OrganizacionPublicaType', $organizacionPublica);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organizacionPublica);
            $em->flush();

            $this->addFlash(
                'success',
                'Los datos fueron guardados correctamente.'
            );

            return $this->redirectToRoute('organizacionpublica_edit', array('id' => $organizacionPublica->getId()));
        }

        if ($editForm->isSubmitted() && !$editForm->isValid()) {
            $this->addFlash(
                'error',
                'Hay errors en el formulario. Por favor verifique los campos.'
            );
        }

        return $this->render('adminpremioorganizacionpublica/edit.html.twig', array(
            'organizacionPublica' => $organizacionPublica,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a OrganizacionPublica entity.
     *
     * @Route("/{id}", name="adminpremio_organizacionpublica_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, OrganizacionPublica $organizacionPublica)
    {
        $form = $this->createDeleteForm($organizacionPublica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($organizacionPublica);
            $em->flush();
        }

        return $this->redirectToRoute('adminpremio_organizacionpublica_index');
    }

    /**
     * Creates a form to delete a OrganizacionPublica entity.
     *
     * @param OrganizacionPublica $organizacionPublica The OrganizacionPublica entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OrganizacionPublica $organizacionPublica)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminpremio_organizacionpublica_delete', array('id' => $organizacionPublica->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/organizaciones-publicas.{_format}", defaults={"_format"="xlsx"}, requirements={"_format"="csv|xls|xlsx"}, name="adminpremio_organizacionpublica_list_excel")
     * @Template(":adminpremioorganizacionpublica:list-excel.xls.twig")
     */
    public function listExcelAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        list($queryBuilder, $filterForm) = $this->filter($request, $premioActual);

        $organizacionPublicas = $queryBuilder->getQuery()->getResult();

        return array(
            'organizacionPublicas' => $organizacionPublicas,
            'premioActual' => $premioActual,
        );
    }
}
