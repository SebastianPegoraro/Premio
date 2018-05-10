<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\OrganizacionPremio;
use AppBundle\Entity\OrganizacionPublica;
use AppBundle\Entity\OrganizacionPrivada;
use AppBundle\Entity\Localizacion;
use AppBundle\Entity\OrganizacionPublicaPresupuesto;

/**
 * @Route("/organizacionpremio")
 */
class OrganizacionPremioController extends Controller
{
    private static $typeOptions = array('publica', 'privada');

    /**
     * @Route("/{type}/new")
     */
    public function newAction(Request $request, $type)
    {
      if (!in_array($type, self::$typeOptions)) {
        throw new \Exception("No se especificó el tipo de Organizacion");
      }

      $premioService = $this->get('app.service.premio');
      $premioService->verificarCondicionesParaInscripcion();

      $premioActual = $premioService->verificarSiExistePremioActual();

      $entity = new OrganizacionPremio();
      $entity->setEstado(OrganizacionPremio::ESTADO_INICIAL);
      $entity->setPremio($premioActual);

      $organizacion = $type == "publica" ? new OrganizacionPublica() : new OrganizacionPrivada();
      $organizacion->addLocalizacione(new Localizacion());
      if ($type == "publica"){
        $anioPremio = $premioActual->getAnio();
        for ($i=$anioPremio - 3; $i < $anioPremio; $i++) {
            $presupuesto = new OrganizacionPublicaPresupuesto();
            $presupuesto->setAnio($i);
            $organizacion->addPresupuesto($presupuesto);
        }

      }/* else {
          $organizacion = new OrganizacionPrivada();
      }*/

      $entity->setOrganizacion($organizacion);

      $form = $this->createForm('AppBundle\Form\OrganizacionPremioType', $entity);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($entity);
          $em->flush();

          return $this->redirectToRoute('homepage');
      }

      if (!$form->isValid()) {
        //die(var_dump($form->getErrorsAsString()));
        $errors = $form->getErrors();
        foreach ($errors as $e) {
          echo $e->getOrigin()->getName();
          echo "<br>";
        }
        die();
      }

        return $this->render('organizacionpremio/new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
            'type' => $type,
        ));
    }

}
