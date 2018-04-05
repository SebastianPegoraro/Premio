<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluadorCurso
 *
 * @ORM\Table(name="evaluador_curso")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorCursoRepository")
 */
class EvaluadorCurso
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
     * @var int
     *
     * @ORM\Column(name="anio", type="integer")
     * @Assert\NotBlank()
     */
    private $anio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $institucion;

    /**
     * @var int
     *
     * @ORM\Column(name="horas", type="integer")
     * @Assert\NotBlank()
     */
    private $horas;

    /**
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="cursos")
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
     * @return Curso
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Curso
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set institucion
     *
     * @param string $institucion
     *
     * @return Curso
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set horas
     *
     * @param integer $horas
     *
     * @return Curso
     */
    public function setHoras($horas)
    {
        $this->horas = $horas;

        return $this;
    }

    /**
     * Get horas
     *
     * @return int
     */
    public function getHoras()
    {
        return $this->horas;
    }

    /**
     * Set evaluador
     *
     * @param \AppBundle\Entity\Evaluador $evaluador
     *
     * @return EvaluadorCurso
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
