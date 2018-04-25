<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\OrganizacionPremio;
use AppBundle\Entity\OrganizacionPublica;
use AppBundle\Entity\OrganizacionPrivada;

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

      $premioActual = $this->get('app.service.premio')
          ->verificarSiExistePremioActual();

      $entity = new OrganizacionPremio();
      $entity->setEstado(OrganizacionPremio::ESTADO_INICIAL);
      $entity->setPremio($premioActual);

      $organizacion = $type == "publica" ? new OrganizacionPublica() : new OrganizacionPrivada();

      /*if ($type == "publica"){
          $organizacion = new OrganizacionPublica();
      } else {
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

        return $this->render('organizacionpremio/new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

}
