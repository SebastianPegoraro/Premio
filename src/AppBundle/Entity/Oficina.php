<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oficina
 *
 * @ORM\Table(name="oficina")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OficinaRepository")
 */
class Oficina
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
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="cuof", type="integer")
     */
    private $cuof;

    /**
     * @var Jurisdiccion
     *
     * @ORM\ManyToOne(targetEntity="Jurisdiccion", inversedBy="oficinas")
     * @ORM\JoinColumn(name="jurisdiccion_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $jurisdiccion;

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
     * @return Oficina
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
     * Set cuof 
     *
     * @param integer $cuof 
     *
     * @return Oficina
     */
    public function setCuof($cuof)
    {
        $this->cuof  = $cuof;

        return $this;
    }

    /**
     * Get cuof 
     *
     * @return int
     */
    public function getCuof()
    {
        return $this->cuof;
    }

    /**
     * Set jurisdiccion
     *
     * @param \AppBundle\Entity\Jurisdiccion $jurisdiccion
     *
     * @return Oficina
     */
    public function setJurisdiccion(\AppBundle\Entity\Jurisdiccion $jurisdiccion = null)
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
}
