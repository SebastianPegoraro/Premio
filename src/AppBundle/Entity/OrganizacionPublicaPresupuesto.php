<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * OrganizacionPublicaPresupuesto
 *
 * @ORM\Table(name="organizacion_publica_presupuesto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganizacionPublicaPresupuestoRepository")
 */
class OrganizacionPublicaPresupuesto
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
     * @ORM\Column(name="anio", type="integer")
     * @Assert\NotBlank()
     */
    private $anio;

    /**
     * @var int
     *
     * @ORM\Column(name="monto", type="integer", nullable=true)
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min=0)
     */
    private $monto;

    /**
     * @var OrganizacionPublica
     *
     * @ORM\ManyToOne(targetEntity="OrganizacionPublica", inversedBy="presupuestos")
     * @ORM\JoinColumn(name="organizacion_publica_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $organizacionPublica;

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
     * Set anio
     *
     * @param integer $anio
     *
     * @return OrganizacionPublicaPresupuesto
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
     * Set monto
     *
     * @param integer $monto
     *
     * @return OrganizacionPublicaPresupuesto
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return int
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set organizacionPublica
     *
     * @param \AppBundle\Entity\OrganizacionPublica $organizacionPublica
     *
     * @return OrganizacionPublicaPresupuesto
     */
    public function setOrganizacionPublica(\AppBundle\Entity\OrganizacionPublica $organizacionPublica)
    {
        $this->organizacionPublica = $organizacionPublica;

        return $this;
    }

    /**
     * Get organizacionPublica
     *
     * @return \AppBundle\Entity\OrganizacionPublica
     */
    public function getOrganizacionPublica()
    {
        return $this->organizacionPublica;
    }
}
