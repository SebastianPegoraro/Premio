<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluadorTrabajoIndependiente
 *
 * @ORM\Table(name="evaluador_trabajo_independiente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorTrabajoIndependienteRepository")
 */
class EvaluadorTrabajoIndependiente
{
    use \AppBundle\Entity\Traits\DuracionTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="actividad", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $actividad;

    /**
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="independienteTrabajos")
     * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotNull()
     */
    private $evaluador;

    /**
     * Get evaluador
     *
     * @return Evaluador
     */
    public function getEvaluador()
    {
        return $this->evaluador;
    }
     
    /**
     * Set evaluador
     * 
     * @param Evaluador $evaluador Evaluador
     * 
     * @return EvaluadorTrabajoActual
     */ 
    public function setEvaluador(Evaluador $evaluador)
    {
        $this->evaluador = $evaluador;

        return $this;
    }

    public function __construct() {
        $this->duracion = new \AppBundle\Entity\Embeddable\Duracion();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set actividad
     *
     * @param string $actividad
     *
     * @return EvaluadorTrabajoIndependiente
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return string
     */
    public function getActividad()
    {
        return $this->actividad;
    }
}
