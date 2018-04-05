<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use AppBundle\Entity\Traits\BlameableTrait;

/**
 * Premio
 *
 * @ORM\Table(name="premio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PremioRepository")
 *
 * @UniqueEntity(fields = {"nombre", "anio"})
 * @UniqueEntity(fields = {"anio"})
 */
class Premio
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
     * @ORM\Column(name="anio", type="integer", unique=true)
     * @Assert\NotBlank()
     */
    private $anio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_inicio_inscripcion", type="datetime")
     * @Assert\NotBlank()
     */
    private $fechaHoraInicioInscripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin_inscripcion", type="datetime")
     * @Assert\NotBlank()
     */
    private $fechaHoraFinInscripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_inicio_concurso", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $fechaHoraInicioConcurso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_fin_concurso", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $fechaHoraFinConcurso;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EvaluadorPremio", mappedBy="premio")
     */
    private $premioEvaluadores;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Organizacion", mappedBy="premio")
     */
    private $organizaciones;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EquipoEvaluador", mappedBy="premio")
     */
    private $equipos;

    /**
     * @var FormularioEvaluacion
     *
     * @ORM\ManyToOne(targetEntity="FormularioEvaluacion", inversedBy="premios")
     * @ORM\JoinColumn(name="formulario_evaluacion_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $formularioEvaluacion;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="organizacionPremio", mappedBy="premio")
     */
    protected $organizacionPremios;


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
     * @return Premio
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
     * Set anio
     *
     * @param integer $anio
     *
     * @return Premio
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
     * Set fechaHoraInicioConcurso
     *
     * @param \DateTime $fechaHoraInicioConcurso
     *
     * @return Premio
     */
    public function setFechaHoraInicioConcurso($fechaHoraInicioConcurso)
    {
        $this->fechaHoraInicioConcurso = $fechaHoraInicioConcurso;

        return $this;
    }

    /**
     * Get fechaHoraInicioConcurso
     *
     * @return \DateTime
     */
    public function getFechaHoraInicioConcurso()
    {
        return $this->fechaHoraInicioConcurso;
    }

    /**
     * Set fechaHoraFinConcurso
     *
     * @param \DateTime $fechaHoraFinConcurso
     *
     * @return Premio
     */
    public function setFechaHoraFinConcurso($fechaHoraFinConcurso)
    {
        $this->fechaHoraFinConcurso = $fechaHoraFinConcurso;

        return $this;
    }

    /**
     * Get fechaHoraFinConcurso
     *
     * @return \DateTime
     */
    public function getFechaHoraFinConcurso()
    {
        return $this->fechaHoraFinConcurso;
    }

    /**
     * Set fechaHoraInicioInscripcion
     *
     * @param \DateTime $fechaHoraInicioInscripcion
     *
     * @return Premio
     */
    public function setFechaHoraInicioInscripcion($fechaHoraInicioInscripcion)
    {
        $this->fechaHoraInicioInscripcion = $fechaHoraInicioInscripcion;

        return $this;
    }

    /**
     * Get fechaHoraInicioInscripcion
     *
     * @return \DateTime
     */
    public function getFechaHoraInicioInscripcion()
    {
        return $this->fechaHoraInicioInscripcion;
    }

    /**
     * Set fechaHoraFinInscripcion
     *
     * @param \DateTime $fechaHoraFinInscripcion
     *
     * @return Premio
     */
    public function setFechaHoraFinInscripcion($fechaHoraFinInscripcion)
    {
        $this->fechaHoraFinInscripcion = $fechaHoraFinInscripcion;

        return $this;
    }

    /**
     * Get fechaHoraFinInscripcion
     *
     * @return \DateTime
     */
    public function getFechaHoraFinInscripcion()
    {
        return $this->fechaHoraFinInscripcion;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->premioEvaluadores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->organizaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add premioEvaluadore
     *
     * @param \AppBundle\Entity\EvaluadorPremio $premioEvaluadore
     *
     * @return Premio
     */
    public function addPremioEvaluadore(\AppBundle\Entity\EvaluadorPremio $premioEvaluadore)
    {
        $this->premioEvaluadores[] = $premioEvaluadore;

        return $this;
    }

    /**
     * Remove premioEvaluadore
     *
     * @param \AppBundle\Entity\EvaluadorPremio $premioEvaluadore
     */
    public function removePremioEvaluadore(\AppBundle\Entity\EvaluadorPremio $premioEvaluadore)
    {
        $this->premioEvaluadores->removeElement($premioEvaluadore);
    }

    /**
     * Get premioEvaluadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPremioEvaluadores()
    {
        return $this->premioEvaluadores;
    }

    public function esPeriodoDeInscripcion()
    {
        $datetime = new \DateTime();

        return ($datetime >= $this->fechaHoraInicioInscripcion && $datetime <= $this->fechaHoraFinInscripcion);
    }

    public function esPeriodoDeConcurso()
    {
        $datetime = new \DateTime();

        return ($datetime >= $this->fechaHoraInicioConcurso && $datetime <= $this->fechaHoraFinConcurso);
    }

    /**
     * @Assert\Callback
     */
    public function validatePeriodoInscripcion(ExecutionContextInterface $context)
    {
        if ($this->fechaHoraInicioInscripcion && !$this->estaEnAnioPremio($this->fechaHoraInicioInscripcion)) {
            $context
                ->buildViolation('El año de la fecha de inicio de inscripción debe coincidir con el año del concurso.')
                ->atPath('fechaHoraInicioInscripcion')
                ->addViolation();
        }

        if ($this->fechaHoraFinInscripcion && !$this->estaEnAnioPremio($this->fechaHoraFinInscripcion)) {
            $context
                ->buildViolation('El año de la fecha de fin de inscripción debe coincidir con el año del concurso.')
                ->atPath('fechaHoraFinInscripcion')
                ->addViolation();
        }

        if ($this->fechaHoraInicioInscripcion && $this->fechaHoraInicioInscripcion && $this->fechaHoraInicioInscripcion >= $this->fechaHoraFinInscripcion) {
            $context
                ->buildViolation('La fecha de inicio de inscripción debe ser menor que la fecha de fin de inscripción.')
                ->atPath('fechaHoraInicioInscripcion')
                ->addViolation();
        }
    }

    /**
     * @Assert\Callback
     */
    public function validatePeriodoConcurso(ExecutionContextInterface $context)
    {
        if (!$this->estaEnAnioPremio($this->fechaHoraInicioConcurso)) {
            $context
                ->buildViolation('El año de la fecha de inicio de concurso debe coincidir con el año del concurso.')
                ->atPath('fechaHoraInicioConcurso')
                ->addViolation();
        }

        if (!$this->estaEnAnioPremio($this->fechaHoraFinConcurso)) {
            $context
                ->buildViolation('El año de la fecha de fin de concurso debe coincidir con el año del concurso.')
                ->atPath('fechaHoraFinConcurso')
                ->addViolation();
        }

        if ($this->fechaHoraInicioConcurso >= $this->fechaHoraFinConcurso) {
            $context
                ->buildViolation('La fecha de inicio del concurso debe ser menor que la fecha de fin del concurso.')
                ->atPath('fechaHoraInicioInscripcion')
                ->addViolation();
        }
    }

    private function estaEnAnioPremio(\DateTime $fecha)
    {
        return $fecha->format('Y') == $this->anio;
    }

    /**
     * Add organizacione
     *
     * @param \AppBundle\Entity\Organizacion $organizacione
     *
     * @return Premio
     */
    public function addOrganizacione(\AppBundle\Entity\Organizacion $organizacione)
    {
        $this->organizaciones[] = $organizacione;

        return $this;
    }

    /**
     * Remove organizacione
     *
     * @param \AppBundle\Entity\Organizacion $organizacione
     */
    public function removeOrganizacione(\AppBundle\Entity\Organizacion $organizacione)
    {
        $this->organizaciones->removeElement($organizacione);
    }

    /**
     * Get organizaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrganizaciones()
    {
        return $this->organizaciones;
    }

    /**
     * Add equipo
     *
     * @param \AppBundle\Entity\EquipoEvaluador $equipo
     *
     * @return Premio
     */
    public function addEquipo(\AppBundle\Entity\EquipoEvaluador $equipo)
    {
        $this->equipos[] = $equipo;

        return $this;
    }

    /**
     * Remove equipo
     *
     * @param \AppBundle\Entity\EquipoEvaluador $equipo
     */
    public function removeEquipo(\AppBundle\Entity\EquipoEvaluador $equipo)
    {
        $this->equipos->removeElement($equipo);
    }

    /**
     * Get equipos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipos()
    {
        return $this->equipos;
    }

    /**
     * Set formularioEvaluacion
     *
     * @param \AppBundle\Entity\FormularioEvaluacion $formularioEvaluacion
     *
     * @return Premio
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
     * Add organizacionPremio
     *
     * @param \AppBundle\Entity\organizacionPremio $organizacionPremio
     *
     * @return Premio
     */
    public function addOrganizacionPremio(\AppBundle\Entity\organizacionPremio $organizacionPremio)
    {
        $this->organizacionPremios[] = $organizacionPremio;

        return $this;
    }

    /**
     * Remove organizacionPremio
     *
     * @param \AppBundle\Entity\organizacionPremio $organizacionPremio
     */
    public function removeOrganizacionPremio(\AppBundle\Entity\organizacionPremio $organizacionPremio)
    {
        $this->organizacionPremios->removeElement($organizacionPremio);
    }

    /**
     * Get organizacionPremios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrganizacionPremios()
    {
        return $this->organizacionPremios;
    }
}
