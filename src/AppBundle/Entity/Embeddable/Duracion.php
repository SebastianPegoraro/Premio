<?php

namespace AppBundle\Entity\Embeddable;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/** @ORM\Embeddable */
class Duracion {
	
    /**
     * @ORM\Column(name="meses", type="integer", nullable=true)
     * 
     * @Assert\Type("integer")
     * @Assert\Range(min = 1, max=11)
     */
    private $meses;

    /**
     * @ORM\Column(name="anios", type="integer", nullable=true)
     *
     * @Assert\Type("integer")
     * @Assert\Range(min = 1)
     */
    private $anios;

    /**
     * Get meses.
     * 
     * @return int 
     */
    public function getMeses()
    {
        return $this->meses;
    }

    /**
     * Set meses.
     *
     * @param int $meses Meses
     *
     * @return Duracion
     */
    public function setMeses($meses)
    {
        $this->meses = $meses;

        return $this;
    }

    /**
     * Get anios
     * 
     * @return int
     */
    public function getAnios()
    {
        return $this->anios;
    }

    /**
     * Set anios
     * 
     * @param int $anios Años
     *
     * @return Duracion
     */
    public function setAnios($anios)
    {
        $this->anios = $anios;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function validateMesesYAnios(ExecutionContextInterface $context)
    {
        if (!$this->meses && !$this->anios) {
            $context->buildViolation('Debe ingresar un valor en el campo Años o en el campo Meses.')
                    ->atPath('anios')
                    ->addViolation();
        }
    }
}