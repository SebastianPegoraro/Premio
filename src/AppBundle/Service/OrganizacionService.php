<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Organizacion;
use AppBundle\Entity\OrganizacionPublica;
use AppBundle\Entity\OrganizacionPrivada;

class OrganizacionService
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function sendEmailInscripcion(Organizacion $organizacion)
	{
		$mailService = $this->container->get('app.service.email');

		$premioActual = $this->container->get('app.service.premio')->getPremioActual();

		$to = $organizacion->getResponsableEnPremioContacto()->getEmail();
		$subject  = ($premioActual ? $premioActual->__toString() : 'Premio provincial a la calidad') . ' - ';
		$subject .= 'Solicitud de Inscripción como Participante.';

		$imageEmailTemplate = ':organizacion:email-inscripcion.html.twig';
		$emailTemplate = '::image-email.html.twig';

		$data = array(
			'organizacion' => $organizacion,
			'premioActual' => $premioActual,
			'hideFooter'   => true,
		);

		//genero una imagen con el contenido del email.
		//Esto es ya que los clientes solo aceptan imagenes en img, no como atributos css.
		$imageOptions = array(
			'width' => 800, 'quality' => 90
		);

		$imageEmailPath = $mailService->createImageEmail(
			$imageEmailTemplate, $data, $imageOptions
		);

		$files = array();

		$images = array(
			'img'   => $imageEmailPath,
		);

		$data = array(
			'links' => array(
				array(
					'descripcion' => 'Para más información ingrese a',
					'url'         => 'http://www.premiocalidad.chaco.gov.ar',
					'label'       => 'www.premiocalidad.chaco.gov.ar',
				),
				array(
					'descripcion' => 'Facebook',
					'url'         => 'https://www.facebook.com/PremioCalidadChaco',
					'label'       => 'www.facebook.com/PremioCalidadChaco',
				),
			)
		);

		$mailService->sendEmail($to, $subject, $emailTemplate, $data, $files, $images);
	}

//	public function sendEmailInscripcion(Organizacion $organizacion)
//	{
//		$mailService = $this->container->get('app.service.email');
//
//		$premioActual = $this->container->get('app.service.premio')->getPremioActual();
//
//		$to = $organizacion->getResponsableEnPremioContacto()->getEmail();
//		$subject  = ($premioActual ? $premioActual->__toString() : 'Premio provincial a la calidad') . ' - ';
//		$subject .= 'Solicitud de Inscripción como Participante.';
//
//		$emailTemplate = ':organizacion:email-inscripcion.html.twig';
//
//		$webDir = realpath($this->container->getParameter('kernel.root_dir') . '/../web');
//		/*$decJurada = $webDir . '/docs/declaracion-jurada-evaluador.pdf';
//
//		$files = array($decJurada);*/
//
//		$files = array();
//
//		$images = array(
//			'bgImg'   => $webDir . '/images/fondo-contenido-light.png',
//			//'logoImg' => $webDir . '/images/logo-premio-calidad-negro-email.png',
//		);
//
//		$data = array(
//			'organizacion' => $organizacion,
//			'premioActual' => $premioActual,
//		);
//
//		$mailService->sendEmail($to, $subject, $emailTemplate, $data, $files, $images);
//	}
}