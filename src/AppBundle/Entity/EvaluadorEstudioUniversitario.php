<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluadorEstudioUniversitario
 *
 * @ORM\Table(name="evaluador_estudio_universitario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorEstudioUniversitarioRepository")
 */
class EvaluadorEstudioUniversitario
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
     * @var TituloUniversitario
     *
     * @ORM\ManyToOne(targetEntity="TituloUniversitario", inversedBy="evaluadorEstudiosUniversitarios")
     * @ORM\JoinColumn(name="titulo_universitario_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     */ 
    private $tituloUniversitario;

    /**
     * @var int
     *
     * @ORM\Column(name="anio", type="integer")
     * @Assert\NotBlank()
     */
    private $anio;

    /**
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="estudiosUniversitarios")
     * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotNull()
     */
    private $evaluador;

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
     * Set anio
     *
     * @param integer $anio
     *
     * @return EstudioUniversitario
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return int
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set tituloUniversitario
     *
     * @param \AppBundle\Entity\TituloUniversitario $tituloUniversitario
     *
     * @return EvaluadorEstudioUniversitario
     */
    public function setTituloUniversitario(\AppBundle\Entity\TituloUniversitario $tituloUniversitario)
    {
        $this->tituloUniversitario = $tituloUniversitario;

        return $this;
    }

    /**
     * Get tituloUniversitario
     *
     * @return \AppBundle\Entity\TituloUniversitario
     */
    public function getTituloUniversitario()
    {
        return $this->tituloUniversitario;
    }

    /**
     * Set evaluador
     *
     * @param \AppBundle\Entity\Evaluador $evaluador
     *
     * @return EvaluadorEstudioUniversitario
     */
    public function setEvaluador(\AppBundle\Entity\Evaluador $evaluador)
    {
        $this->evaluador = $evaluador;

        return $this;
    }

    /**
     * Get evaluador
     *
     * @return \AppBundle\Entity\Evaluador
     */
    public function getEvaluador()
    {
        return $this->evaluador;
    }
}
