<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Traits\BlameableTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * FormularioEvaluacion
 *
 * @ORM\Table(name="formulario_evaluacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormularioEvaluacionRepository")
 * 
 */
class FormularioEvaluacion
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CriterioEvaluacion", mappedBy="formularioEvaluacion", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     */
    private $criteriosEvaluacion;

    /**
     * @ORM\OneToMany(targetEntity="FormularioEvaluadorPremio", mappedBy="formularioEvaluacion")
     */
    private $evaluadorPremioFormularios;

    /**
     * @ORM\OneToMany(targetEntity="FormularioEquipo", mappedBy="formularioEvaluacion")
     */
    private $equipoFormularios;

    /**
     * @ORM\OneToMany(targetEntity="Premio", mappedBy="formularioEvaluacion")
     */
    private $premios;

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
     * @return FormularioEvaluacion
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
     * Set version
     *
     * @param string $version
     *
     * @return FormularioEvaluacion
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->criteriosEvaluacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evaluadorPremioFormularios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipoFormularios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add criterioEvaluacion
     *
     * @param \AppBundle\Entity\CriterioEvaluacion $criterioEvaluacion
     *
     * @return FormularioEvaluacion
     */
    public function addCriteriosEvaluacion(\AppBundle\Entity\CriterioEvaluacion $criterioEvaluacion)
    {
        $criterioEvaluacion->setFormularioEvaluacion($this);

        $this->criteriosEvaluacion[] = $criterioEvaluacion;

        return $this;
    }

    /**
     * Remove criterioEvaluacion
     *
     * @param \AppBundle\Entity\CriterioEvaluacion $criterioEvaluacion
     */
    public function removeCriteriosEvaluacion(\AppBundle\Entity\CriterioEvaluacion $criterioEvaluacion)
    {
        $this->criteriosEvaluacion->removeElement($criterioEvaluacion);
    }

    /**
     * Get criteriosEvaluacion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCriteriosEvaluacion()
    {
        return $this->criteriosEvaluacion;
    }

    public function getCriteriosEvaluacionRaiz()
    {
        return $this->criteriosEvaluacion->filter(
            function($c) {
                return !$c->getParent();
            }
        );
    }

    public function __toString()
    {
        return $this->nombre . ' (' . $this->version .')';
    }

    /**
     * Add premio
     *
     * @param \AppBundle\Entity\premio $premio
     *
     * @return FormularioEvaluacion
     */
    public function addPremio(\AppBundle\Entity\premio $premio)
    {
        $this->premios[] = $premio;

        return $this;
    }

    /**
     * Remove premio
     *
     * @param \AppBundle\Entity\premio $premio
     */
    public function removePremio(\AppBundle\Entity\premio $premio)
    {
        $this->premios->removeElement($premio);
    }

    /**
     * Get premios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPremios()
    {
        return $this->premios;
    }

    public function getPuntajeMaximo()
    {
        $t = 0;
        foreach ($this->criteriosEvaluacion as $c) {
            if (!$c->getChildren()->count()) {
                $t += $c->getPuntajeMaximo();
            }
        }

        return $t;
    }

    /**
     * Add evaluadorPremioFormulario
     *
     * @param \AppBundle\Entity\FormularioEvaluadorPremio $evaluadorPremioFormulario
     *
     * @return FormularioEvaluacion
     */
    public function addEvaluadorPremioFormulario(\AppBundle\Entity\FormularioEvaluadorPremio $evaluadorPremioFormulario)
    {
        $this->evaluadorPremioFormularios[] = $evaluadorPremioFormulario;

        return $this;
    }

    /**
     * Remove evaluadorPremioFormulario
     *
     * @param \AppBundle\Entity\FormularioEvaluadorPremio $evaluadorPremioFormulario
     */
    public function removeEvaluadorPremioFormulario(\AppBundle\Entity\FormularioEvaluadorPremio $evaluadorPremioFormulario)
    {
        $this->evaluadorPremioFormularios->removeElement($evaluadorPremioFormulario);
    }

    /**
     * Get evaluadorPremioFormularios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluadorPremioFormularios()
    {
        return $this->evaluadorPremioFormularios;
    }

    /**
     * Add equipoFormulario
     *
     * @param \AppBundle\Entity\FormularioEquipo $equipoFormulario
     *
     * @return FormularioEvaluacion
     */
    public function addEquipoFormulario(\AppBundle\Entity\FormularioEquipo $equipoFormulario)
    {
        $this->equipoFormularios[] = $equipoFormulario;

        return $this;
    }

    /**
     * Remove equipoFormulario
     *
     * @param \AppBundle\Entity\FormularioEquipo $equipoFormulario
     */
    public function removeEquipoFormulario(\AppBundle\Entity\FormularioEquipo $equipoFormulario)
    {
        $this->equipoFormularios->removeElement($equipoFormulario);
    }

    /**
     * Get equipoFormularios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipoFormularios()
    {
        return $this->equipoFormularios;
    }
}
