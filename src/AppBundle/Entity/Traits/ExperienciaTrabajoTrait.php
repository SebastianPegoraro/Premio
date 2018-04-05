<?php

namespace AppBundle\Entity\Traits;

trait ExperienciaTrabajoTrait {
    /**
     * @var \AppBundle\Entity\Embeddable\ExperienciaTrabajo
     *
     * @ORM\Embedded(class = "\AppBundle\Entity\Embeddable\ExperienciaTrabajo", columnPrefix = false)
     * @Assert\Valid()
     */
    private $experienciaTrabajo;

    /**
     * Get experienciaTrabajo
     *
     * @return \AppBundle\Entity\Embeddable\ExperienciaTrabajo
     */
    public function getExperienciaTrabajo()
    {
        return $this->experienciaTrabajo;
    }

    /**
     * Set experienciaTrabajo
     * 
     * @param \AppBundle\Entity\Embeddable\ExperienciaTrabajo
     */
    public function setExperienciaTrabajo(\AppBundle\Entity\Embeddable\ExperienciaTrabajo $experienciaTrabajo)
    {
        $this->experienciaTrabajo = $experienciaTrabajo;

        return $this;
    }
}