<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use AppBundle\Entity\Traits\BlameableTrait;
use AppBundle\Entity\CriterioEvaluacion;

/**
 * FormularioEvaluadorPremio
 *
 * @ORM\Table(name="formulario_evaluador_premio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormularioEvaluadorPremioRepository")
 */
class FormularioEvaluadorPremio
{
    use BlameableTrait;
    use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity="RespuestaEvaluacion", mappedBy="formulario", cascade={"persist"})
     * @Assert\Valid()
     */
    private $respuestas;

    /**
     * @ORM\OneToOne(targetEntity="EvaluadorPremio", inversedBy="formularioEvaluacion")
     * @ORM\JoinColumn(name="evaluadorpremio_id", referencedColumnName="id")
     */
    private $evaluadorPremio;

    /**
     * @ORM\ManyToOne(targetEntity="FormularioEvaluacion", inversedBy="evaluadorPremioFormularios")
     * @ORM\JoinColumn(name="formulario_evaluacion_id", referencedColumnName="id")
     */
    private $formularioEvaluacion;

    /**
     * @var bool
     *
     * @ORM\Column(name="enviado", type="boolean", nullable=false, options={"default" : 0})
     */
    private $enviado;

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
     * Constructor
     */
    public function __construct()
    {
        $this->respuestas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enviado = 0;
    }

    /**
     * Add respuesta
     *
     * @param \AppBundle\Entity\RespuestaEvaluacion $respuesta
     *
     * @return FormularioEvaluadorPremio
     */
    public function addRespuesta(\AppBundle\Entity\RespuestaEvaluacion $respuesta)
    {
        $respuesta->setFormulario($this);

        $this->respuestas[] = $respuesta;

        return $this;
    }

    /**
     * Remove respuesta
     *
     * @param \AppBundle\Entity\RespuestaEvaluacion $respuesta
     */
    public function removeRespuesta(\AppBundle\Entity\RespuestaEvaluacion $respuesta)
    {
        $this->respuestas->removeElement($respuesta);
    }

    /**
     * Get respuestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * Set evaluadorPremio
     *
     * @param \AppBundle\Entity\EvaluadorPremio $evaluadorPremio
     *
     * @return FormularioEvaluadorPremio
     */
    public function setEvaluadorPremio(\AppBundle\Entity\EvaluadorPremio $evaluadorPremio = null)
    {
        $this->evaluadorPremio = $evaluadorPremio;

        return $this;
    }

    /**
     * Get evaluadorPremio
     *
     * @return \AppBundle\Entity\EvaluadorPremio
     */
    public function getEvaluadorPremio()
    {
        return $this->evaluadorPremio;
    }

    /**
     * Set formularioEvaluacion
     *
     * @param \AppBundle\Entity\FormularioEvaluacion $formularioEvaluacion
     *
     * @return FormularioEvaluadorPremio
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

    /**
     * Set enviado
     *
     * @param boolean $enviado
     *
     * @return FormularioEvaluadorPremio
     */
    public function setEnviado($enviado)
    {
        $this->enviado = $enviado;

        return $this;
    }

    /**
     * Get enviado
     *
     * @return boolean
     */
    public function getEnviado()
    {
        return $this->enviado;
    }

    public function getPuntaje()
    {
        $pt = 0;

        foreach ($this->respuestas as $r) {
            $pt += $r->getPuntaje();
        }

        return $pt;
    }

    public function getPorcentaje()
    {
        $pt = $this->getPuntaje();

        return ($pt*100)/$this->getFormularioEvaluacion()->getPuntajeMaximo();
    }

    public function getRespuestasRaiz()
    {
        return $this->respuestas->filter(
            function(RespuestaEvaluacion $rta) {
                return !$rta->getParent();
            }
        );
    }

    public function getRespuestaDeCriterio(CriterioEvaluacion $criterio) {
        foreach ($this->respuestas as $r) {
            $rta = $this->getRta($criterio, $r);
            if ($rta) {
                return $rta;
            }
        }

        return null;
    }

    protected function getRta(CriterioEvaluacion $criterio, RespuestaEvaluacion $r) {
        if ($r->getCriterio()->getId() == $criterio->getId()) {
            return $r;
        }

        foreach ($r->getChildren() as $rr) {
            $rta = $this->getRta($criterio, $rr);
            if ($rta) {
                return $rta;
            }
        }

        return null;
    }
}
