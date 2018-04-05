<?php

namespace AppBundle\Entity\Traits;

trait DuracionTrait {
    /**
     * @var Duracion
     *
     * @ORM\Embedded(class = "\AppBundle\Entity\Embeddable\Duracion")
     * @Assert\Valid()
     */
    private $duracion;

    /**
     * Get duracion
     *
     * @return \AppBundle\Entity\Embeddable\Duracion
     */
    public function getDuracion() {
        return $this->duracion;
    }

    /**
     * Set duracion
     *
     * @param \AppBundle\Entity\Embeddable\Duracion $duracion Duración.
     */
    public function setDuracion(\AppBundle\Entity\Embeddable\Duracion $duracion) {
        $this->duracion = $duracion;

        return $this;
    }
}