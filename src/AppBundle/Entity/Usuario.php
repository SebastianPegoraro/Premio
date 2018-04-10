<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Usuario extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Evaluador
     *
     * @ORM\OneToOne(targetEntity="Evaluador", mappedBy="usuario")
     */
    private $evaluador;

    /**
     * @var Evaluador
     *
     * @ORM\OneToOne(targetEntity="Organizacion", mappedBy="usuario")
     */
    private $organizacion;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set evaluador
     *
     * @param \AppBundle\Entity\Evaluador $evaluador
     *
     * @return Usuario
     */
    public function setEvaluador(\AppBundle\Entity\Evaluador $evaluador = null)
    {
        $evaluador->setUsuario($this);

        $this->evaluador = $evaluador;

        return $this;
    }

    /**
     * Get evaluador
     *
     * @return \AppBundle\Entity\Evaluador
     */
    public function getEvaluador()
    {
        return $this->evaluador;
    }

    /**
     * Set organizacion
     *
     * @param \AppBundle\Entity\Organizacion $organizacion
     *
     * @return Usuario
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
