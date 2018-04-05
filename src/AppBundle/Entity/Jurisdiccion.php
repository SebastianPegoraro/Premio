<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Jurisdiccion
 *
 * @ORM\Table(name="jurisdiccion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JurisdiccionRepository")
 * @UniqueEntity(fields={"nombre"})
 * @UniqueEntity(fields={"numero"})
 */
class Jurisdiccion
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
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Oficina", mappedBy="jurisdiccion")
     */
    private $oficinas;

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
     * @return Jurisdiccion
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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Jurisdiccion
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->oficinas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add oficina
     *
     * @param \AppBundle\Entity\Oficina $oficina
     *
     * @return Jurisdiccion
     */
    public function addOficina(\AppBundle\Entity\Oficina $oficina)
    {
        $this->oficinas[] = $oficina;

        return $this;
    }

    /**
     * Remove oficina
     *
     * @param \AppBundle\Entity\Oficina $oficina
     */
    public function removeOficina(\AppBundle\Entity\Oficina $oficina)
    {
        $this->oficinas->removeElement($oficina);
    }

    /**
     * Get oficinas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOficinas()
    {
        return $this->oficinas;
    }

    public function __toString()
    {
        $ret = $this->nombre;

        if ($this->numero) {
            $ret = $this->numero . ' - ' . $ret;
        }

        return $ret;
    }
}
