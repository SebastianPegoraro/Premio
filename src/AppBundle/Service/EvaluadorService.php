<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints\Email as EmailConstraint;
use AppBundle\Entity\Evaluador;
use AppBundle\Entity\Localizacion;
use AppBundle\Entity\EvaluadorEstudioUniversitario;
use AppBundle\Entity\EvaluadorCriterioPremio;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EvaluadorService
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function getNuevaEntidadEvaluador()
	{
		$evaluador = new Evaluador();

        $evaluador->addParticularLocalizacione(new Localizacion());
        $evaluador->addLaboralLocalizacione(new Localizacion());
        $evaluador->addEstudiosUniversitario(new EvaluadorEstudioUniversitario());

        $this->agregarCiteriosPremio($evaluador);

        return $evaluador;
	}

	public function agregarCiteriosPremio(Evaluador $evaluador)
	{
		$em = $this->getEntityManager();

		$criterios = array();

		if (!$evaluador->getId()) {
			$criterios = $em
				->getRepository('AppBundle:CriterioPremio')
				->findBy(array(), array('orden' => 'ASC'));
		} else {
			$criterios = $em
				->getRepository('AppBundle:CriterioPremio')
				->getNoAsociadosAEvaluador($evaluador);
		}

        foreach ($criterios as $criterio) {
            $ecp = new EvaluadorCriterioPremio();
            $ecp->setCriterioPremio($criterio);
            $evaluador->addPremioCriterio($ecp);
        }
	}

	public function generarUsuarioParaEvaluador(Evaluador $evaluador, $doFlush = true)
	{
		$userManager = $this->container->get('fos_user.user_manager');

		$usuario = $userManager->createUser();
		$usuario->setUsername($evaluador->getDni());
		$usuario->setEmail($evaluador->getContactoParticular()->getEmail());
		$usuario->setPlainPassword($evaluador->getDni());
		$usuario->setEnabled(true);
		$usuario->addRole('ROLE_EVALUADOR');

		//En $usuario->setEvaluador($evaluador) se realiza $evaluador->setUsuario($this)
		//lo que asegura pasar el id de usuario al evaluador.
		$usuario->setEvaluador($evaluador);

		$userManager->updateUser($usuario, $doFlush);
	}

	public function actualizarEmailDeUsuario(Evaluador $evaluador, $doFlush = true)
	{
		$usuario = $evaluador->getUsuario();

		if ($usuario) {
			$usuario->setEmail($evaluador->getContactoParticular()->getEmail());
			$userManager = $this->container->get('fos_user.user_manager');
			$userManager->updateUser($usuario, $doFlush);
		}
	}

	public function sendNuevoUsuarioEmail($evaluador)
	{
		$mailService = $this->container->get('app.service.email');

		$premioActual = $this->container->get('app.service.premio')->getPremioActual();

		$to = $evaluador->getContactoParticular()->getEmail();
		$subject = ($premioActual ? $premioActual->__toString() : 'Premio provincial a la calidad') . ' - ';
		$subject .= 'Registro como evaluador';
		$imageEmailTemplate = ':evaluador:email-nuevo_usuario.html.twig';
		$emailTemplate = '::image-email.html.twig';

		$data = array(
			'premioActual' => $premioActual,
			'evaluador'    => $evaluador,
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
		/*
		La declaración jurada se va a enviar en un momento posterior.
		$decJurada = $webDir . '/docs/declaracion-jurada-evaluador.pdf';
		$files = array($decJurada);
		*/

		$images = array(
			'img'   => $imageEmailPath,
		);

		$data = array(
			'links' => array(
				array(
					'descripcion' => 'Login',
					'url'         => $this->routeAbsoluteUrl('fos_user_security_login'),
					'label'       => $this->routeAbsoluteUrl('fos_user_security_login'),
				),
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

	/**
	 * Controla si el usuario puede editar datos del evaluador.
	 *
	 */
	public function verificarUsuarioParaVerOEditar(Evaluador $evaluadorAEditar)
	{
		$sc = $this->container->get('security.authorization_checker');

		if (!$sc->isGranted('ROLE_EVALUADOR')) {
			//throw new \Exception('Ud. no puede var o editar este registro de evaluador.');
			throw new AccessDeniedHttpException('Access Denied.');
			
		} else {
			if (!$sc->isGranted('ROLE_ADMIN')) {
				//es evaluador pero no admin: solo puede editar su propio registro.
				$usuario = $this->container->get('security.token_storage')->getToken()->getUser();
				if (!$usuario->getEvaluador() || $usuario->getEvaluador()->getId() <> $evaluadorAEditar->getId()) {
					//throw new \Exception('Ud. no puede editar este registro de evaluador.');
					throw new AccessDeniedHttpException('Access Denied.');
				}
			}
		}
	}

	protected function getEntityManager()
	{
		return $this->container->get('doctrine')->getManager();
	}

	private function assetAbsoluteUrl($asset) {
		$request = $this->container->get('request_stack')->getCurrentRequest();

		$baseUrl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

		return $baseUrl . $this->container->get('assets.packages')->getUrl($asset); 
	}

	private function routeAbsoluteUrl($route, array $parameters = array())
	{
		$router  = $this->container->get('router');

		return $router->generate($route, $parameters, UrlGeneratorInterface::ABSOLUTE_URL);
	}
}