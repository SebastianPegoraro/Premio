<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\EvaluadorPremio;
use AppBundle\Form\EvaluadorPremioType;

/**
 * @Route("/admin/gestionpremio")
 */
class AdminPremioController extends Controller
{
    /**
     * @Route("/", name="adminpremio_index")
     */
    public function indexAction()
    {
        $premioActual = $this->get( 'app.service.premio' )->getPremioActual();
        $em = $this->getDoctrine()->getManager();

        if (!$premioActual) {
            throw new \Exception('No se definió la instancia de premio actual');
        }

        $cant_opriv = $em->getRepository('AppBundle:OrganizacionPrivada')->getCant($premioActual);
        $cant_opub = $em->getRepository('AppBundle:OrganizacionPublica')->getCant($premioActual);
        $cant_ev = $em->getRepository('AppBundle:EvaluadorPremio')->getCant($premioActual);


        return $this->render('adminpremio/index.html.twig', array(
            'premioActual' => $premioActual,
            'cant_opriv' => $cant_opriv,
            'cant_opub' => $cant_opub,
            'cant_ev' => $cant_ev          
        ));
    }

   /**
     * @Route("/organizacionprivada", name="adminpremio_organizacionprivada")
     */
    public function organizacionPrivadaAction()
    {
        $premioActual = $this->get( 'app.service.premio' )->getPremioActual();


        return $this->render('adminpremio/organizacionesprivadas.html.twig', array(
            'premioActual' => $premioActual
            
        ));
    }

    /**
     * @Route("/organizacionpublica", name="adminpremio_organizacionpublica")
     */
    public function organizacionpublicaAction()
    {
        $premioActual = $this->get( 'app.service.premio' )->getPremioActual();


        return $this->render('adminpremio/organizacionespublicas.html.twig', array(
            'premioActual' => $premioActual
            
        ));
    }
}
