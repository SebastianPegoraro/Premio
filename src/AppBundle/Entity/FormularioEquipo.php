<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use AppBundle\Entity\Traits\BlameableTrait;



/**
 * FormularioEquipo
 *
 * @ORM\Table(name="formulario_equipo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormularioEquipoRepository")
 */
class FormularioEquipo
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
     * @ORM\OneToMany(targetEntity="RespuestaEvaluacionEquipo", mappedBy="formulario", cascade={"persist"})
     * @Assert\Valid()
     */
    private $respuestas;

    /**
     * @ORM\OneToOne(targetEntity="EquipoEvaluador", inversedBy="formulario")
     * @ORM\JoinColumn(name="equipo_id", referencedColumnName="id")
     */
    private $equipo;

    /**
     * @ORM\ManyToOne(targetEntity="FormularioEvaluacion", inversedBy="equipoFormularios")
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
     * @var bool
     *
     * @ORM\Column(name="enviado_post_visita", type="boolean", nullable=false, options={"default" : 0})
     */
    private $enviadoPostVisita;

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
        $this->enviado = false;
        $this->enviadoPostVisita = false;
    }

    /**
     * Add respuesta
     *
     * @param \AppBundle\Entity\RespuestaEvaluacionEquipo $respuesta
     *
     * @return FormularioEquipo
     */
    public function addRespuesta(\AppBundle\Entity\RespuestaEvaluacionEquipo $respuesta)
    {
        $respuesta->setFormulario($this);

        $this->respuestas[] = $respuesta;

        return $this;
    }

    /**
     * Remove respuesta
     *
     * @param \AppBundle\Entity\RespuestaEvaluacionEquipo $respuesta
     */
    public function removeRespuesta(\AppBundle\Entity\RespuestaEvaluacionEquipo $respuesta)
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
     * Set equipo
     *
     * @param \AppBundle\Entity\EquipoEvaluador $equipo
     *
     * @return FormularioEquipo
     */
    public function setEquipo(\AppBundle\Entity\EquipoEvaluador $equipo = null)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * Get equipo
     *
     * @return \AppBundle\Entity\EquipoEvaluador
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * Set formularioEvaluacion
     *
     * @param \AppBundle\Entity\FormularioEvaluacion $formularioEvaluacion
     *
     * @return FormularioEquipo
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

    public function getPuntajeConsensuado()
    {
        $pt = 0;

        foreach ($this->respuestas as $r) {
            $pt += $r->getPuntajeConsensuado();
        }

        return $pt;
    }

    public function getPorcentajeConsensuado()
    {
        $pt = $this->getPuntajeConsensuado();

        return ($pt*100)/$this->getFormularioEvaluacion()->getPuntajeMaximo();
    }

    public function getPuntajePostVisita()
    {
        $pt = 0;

        foreach ($this->respuestas as $r) {
            $pt += $r->getPuntajePostVisita();
        }

        return $pt;
    }

    public function getPorcentajePostVisita()
    {
        $pt = $this->getPuntajePostVisita();

        return ($pt*100)/$this->getFormularioEvaluacion()->getPuntajeMaximo();
    }


    /**
     * Set enviado
     *
     * @param boolean $enviado
     *
     * @return FormularioEquipo
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

    public function getRespuestasRaiz()
    {
        return $this->respuestas->filter(
            function(RespuestaEvaluacionEquipo $rta) {
                return !$rta->getParent();
            }
        );
    }

    /**
     * Set enviadoPostVisita
     *
     * @param boolean $enviadoPostVisita
     *
     * @return FormularioEquipo
     */
    public function setEnviadoPostVisita($enviadoPostVisita)
    {
        $this->enviadoPostVisita = $enviadoPostVisita;

        return $this;
    }

    /**
     * Get enviadoPostVisita
     *
     * @return boolean
     */
    public function getEnviadoPostVisita()
    {
        return $this->enviadoPostVisita;
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

    protected function getRta(CriterioEvaluacion $criterio, RespuestaEvaluacionEquipo $r) {
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

    public function getPostVisitaCompleto() {
        return $this->respuestas->count() > 0 &&
            $this->respuestas->forAll(function($key, $elem) {
                return !empty($elem->getPorcentajePostVisita());
            });
    }
}
