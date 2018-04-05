<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Entity\Traits\BlameableTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * CriterioEvaluacion
 *
 * @ORM\Table(
 *     name="criterio_evaluacion",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *             name="formulario_nombre_idx", columns={"formulario_evaluacion_id", "nombre"}
 *         )
 *     }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CriterioRepository")
 *
 * @UniqueEntity(
 *     fields={"formularioEvaluacion", "nombre"},
 *     message="Ya existe este nombre de criterio para otro formulario de evaluación."
 * )
 */
class CriterioEvaluacion
{
    use TimestampableEntity;
    use BlameableTrait;

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
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="puntaje_maximo", type="integer")
     * @Assert\NotBlank()
     */
    private $puntajeMaximo;

    /**
     * @ORM\OneToMany(targetEntity="CriterioEvaluacion", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="CriterioEvaluacion", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\ManyToOne(targetEntity="FormularioEvaluacion", inversedBy="criteriosEvaluacion")
     * @ORM\JoinColumn(
     *     name="formulario_evaluacion_id", referencedColumnName="id", onDelete="CASCADE"
     * )
     */
    private $formularioEvaluacion;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Criterio
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
     * Constructor
     */
    public function __construct()
    {
        $this->puntajeMaximo = 0;
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\CriterioEvaluacion $child
     *
     * @return CriterioEvaluacion
     */
    public function addChild(\AppBundle\Entity\CriterioEvaluacion $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\CriterioEvaluacion $child
     */
    public function removeChild(\AppBundle\Entity\CriterioEvaluacion $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\CriterioEvaluacion $parent
     *
     * @return CriterioEvaluacion
     */
    public function setParent(\AppBundle\Entity\CriterioEvaluacion $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\CriterioEvaluacion
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set puntajeMaximo
     *
     * @param integer $puntajeMaximo
     *
     * @return CriterioEvaluacion
     */
    public function setPuntajeMaximo($puntajeMaximo)
    {
        $this->puntajeMaximo = $puntajeMaximo;

        return $this;
    }

    /**
     * Get puntajeMaximo
     *
     * @return integer
     */
    public function getPuntajeMaximo()
    {
        return $this->puntajeMaximo;
    }

    /**
     * Set formularioEvaluacion
     *
     * @param \AppBundle\Entity\FormularioEvaluacion $formularioEvaluacion
     *
     * @return CriterioEvaluacion
     */
    public function setFormularioEvaluacion(\AppBundle\Entity\FormularioEvaluacion $formularioEvaluacion = null)
    {
        $this->formularioEvaluacion = $formularioEvaluacion;

        return $this;
    }

    /**
     * Get formularioEvaluacion
     *
     * @return \AppBundle\Entity\FormularioEvaluacion
     */
    public function getFormularioEvaluacion()
    {
        return $this->formularioEvaluacion;
    }
}
