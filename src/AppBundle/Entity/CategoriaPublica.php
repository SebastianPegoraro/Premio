<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * CategoriaPublica
 *
 * @ORM\Table(name="categoria_publica")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaPublicaRepository")
 */
class CategoriaPublica
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
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="OrganizacionPublica", mappedBy="categoria") 
     */
    private $publicaOrganizaciones;

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
     * @return CategoriaPublica
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
     * Constructor
     */
    public function __construct()
    {
        $this->publicaOrganizaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add publicaOrganizacione
     *
     * @param \AppBundle\Entity\OrganizacionPublica $publicaOrganizacione
     *
     * @return CategoriaPublica
     */
    public function addPublicaOrganizacione(\AppBundle\Entity\OrganizacionPublica $publicaOrganizacione)
    {
        $this->publicaOrganizaciones[] = $publicaOrganizacione;

        return $this;
    }

    /**
     * Remove publicaOrganizacione
     *
     * @param \AppBundle\Entity\OrganizacionPublica $publicaOrganizacione
     */
    public function removePublicaOrganizacione(\AppBundle\Entity\OrganizacionPublica $publicaOrganizacione)
    {
        $this->publicaOrganizaciones->removeElement($publicaOrganizacione);
    }

    /**
     * Get publicaOrganizaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublicaOrganizaciones()
    {
        return $this->publicaOrganizaciones;
    }

    /**
     * __toString method
     */
    public function __toString()
    {
        return 'Categoría: ' . $this->nombre;
    }
}
