<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use AppBundle\Entity\Traits\BlameableTrait;

/**
 * EvaluadorPremio
 *
 * @ORM\Table(name="evaluador_premio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorPremioRepository")
 */
class EvaluadorPremio
{
    use TimestampableEntity;
    use BlameableTrait;
    
    //Evaluador inscripto
    const ESTADO_PENDIENTE = 'pendiente';

    //El Evaluador no aprobó el curso.
    const ESTADO_NO_APROBADO = 'no_aprobado';
    
    //El Evaluador aprobó el curso.
    const ESTADO_APROBADO  = 'aprobado';
    
    //El Evaluador es un evaluador activo en premio
    const ESTADO_ACTIVO = 'activo';

    //El Evaluador era un evaluador activo en premio y se dio debaja
    const ESTADO_BAJA = 'baja';

    public static $estados = array(
        self::ESTADO_PENDIENTE   => self::ESTADO_PENDIENTE,
        self::ESTADO_NO_APROBADO => self::ESTADO_NO_APROBADO,
        self::ESTADO_APROBADO    => self::ESTADO_APROBADO,
        self::ESTADO_ACTIVO      => self::ESTADO_ACTIVO,
        self::ESTADO_BAJA        => self::ESTADO_BAJA,
    );

    public static $estadosSiguientes = array(
        self::ESTADO_PENDIENTE   => array(self::ESTADO_PENDIENTE, self::ESTADO_NO_APROBADO, self::ESTADO_APROBADO),
        self::ESTADO_NO_APROBADO => array(self::ESTADO_NO_APROBADO),
        self::ESTADO_APROBADO    => array(self::ESTADO_APROBADO, self::ESTADO_ACTIVO),
        self::ESTADO_ACTIVO      => array(self::ESTADO_ACTIVO, self::ESTADO_BAJA ),  
        self::ESTADO_BAJA      => array(self::ESTADO_BAJA),  
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
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="evaluadorPremios")
     * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * 
     * @Assert\Valid()
     */
    private $evaluador;

    /**
     * @var Premio
     *
     * @ORM\ManyToOne(targetEntity="Premio", inversedBy="premioEvaluadores")
     * @ORM\JoinColumn(name="premio_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $premio;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=20)
     */
    private $estado;

    /**
     * @ORM\OneToOne(targetEntity="FormularioEvaluadorPremio", mappedBy="evaluadorPremio")
     */
    private $formularioEvaluacion;

    /**
     * @var EquipoEvaluador
     * 
     * @ORM\ManyToOne(targetEntity="EquipoEvaluador", inversedBy="evaluadores")
     * @ORM\JoinColumn(name="equipo_evaluador_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $equipo;

    /**
     * @var bool
     *
     * @ORM\Column(name="es_jefe_de_equipo", type="boolean", nullable=false, options={"default" : 0})
     */
    private $esJefeDeEquipo;

    /**
     * @var string
     * 
     * @ORM\Column(name="categoria_asignada", type="string", length=255, nullable=true)
     */
    private $categoriaAsignada;

    public function __construct()
    {
        $this->estado = self::ESTADO_PENDIENTE;
        $this->esJefeDeEquipo = false;
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
     * Set evaluador
     *
     * @param \AppBundle\Entity\Evaluador $evaluador
     *
     * @return EvaluadorPremio
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

    /**
     * Set premio
     *
     * @param \AppBundle\Entity\Premio $premio
     *
     * @return EvaluadorPremio
     */
    public function setPremio(\AppBundle\Entity\Premio $premio)
    {
        $this->premio = $premio;

        return $this;
    }

    /**
     * Get premio
     *
     * @return \AppBundle\Entity\Premio
     */
    public function getPremio()
    {
        return $this->premio;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return EvaluadorPremio
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return $this->evaluador . ' (' . $this->premio . ')';
    }

    /**
     * Set equipo
     *
     * @param \AppBundle\Entity\EquipoEvaluador $equipo
     *
     * @return EvaluadorPremio
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
     * @param \AppBundle\Entity\FormularioEvaluadorPremio $formularioEvaluacion
     *
     * @return EvaluadorPremio
     */
    public function setFormularioEvaluacion(\AppBundle\Entity\FormularioEvaluadorPremio $formularioEvaluacion = null)
    {
        $this->formularioEvaluacion = $formularioEvaluacion;

        return $this;
    }

    /**
     * Get formularioEvaluacion
     *
     * @return \AppBundle\Entity\FormularioEvaluadorPremio
     */
    public function getFormularioEvaluacion()
    {
        return $this->formularioEvaluacion;
    }

    /**
     * Set categoriaAsignada
     *
     * @param string $categoriaAsignada
     *
     * @return EvaluadorPremio
     */
    public function setCategoriaAsignada($categoriaAsignada)
    {
        $this->categoriaAsignada = $categoriaAsignada;

        return $this;
    }

    /**
     * Get categoriaAsignada
     *
     * @return string
     */
    public function getCategoriaAsignada()
    {
        return $this->categoriaAsignada;
    }

    /**
     * Set esJefeDeEquipo
     *
     * @param boolean $esJefeDeEquipo
     *
     * @return EvaluadorPremio
     */
    public function setEsJefeDeEquipo($esJefeDeEquipo)
    {
        $this->esJefeDeEquipo = $esJefeDeEquipo;

        return $this;
    }

    /**
     * Get esJefeDeEquipo
     *
     * @return boolean
     */
    public function getEsJefeDeEquipo()
    {
        return $this->esJefeDeEquipo;
    }

    /**
     * @Assert\Callback
     */
    public function validateEsJefeDeEquipo(ExecutionContextInterface $context, $payload)
    {
        if (!$this->equipo && $this->esJefeDeEquipo) {
            $context->buildViolation('Este campo no debe estar seteado (evaluador sin equipo).')
                ->atPath('esJefeDeEquipo')
                ->addViolation();
        }

        /* if ($this->equipo) {
            $jefeDeEquipo = $this->equipo->getJefeDeEquipo();
            if ($this->id && $jefeDeEquipo && $this->id != $jefeDeEquipo->getId()) {
                $context
                    ->buildViolation(sprintf(
                        'El equipo "%s" ya tiene jefe: "%s".',
                        $this->equipo->__toString(), $jefeDeEquipo->getEvaluador()->__toString()
                    ))
                    ->atPath('esJefeDeEquipo')
                    ->addViolation();
            }
        } */
    }
}
