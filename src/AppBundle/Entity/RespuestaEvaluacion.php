<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * RespuestasEvaluacion
 *
 * @ORM\Table(name="respuesta_evaluacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RespuestaEvaluacionRepository")
 */
class RespuestaEvaluacion
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
     * @ORM\Column(name="porcentaje", type="decimal", precision=10, scale=2)
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="0", max="100")
     */
    private $porcentaje;

    /**
     * @ORM\ManyToOne(targetEntity="CriterioEvaluacion")
     * @ORM\JoinColumn(name="criterio_id", referencedColumnName="id")
     */
    private $criterio;

    /**
     * @ORM\ManyToOne(targetEntity="FormularioEvaluadorPremio", inversedBy="respuestas")
     * @ORM\JoinColumn(name="formulario_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $formulario;

    /**
     * @ORM\OneToMany(targetEntity="RespuestaEvaluacion", mappedBy="parent", cascade={"persist"})
     * @Assert\Valid()
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="RespuestaEvaluacion", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

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
     * Set criterio
     *
     * @param \AppBundle\Entity\CriterioEvaluacion $criterio
     *
     * @return RespuestaEvaluacion
     */
    public function setCriterio(\AppBundle\Entity\CriterioEvaluacion $criterio = null)
    {
        $this->criterio = $criterio;

        return $this;
    }

    /**
     * Get criterio
     *
     * @return \AppBundle\Entity\CriterioEvaluacion
     */
    public function getCriterio()
    {
        return $this->criterio;
    }

    /**
     * Set formulario
     *
     * @param \AppBundle\Entity\FormularioEvaluadorPremio $formulario
     *
     * @return RespuestaEvaluacion
     */
    public function setFormulario(\AppBundle\Entity\FormularioEvaluadorPremio $formulario = null)
    {
        $this->formulario = $formulario;

        return $this;
    }

    /**
     * Get formulario
     *
     * @return \AppBundle\Entity\FormularioEvaluadorPremio
     */
    public function getFormulario()
    {
        return $this->formulario;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\RespuestaEvaluacion $child
     *
     * @return RespuestaEvaluacion
     */
    public function addChild(\AppBundle\Entity\RespuestaEvaluacion $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\RespuestaEvaluacion $child
     */
    public function removeChild(\AppBundle\Entity\RespuestaEvaluacion $child)
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
     * @param \AppBundle\Entity\RespuestaEvaluacion $parent
     *
     * @return RespuestaEvaluacion
     */
    public function setParent(\AppBundle\Entity\RespuestaEvaluacion $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\RespuestaEvaluacion
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set porcentaje
     *
     * @param integer $porcentaje
     *
     * @return RespuestaEvaluacion
     */
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    /**
     * Get porcentaje
     *
     * @return integer
     */
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    public function getPuntaje()
    {
        return ($this->getPorcentaje() * $this->getCriterio()->getPuntajeMaximo())/100;
    }

    /**
     * @Assert\Callback
     */
    public function validatePorcentaje(ExecutionContextInterface $context)
    {
        if ($this->porcentaje && $this->children->count() == 0) {
            $isInteger = is_numeric($this->porcentaje) &&
                intval($this->porcentaje)==floatval($this->porcentaje);
            //die(var_dump($isInteger));
            if (!$isInteger) {
                $context
                    ->buildViolation('Debe ingresar un valor entero.')
                    ->atPath('porcentaje')
                    ->addViolation();
            }
        }
    }
}
