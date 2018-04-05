<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluadorTrabajoEstatal
 *
 * @ORM\Table(name="evaluador_trabajo_estatal")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorTrabajoEstatalRepository")
 */
class EvaluadorTrabajoEstatal
{
    use \AppBundle\Entity\Traits\ExperienciaTrabajoTrait;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="estatalTrabajos")
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

    public function __construct()
    {
        $this->experienciaTrabajo = new \AppBundle\Entity\Embeddable\ExperienciaTrabajo();
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
}

