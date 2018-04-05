<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Organizacion;
use AppBundle\Entity\EquipoEvaluador;
use AppBundle\Entity\Premio;
use AppBundle\Entity\FormularioEquipo;
use AppBundle\Entity\CriterioEvaluacion;
use AppBundle\Entity\RespuestaEvaluacionEquipo;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class EquipoEvaluadorService
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function createEquiposFaltantes(Premio $premio)
	{
		$em = $this->getEntityManager();
		$organizaciones = $em->getRepository('AppBundle:Organizacion')
			->getOrganizacionesActivasDelPremio($premio);

		if (count($organizaciones)) {
			foreach ($organizaciones as $o) {
				$ee = new EquipoEvaluador();
				$ee->setNombre('Equipo evaluador de "' . $o->getNombre() .'"');
				$ee->setPremio($premio);
				$ee->setOrganizacion($o);
				$em->persist($ee);
			}
			$em->flush();
		}
	}

	public function getEquiposDelPremio(Premio $premio)
	{
		$this->createEquiposFaltantes($premio);

		$em = $this->getEntityManager();

		return $em->getRepository('AppBundle:EquipoEvaluador')
			->getEquiposDelPremio($premio);
	}

	public function verificarUsuarioParaVerOEditar(EquipoEvaluador $equipo)
	{
		$sc = $this->container->get('security.authorization_checker');

		if (!$sc->isGranted('ROLE_EVALUADOR')) {
			//throw new \Exception('Ud. no puede var o editar este registro de evaluador.');
			throw new AccessDeniedHttpException('Access Denied.');
			
		} else {
			if (!$sc->isGranted('ROLE_ADMIN')) {
				//Instancia evaluador del usuario.
				$evaluador = $this->container->get('security.token_storage')
					->getToken()->getUser()->getEvaluador();

				//Esto no debería pasar, pero por las dudas...
				if (!$evaluador) {
					throw new \Exception("El usuario no es evaluador.");
				}
				
				$premioActual = $this->container->get('app.service.premio')
					->verificarSiExistePremioActual();

				/* Obtiene la instancia del evaluador en el premio actual */
				$ep = $evaluador->getInscripcionEn($premioActual);

				if (!$equipo->esMiembro($ep)) {
					throw new AccessDeniedHttpException('Access Denied.');
				}
			}
		}
	}


	public function crearFormularioSiEsNecesario(EquipoEvaluador $equipo)
	{
		$feq = $equipo->getFormulario();

		if (!$feq) {
			$fe = $equipo->getPremio()->getFormularioEvaluacion();
            if (!$fe) {
                throw new \Exception(
                    "NO ha sido asignado un formulario de evaluación para el premio."
                );
            }

            $feq = new FormularioEquipo();
            $feq->setEquipo($equipo);
            $feq->setFormularioEvaluacion($fe);
            $this->generarRtas($feq);
		}

		return $feq;
	}

	protected function generarRtas(FormularioEquipo $feq) {
		$fe = $feq->getFormularioEvaluacion();
		foreach ($fe->getCriteriosEvaluacionRaiz() as $c) {
			$r = $this->generarRta($c);
            $feq->addRespuesta($r);
		}
	}

	private function generarRta(CriterioEvaluacion $c, RespuestaEvaluacionEquipo $rtaParent = null) {
        $r = new RespuestaEvaluacionEquipo();
        $r->setCriterio($c);
        
        foreach ($c->getChildren() as $cc) {
            $r->addChild($this->generarRta($cc, $r));
        }

        if ($rtaParent) {
            $r->setParent($rtaParent);
        }

        return $r;
    }

	protected function getEntityManager()
	{
		return $this->container->get('doctrine')->getManager();
	}
}