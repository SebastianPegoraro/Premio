<?php

namespace AppBundle\Entity\Embeddable;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** @ORM\Embeddable */
class ExperienciaTrabajo {
	use \AppBundle\Entity\Traits\DuracionTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_entidad", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nombreEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_desempenado", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $cargoDesempenado;

    public function getNombreEntidad()
    {
        return $this->nombreEntidad;
    }
     
     
    public function setNombreEntidad($nombreEntidad)
    {
        $this->nombreEntidad = $nombreEntidad;
        return $this;
    }

    public function getCargoDesempenado()
    {
        return $this->cargoDesempenado;
    }
     
     
    public function setCargoDesempenado($cargoDesempenado)
    {
        $this->cargoDesempenado = $cargoDesempenado;
        return $this;
    }
}