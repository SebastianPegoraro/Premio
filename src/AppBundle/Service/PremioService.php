<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class PremioService
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function getPremioActual()
	{
		$em = $this->container->get('doctrine')->getManager();
		return
			$em ->getRepository('AppBundle:Premio')
				->getActual();
	}

	public function verificarCondicionesParaInscripcion()
	{
		$premioActual = $this->verificarSiExistePremioActual();

        $sc = $this->container->get( 'security.authorization_checker' );

        if (!$sc->isGranted('ROLE_ADMIN')) {
            if (!$premioActual->esPeriodoDeInscripcion()) {
            	$msg = sprintf(
            		"Período de Inscripción No Iniciado ó Finalizado (del %s al %s)",
            		$premioActual->getFechaHoraInicioInscripcion()->format('d/m/Y - H:i'),
            		$premioActual->getFechaHoraFinInscripcion()->format('d/m/Y - H:i')
        		);
                throw new \Exception($msg);  
            }
        }
	}

	/**
	 * Verifica si existe premio actual y si existe lo devuelve, sino
	 * genera una excepción.
	 */
	public function verificarSiExistePremioActual() 
	{
		$premioActual = $this->getPremioActual();
        if (!$premioActual) {
            throw new \Exception("No existe una instancia de premio para el año actual.");
        }

        return $premioActual;
	}
}