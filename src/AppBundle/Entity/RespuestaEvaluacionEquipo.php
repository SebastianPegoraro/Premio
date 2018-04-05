<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * RespuestaEvaluacionEquipo
 *
 * @ORM\Table(name="respuesta_evaluacion_equipo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RespuestaEvaluacionEquipoRepository")
 */
class RespuestaEvaluacionEquipo
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
     * @ORM\Column(name="porcentaje_consensuado", type="decimal", precision=10, scale=2)
     *
     * @Assert\NotBlank()
     * @Assert\Range(min="0", max="100")
     */
    private $porcentajeConsensuado;

    /**
     * @var int
     *
     * @ORM\Column(name="porcentaje_post_visita", type="decimal", precision=10, scale=2, nullable=true)
     *
     * @Assert\Range(min="0", max="100")
     */
    private $porcentajePostVisita;

    /**
     * @ORM\ManyToOne(targetEntity="CriterioEvaluacion")
     * @ORM\JoinColumn(name="criterio_id", referencedColumnName="id")
     */
    private $criterio;

    /**
     * @ORM\ManyToOne(targetEntity="FormularioEquipo", inversedBy="respuestas")
     * @ORM\JoinColumn(name="formulario_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $formulario;

    /**
     * @ORM\OneToMany(targetEntity="RespuestaEvaluacionEquipo", mappedBy="parent", cascade={"persist"})
     * @Assert\Valid()
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="RespuestaEvaluacionEquipo", inversedBy="children")
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
     * Set porcentajeConsensuado
     *
     * @param integer $porcentajeConsensuado
     *
     * @return RespuestaEvaluacionEquipo
     */
    public function setPorcentajeConsensuado($porcentajeConsensuado)
    {
        $this->porcentajeConsensuado = $porcentajeConsensuado;

        return $this;
    }

    /**
     * Get porcentajeConsensuado
     *
     * @return int
     */
    public function getPorcentajeConsensuado()
    {
        return $this->porcentajeConsensuado;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set porcentajePostVisita
     *
     * @param integer $porcentajePostVisita
     *
     * @return RespuestaEvaluacionEquipo
     */
    public function setPorcentajePostVisita($porcentajePostVisita)
    {
        $this->porcentajePostVisita = $porcentajePostVisita;

        return $this;
    }

    /**
     * Get porcentajePostVisita
     *
     * @return integer
     */
    public function getPorcentajePostVisita()
    {
        return $this->porcentajePostVisita;
    }

    /**
     * Set criterio
     *
     * @param \AppBundle\Entity\CriterioEvaluacion $criterio
     *
     * @return RespuestaEvaluacionEquipo
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
     * Add child
     *
     * @param \AppBundle\Entity\RespuestaEvaluacionEquipo $child
     *
     * @return RespuestaEvaluacionEquipo
     */
    public function addChild(\AppBundle\Entity\RespuestaEvaluacionEquipo $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\RespuestaEvaluacionEquipo $child
     */
    public function removeChild(\AppBundle\Entity\RespuestaEvaluacionEquipo $child)
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
     * @param \AppBundle\Entity\RespuestaEvaluacionEquipo $parent
     *
     * @return RespuestaEvaluacionEquipo
     */
    public function setParent(\AppBundle\Entity\RespuestaEvaluacionEquipo $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\RespuestaEvaluacionEquipo
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set formulario
     *
     * @param \AppBundle\Entity\FormularioEquipo $formulario
     *
     * @return RespuestaEvaluacionEquipo
     */
    public function setFormulario(\AppBundle\Entity\FormularioEquipo $formulario = null)
    {
        $this->formulario = $formulario;

        return $this;
    }

    /**
     * Get formulario
     *
     * @return \AppBundle\Entity\FormularioEquipo
     */
    public function getFormulario()
    {
        if (!$this->formulario) {
            return $this->parent->getFormulario();
        }

        return $this->formulario;
    }

    public function getPuntajeConsensuado()
    {
        return ($this->getPorcentajeConsensuado() * $this->getCriterio()->getPuntajeMaximo())/100;
    }

    public function getPuntajePostVisita()
    {
        return ($this->getPorcentajePostVisita() * $this->getCriterio()->getPuntajeMaximo())/100;
    }

    /**
     * @Assert\Callback
     */
    public function validatePorcentajeConsensuado(ExecutionContextInterface $context)
    {
        if ($this->porcentajeConsensuado && $this->children->count() == 0) {
            $isInteger = is_numeric($this->porcentajeConsensuado) &&
                intval($this->porcentajeConsensuado) == floatval($this->porcentajeConsensuado);

            if (!$isInteger) {
                $context
                    ->buildViolation('Debe ingresar un valor entero.')
                    ->atPath('porcentajeConsensuado')
                    ->addViolation();
            }
        }
    }

    /**
     * @Assert\Callback
     */
    public function validatePorcentajePostVisita(ExecutionContextInterface $context)
    {
        $formulario = $this->getFormulario();

        if ($formulario->getEnviado()) {
            if ($this->porcentajePostVisita && $this->children->count() == 0) {
                $isInteger = is_numeric($this->porcentajePostVisita) &&
                    intval($this->porcentajePostVisita) == floatval($this->porcentajePostVisita);

                if (!$isInteger) {
                    $context
                        ->buildViolation('Debe ingresar un valor entero.')
                        ->atPath('porcentajePostVisita')
                        ->addViolation();
                }
            }
        }
    }
}
