<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluadorEstudioPosgrado
 *
 * @ORM\Table(name="evaluador_estudio_posgrado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorEstudioPosgradoRepository")
 */
class EvaluadorEstudioPosgrado
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
     * @ORM\Column(name="titulo_obtenido", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $tituloObtenido;

    /**
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="estudiosPosgrados")
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
     * Set tituloObtenido
     *
     * @param string $tituloObtenido
     *
     * @return EstudioPosgrado
     */
    public function setTituloObtenido($tituloObtenido)
    {
        $this->tituloObtenido = $tituloObtenido;

        return $this;
    }

    /**
     * Get tituloObtenido
     *
     * @return string
     */
    public function getTituloObtenido()
    {
        return $this->tituloObtenido;
    }

    /**
     * Set evaluador
     *
     * @param \AppBundle\Entity\Evaluador $evaluador
     *
     * @return EvaluadorEstudioPosgrado
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
