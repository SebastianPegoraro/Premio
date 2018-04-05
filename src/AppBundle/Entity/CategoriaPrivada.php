<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaPrivada
 *
 * @ORM\Table(name="categoria_privada")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaPrivadaRepository")
 */
class CategoriaPrivada
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="OrganizacionPrivada", mappedBy="categoria") 
     */
    private $privadaOrganizaciones;

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
     * @return CategoriaPrivada
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

    public function __toString()
    {
        return 'Categoría: ' . $this->nombre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->privadaOrganizaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add privadaOrganizacione
     *
     * @param \AppBundle\Entity\OrganizacionPrivada $privadaOrganizacione
     *
     * @return CategoriaPrivada
     */
    public function addPrivadaOrganizacione(\AppBundle\Entity\OrganizacionPrivada $privadaOrganizacione)
    {
        $this->privadaOrganizaciones[] = $privadaOrganizacione;

        return $this;
    }

    /**
     * Remove privadaOrganizacione
     *
     * @param \AppBundle\Entity\OrganizacionPrivada $privadaOrganizacione
     */
    public function removePrivadaOrganizacione(\AppBundle\Entity\OrganizacionPrivada $privadaOrganizacione)
    {
        $this->privadaOrganizaciones->removeElement($privadaOrganizacione);
    }

    /**
     * Get privadaOrganizaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrivadaOrganizaciones()
    {
        return $this->privadaOrganizaciones;
    }
}
