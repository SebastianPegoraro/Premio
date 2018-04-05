<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluadorExpGestionCalidad
 *
 * @ORM\Table(name="evaluador_exp_gestion_calidad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorExpGestionCalidadRepository")
 */
class EvaluadorExpGestionCalidad
{
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
     * @ORM\Column(name="organizacion", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $organizacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     * @Assert\NotBlank()
     */
    private $fecha;

    /**
     * @var int
     *
     * @ORM\Column(name="anios", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min = 1)
     */
    private $anios;

    /**
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="gestionCalidadExperiencias")
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
     * Set organizacion
     *
     * @param string $organizacion
     *
     * @return EvaluadorExpGestionCalidad
     */
    public function setOrganizacion($organizacion)
    {
        $this->organizacion = $organizacion;

        return $this;
    }

    /**
     * Get organizacion
     *
     * @return string
     */
    public function getOrganizacion()
    {
        return $this->organizacion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return EvaluadorExpGestionCalidad
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set anios
     *
     * @param integer $anios
     *
     * @return EvaluadorExpGestionCalidad
     */
    public function setAnios($anios)
    {
        $this->anios = $anios;

        return $this;
    }

    /**
     * Get anios
     *
     * @return int
     */
    public function getAnios()
    {
        return $this->anios;
    }

}

