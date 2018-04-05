<?php

namespace AppBundle\Entity\Traits;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Usuario;

trait BlameableTrait {

    /**
     * @var Usuario
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @var Usuario
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $updatedBy;

    /**
     * Get createdBy
     *
     * @return Usuario
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdBy
     *
     * @param Usuario $createdBy
     *
     * @return $this
     */
    public function setCreatedBy(Usuario $createdBy = null)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return Usuario
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set updatedBy
     *
     * @param Usuario $updatedBy
     *
     * @return $this
     */
    public function setUpdatedBy(Usuario $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
}