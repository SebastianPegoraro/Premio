<?php

namespace AppBundle\Entity\Embeddable;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/** @ORM\Embeddable */
class Contacto {

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     * @Assert\Regex("/\d+/")
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private $web;

    /**
     * Get telófono
     *
     * @return string
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * set telefono
     *
     * @param string telefono
     *
     * @return EmbeddableContacto
     */
    public function setTelefono($telefono) {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * set email
     *
     * @param string email
     *
     * @return EmbeddableContacto
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get web
     *
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }
     
    /**
     * set web
     *
     * @param string web
     *
     * @return EmbeddableContacto
     */ 
    public function setWeb($web)
    {
        $this->web = $web;
        return $this;
    }
}
