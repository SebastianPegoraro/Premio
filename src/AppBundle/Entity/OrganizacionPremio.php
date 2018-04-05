<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrganizacionPremio
 *
 * @ORM\Table(name="organizacion_premio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganizacionPremioRepository")
 */
class OrganizacionPremio
{
  const ESTADO_INICIAL = 'inicial';
  const ESTADO_ACTIVO = 'activo';
  const ESTADO_BAJA = 'baja';
  const ESTADO_ACEPTADO = 'aceptado';
  const ESTADO_NO_ACEPTADO = 'no aceptado';

  public static $estados = array(
      self::ESTADO_INICIAL     => self::ESTADO_INICIAL,
      self::ESTADO_ACTIVO      => self::ESTADO_ACTIVO,
      self::ESTADO_BAJA        => self::ESTADO_BAJA,
      self::ESTADO_ACEPTADO    => self::ESTADO_ACEPTADO,
      self::ESTADO_NO_ACEPTADO => self::ESTADO_NO_ACEPTADO,
  );

  public static $estadosSiguientes = array(
      self::ESTADO_INICIAL => array(self::ESTADO_INICIAL, self::ESTADO_ACEPTADO, self::ESTADO_NO_ACEPTADO),
      self::ESTADO_ACEPTADO  => array(self::ESTADO_ACEPTADO, self::ESTADO_ACTIVO),
      self::ESTADO_NO_ACEPTADO  => array(self::ESTADO_NO_ACEPTADO),
      self::ESTADO_ACTIVO  => array(self::ESTADO_ACTIVO, self::ESTADO_BAJA),
      self::ESTADO_BAJA    => array(self::ESTADO_BAJA),
  );

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Premio
     *
     * @ORM\ManyToOne(targetEntity="Premio", inversedBy="organizacionPremios")
     * @ORM\JoinColumn(name="premio_id", referencedColumnName="id")
     */
    private $premio;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Organizacion", inversedBy="organizacionPremios")
     * @ORM\JoinColumn(name="organizacion_id", referencedColumnName="id")
     */
    private $organizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=20)
     */
    protected $estado;

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
     * Set estado
     *
     * @param string $estado
     *
     * @return OrganizacionPremio
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set premio
     *
     * @param \AppBundle\Entity\Premio $premio
     *
     * @return OrganizacionPremio
     */
    public function setPremio(\AppBundle\Entity\Premio $premio = null)
    {
        $this->premio = $premio;

        return $this;
    }

    /**
     * Get premio
     *
     * @return \AppBundle\Entity\Premio
     */
    public function getPremio()
    {
        return $this->premio;
    }

    /**
     * Set organizacion
     *
     * @param \AppBundle\Entity\Organizacion $organizacion
     *
     * @return OrganizacionPremio
     */
    public function setOrganizacion(\AppBundle\Entity\Organizacion $organizacion = null)
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