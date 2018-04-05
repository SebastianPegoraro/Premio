<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Organizacion;
use AppBundle\Entity\OrganizacionPublica;

/**
 * @Route("/organizacion")
 */
class OrganizacionController extends Controller
{
    /**
     * @Route("/{id}/prueba-email")
     */
    public function pruebaEmailAction(Organizacion $organizacion) {
        /** @var Premio $premioActual */
        $premioActual = $this->get( 'app.service.premio' )->getPremioActual();

        if (!$premioActual) {
            throw new \Exception('No se definió la instancia de premio actual');
        }

        //$this->get('app.service.organizacion')->sendEmailInscripcion($organizacion);

        return $this->render(
            'organizacion/email-inscripcion.html.twig',
            array(
                'organizacion' => $organizacion,
                'premioActual' => $premioActual,
            )
        );
    }
}
