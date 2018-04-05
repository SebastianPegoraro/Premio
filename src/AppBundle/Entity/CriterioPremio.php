<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CriterioPremio
 *
 * @ORM\Table(name="criterio_premio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CriterioPremioRepository")
 */
class CriterioPremio
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
     * @var orden
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    private $orden;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorCriterioPremio", mappedBy="criterioPremio")
     */
    private $evaluadorPremioCriterios;

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
     * @return CriterioPremio
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
        $this->evaluadorPremioCriterios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add evaluadorPremioCriterio
     *
     * @param \AppBundle\Entity\EvaluadorCriterioPremio $evaluadorPremioCriterio
     *
     * @return CriterioPremio
     */
    public function addEvaluadorPremioCriterio(\AppBundle\Entity\EvaluadorCriterioPremio $evaluadorPremioCriterio)
    {
        $this->evaluadorPremioCriterios[] = $evaluadorPremioCriterio;

        return $this;
    }

    /**
     * Remove evaluadorPremioCriterio
     *
     * @param \AppBundle\Entity\EvaluadorCriterioPremio $evaluadorPremioCriterio
     */
    public function removeEvaluadorPremioCriterio(\AppBundle\Entity\EvaluadorCriterioPremio $evaluadorPremioCriterio)
    {
        $this->evaluadorPremioCriterios->removeElement($evaluadorPremioCriterio);
    }

    /**
     * Get evaluadorPremioCriterios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluadorPremioCriterios()
    {
        return $this->evaluadorPremioCriterios;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return CriterioPremio
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }
}
