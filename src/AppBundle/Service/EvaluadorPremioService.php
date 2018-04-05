<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\FormularioEvaluadorPremio;
use AppBundle\Entity\EvaluadorPremio;
use AppBundle\Entity\FormularioEvaluacion;
use AppBundle\Entity\CriterioEvaluacion;
use AppBundle\Entity\RespuestaEvaluacion;

class EvaluadorPremioService
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function crearFormularioSiEsNecesario(EvaluadorPremio $evaluadorPremio) {
        $fep = $evaluadorPremio->getFormularioEvaluacion();

        if (!$fep) {
            $fe = $evaluadorPremio->getPremio()->getFormularioEvaluacion();
            if (!$fe) {
                throw new \Exception(
                    "NO ha sido asignado un formulario de evaluación para el premio."
                );
            }

            $fep = new FormularioEvaluadorPremio();

            $fep->setEvaluadorPremio($evaluadorPremio);
            $fep->setFormularioEvaluacion($fe);
            $this->generarRtas($fep);
        }

	    return $fep;
	}

    private function generarRtas(FormularioEvaluadorPremio $fep)
    {
        $fe = $fep->getFormularioEvaluacion();
        foreach ($fe->getCriteriosEvaluacionRaiz() as $c) {
            $r = $this->generarRta($c);
            $fep->addRespuesta($r);
        }
    }

    private function generarRta(CriterioEvaluacion $c, RespuestaEvaluacion $rtaParent = null) {
        $r = new RespuestaEvaluacion();
        $r->setCriterio($c);
        
        foreach ($c->getChildren() as $cc) {
            $r->addChild($this->generarRta($cc, $r));
        }

        if ($rtaParent) {
            $r->setParent($rtaParent);
        }

        return $r;
    }

}