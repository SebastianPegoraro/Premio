<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * OrganizacionProveedor
 *
 * @ORM\Table(name="organizacion_proveedor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganizacionProveedorRepository")
 * @UniqueEntity(fields={"organizacion", "nombre"}, message="Ud. agregó dos proveedores con el mismo nombre.")
 */
class OrganizacionProveedor
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var Organizacion
     *
     * @ORM\ManyToOne(targetEntity="Organizacion", inversedBy="proveedores")
     * @ORM\JoinColumn(name="organizacion_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $organizacion;

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
     * @return OrganizacionProveedor
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
     * Set organizacion
     *
     * @param \AppBundle\Entity\Organizacion $organizacion
     *
     * @return OrganizacionProveedor
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
}
