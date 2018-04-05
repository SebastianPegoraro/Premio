<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluadorCriterioPremio
 *
 * @ORM\Table(name="evaluador_criterio_premio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorCriterioPremioRepository")
 */
class EvaluadorCriterioPremio
{
    const PUNTAJE_1 = 1; const PUNTAJE_2 = 2;
    const PUNTAJE_3 = 3; const PUNTAJE_4 = 4;
    const PUNTAJE_5 = 5; const PUNTAJE_6 = 6;
    const PUNTAJE_7 = 7; const PUNTAJE_8 = 8;
    const PUNTAJE_9 = 9; const PUNTAJE_10 = 10;

    public static $puntajeOptions = array(
        '1'  => self::PUNTAJE_1,
        '2'  => self::PUNTAJE_2,
        '3'  => self::PUNTAJE_3,
        '4'  => self::PUNTAJE_4,
        '5'  => self::PUNTAJE_5,
        '6'  => self::PUNTAJE_6,
        '7'  => self::PUNTAJE_7,
        '8'  => self::PUNTAJE_8,
        '9'  => self::PUNTAJE_9,
        '10' => self::PUNTAJE_10,
    );

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="puntaje", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min="1", max="10")
     */
    private $puntaje;

    /**
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="premioCriterios")
     * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotNull()
     */
    private $evaluador;

    /**
     * @var CriterioPremio
     *
     * @ORM\ManyToOne(targetEntity="CriterioPremio", inversedBy="evaluadorPremioCriterios")
     * @ORM\JoinColumn(name="criterio_premio_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotNull()
     */
    private $criterioPremio;

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
     * Set puntaje
     *
     * @param integer $puntaje
     *
     * @return EvaluadorCriterioPremio
     */
    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;

        return $this;
    }

    /**
     * Get puntaje
     *
     * @return int
     */
    public function getPuntaje()
    {
        return $this->puntaje;
    }

    /**
     * Set criterioPremio
     *
     * @param \AppBundle\Entity\CriterioPremio $criterioPremio
     *
     * @return EvaluadorCriterioPremio
     */
    public function setCriterioPremio(\AppBundle\Entity\CriterioPremio $criterioPremio)
    {
        $this->criterioPremio = $criterioPremio;

        return $this;
    }

    /**
     * Get criterioPremio
     *
     * @return \AppBundle\Entity\CriterioPremio
     */
    public function getCriterioPremio()
    {
        return $this->criterioPremio;
    }
}
