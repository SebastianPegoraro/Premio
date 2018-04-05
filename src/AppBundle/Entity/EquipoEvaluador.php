<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use AppBundle\Entity\Traits\BlameableTrait;

/**
 * EquipoEvaluador
 *
 * @ORM\Table(name="equipo_evaluador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipoEvaluadorRepository")
 *
 * @UniqueEntity(
 *     fields = {"premio", "organizacion"},
 *     message = "Esta organización ya ha sido selecionada en otro equipo.",
 *     errorPath = "organizacion" 
 * )
 */
class EquipoEvaluador
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
     * @var Premio
     *
     * @ORM\ManyToOne(targetEntity="Premio", inversedBy="equipos")
     * @ORM\JoinColumn(name="premio_id", referencedColumnName="id", onDelete="RESTRICT", nullable=false)
     * @Assert\NotNull()
     */
    private $premio;

    /**
     * @var Organizacion
     *
     * @ORM\OneToOne(targetEntity="Organizacion", inversedBy="equipo")
     * @ORM\JoinColumn(name="organizacion_id", referencedColumnName="id", onDelete="RESTRICT", nullable=false)
     * @Assert\NotNull()
     */
    private $organizacion;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorPremio", mappedBy="equipo", cascade={ "persist", "remove" })
     */
    private $evaluadores;

    /**
     * @var FormularioEquipo
     *
     * @ORM\OneToOne(targetEntity="FormularioEquipo", mappedBy="equipo")
     */
    private $formulario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evaluadores = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return EquipoEvaluador
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
     * Set premio
     *
     * @param \AppBundle\Entity\Premio $premio
     *
     * @return EquipoEvaluador
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
     * Set organizacion
     *
     * @param \AppBundle\Entity\Organizacion $organizacion
     *
     * @return EquipoEvaluador
     */
    public function setOrganizacion(\AppBundle\Entity\Organizacion $organizacion)
    {
        $this->organizacion = $organizacion;

        return $this;
    }

    /**
     * Get organizacion
     *
     * @return \AppBundle\Entity\Organizacion
     */
    public function getOrganizacion()
    {
        return $this->organizacion;
    }

    /**
     * Add evaluadore
     *
     * @param \AppBundle\Entity\EvaluadorPremio $evaluadore
     *
     * @return EquipoEvaluador
     */
    public function addEvaluadore(\AppBundle\Entity\EvaluadorPremio $evaluadore)
    {
        $evaluadore->setEquipo($this);

        $this->evaluadores[] = $evaluadore;

        return $this;
    }

    /**
     * Remove evaluadore
     *
     * @param \AppBundle\Entity\EvaluadorPremio $evaluadore
     */
    public function removeEvaluadore(\AppBundle\Entity\EvaluadorPremio $evaluadore)
    {
        $evaluadore->setEquipo(null);

        $this->evaluadores->removeElement($evaluadore);
    }

    /**
     * Get evaluadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluadores()
    {
        return $this->evaluadores;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function getJefeDeEquipo()
    {
        $ejs = $this->evaluadores->filter(function($e) {
            return $e->getEsJefeDeEquipo();
        });

        return $ejs->count() > 0 ? $ejs->first() : null; 
    }

    /**
     * Set formulario
     *
     * @param \AppBundle\Entity\FormularioEquipo $formulario
     *
     * @return EquipoEvaluador
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
        return $this->formulario;
    }

    /**
     * Verifica si un Evaluador en un Premio es jefe de este equipo.
     *
     * @return boolean
     */
    public function esJefe(EvaluadorPremio $ep)
    {
        $jefe = $this->getJefeDeEquipo();

        return $jefe && ($jefe->getId() == $ep->getId());
    }

    public function fueronEnviadosTodosLosFormularios()
    {
        return $this->evaluadores->forAll(function($k, $ep){
            return $ep->getFormularioEvaluacion() && $ep->getFormularioEvaluacion()->getEnviado();
        });
    }

    public function esMiembro(EvaluadorPremio $ep)
    {
        return $this->id && $ep->getEquipo() && $this->id == $ep->getEquipo()->getId();
    }
}
