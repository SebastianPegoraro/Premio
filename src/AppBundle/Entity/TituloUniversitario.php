<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TituloUniversitario
 *
 * @ORM\Table(name="titulo_universitario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TituloUniversitarioRepository")
 */
class TituloUniversitario
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
     * @ORM\OneToMany(targetEntity="EvaluadorEstudioUniversitario", mappedBy="tituloUniversitario")
     */
    private $evaluadorEstudiosUniversitarios;

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
     * @return TituloUniversitario
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
     * __toString Method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nombre;
    }
}

