<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * OrganizacionPublica
 *
 * @ORM\Table(name="organizacion_publica")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganizacionPublicaRepository")
 */
class OrganizacionPublica extends Organizacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="ley_y_decreto", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $leyYDecreto;

    /**
     * @var Jurisdiccion
     *
     * @ORM\ManyToOne(targetEntity="Jurisdiccion")
     * @ORM\JoinColumn(name="jurisdiccion_id", referencedColumnName="id", nullable=false)
     * 
     * @Assert\NotNull()
     */
    private $jurisdiccion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_en_premio_oficina", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $responsableEnPremioOficina;

    /**
     * @var CategoriaPublica
     *
     * @ORM\ManyToOne(targetEntity="CategoriaPublica", inversedBy="publicaOrganizaciones")
     * @ORM\JoinColumn(name="categoria_publica_id", referencedColumnName="id", nullable=false)
     * 
     * @Assert\NotNull()
     */
    private $categoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_trabajadores_planta_permanente", type="integer", nullable=true)
     *
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min=1)
     */
    private $cantTrabajadoresPlantaPermanente;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_trabajadores_planta_transitoria", type="integer", nullable=true)
     * 
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    private $cantTrabajadoresPlantaTransitoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_trabajadores_otras_modalidades", type="integer", nullable=true)
     *
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    private $cantTrabajadoresOtrasModalidades;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="OrganizacionPublicaPresupuesto", mappedBy="organizacionPublica", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     */
    private $presupuestos;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->presupuestos = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set leyYDecreto
     *
     * @param string $leyYDecreto
     *
     * @return OrganizacionPublica
     */
    public function setLeyYDecreto($leyYDecreto)
    {
        $this->leyYDecreto = $leyYDecreto;

        return $this;
    }

    /**
     * Get leyYDecreto
     *
     * @return string
     */
    public function getLeyYDecreto()
    {
        return $this->leyYDecreto;
    }

    /**
     * Set cantTrabajadoresPlantaPermanente
     *
     * @param integer $cantTrabajadoresPlantaPermanente
     *
     * @return OrganizacionPublica
     */
    public function setCantTrabajadoresPlantaPermanente($cantTrabajadoresPlantaPermanente)
    {
        $this->cantTrabajadoresPlantaPermanente = $cantTrabajadoresPlantaPermanente;

        return $this;
    }

    /**
     * Get cantTrabajadoresPlantaPermanente
     *
     * @return integer
     */
    public function getCantTrabajadoresPlantaPermanente()
    {
        return $this->cantTrabajadoresPlantaPermanente;
    }

    /**
     * Set cantTrabajadoresPlantaTransitoria
     *
     * @param integer $cantTrabajadoresPlantaTransitoria
     *
     * @return OrganizacionPublica
     */
    public function setCantTrabajadoresPlantaTransitoria($cantTrabajadoresPlantaTransitoria)
    {
        $this->cantTrabajadoresPlantaTransitoria = $cantTrabajadoresPlantaTransitoria;

        return $this;
    }

    /**
     * Get cantTrabajadoresPlantaTransitoria
     *
     * @return integer
     */
    public function getCantTrabajadoresPlantaTransitoria()
    {
        return $this->cantTrabajadoresPlantaTransitoria;
    }

    /**
     * Set cantTrabajadoresOtrasModalidades
     *
     * @param integer $cantTrabajadoresOtrasModalidades
     *
     * @return OrganizacionPublica
     */
    public function setCantTrabajadoresOtrasModalidades($cantTrabajadoresOtrasModalidades)
    {
        $this->cantTrabajadoresOtrasModalidades = $cantTrabajadoresOtrasModalidades;

        return $this;
    }

    /**
     * Get cantTrabajadoresOtrasModalidades
     *
     * @return integer
     */
    public function getCantTrabajadoresOtrasModalidades()
    {
        return $this->cantTrabajadoresOtrasModalidades;
    }

    /**
     * Set jurisdiccion
     *
     * @param \AppBundle\Entity\Jurisdiccion $jurisdiccion
     *
     * @return OrganizacionPublica
     */
    public function setJurisdiccion(\AppBundle\Entity\Jurisdiccion $jurisdiccion)
    {
        $this->jurisdiccion = $jurisdiccion;

        return $this;
    }

    /**
     * Get jurisdiccion
     *
     * @return \AppBundle\Entity\Jurisdiccion
     */
    public function getJurisdiccion()
    {
        return $this->jurisdiccion;
    }

    /**
     * Set categoria
     *
     * @param \AppBundle\Entity\CategoriaPublica $categoria
     *
     * @return OrganizacionPublica
     */
    public function setCategoria(\AppBundle\Entity\CategoriaPublica $categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\CategoriaPublica
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add presupuesto
     *
     * @param \AppBundle\Entity\OrganizacionPublicaPresupuesto $presupuesto
     *
     * @return OrganizacionPublica
     */
    public function addPresupuesto(\AppBundle\Entity\OrganizacionPublicaPresupuesto $presupuesto)
    {
        $presupuesto->setOrganizacionPublica($this);

        $this->presupuestos[] = $presupuesto;

        return $this;
    }

    /**
     * Remove presupuesto
     *
     * @param \AppBundle\Entity\OrganizacionPublicaPresupuesto $presupuesto
     */
    public function removePresupuesto(\AppBundle\Entity\OrganizacionPublicaPresupuesto $presupuesto)
    {
        $this->presupuestos->removeElement($presupuesto);
    }

    /**
     * Get presupuestos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPresupuestos()
    {
        return $this->presupuestos;
    }

    /**
     * Get responsableEnPremioOficina
     *
     * @return string
     */
    public function getResponsableEnPremioOficina()
    {
        return $this->responsableEnPremioOficina;
    }
     
    /**
     * Set responsableEnPremioOficina
     *
     * @param string $responsableEnPremioOficina Oficina del responsable frente al premio 
     *
     * @return OrganizacionPublica
     */
    public function setResponsableEnPremioOficina($responsableEnPremioOficina)
    {
        $this->responsableEnPremioOficina = $responsableEnPremioOficina;
        return $this;
    }
}
