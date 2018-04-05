<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluadorConSeCurDict
 *
 * @ORM\Table(name="evaluador_con_se_cur_dict")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorConSeCurDictRepository")
 */
class EvaluadorConSeCurDict
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
     * @ORM\Column(name="tema", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $tema;

    /**
     * @var int
     *
     * @ORM\Column(name="horas", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min=1)
     */
    private $horas;

    /**
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="conSeCurDicts")
     * @ORM\JoinColumn(name="evaluador_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotNull()
     */
    private $evaluador;

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
     * Set tema
     *
     * @param string $tema
     *
     * @return EvaluadorConSeCurDict
     */
    public function setTema($tema)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return string
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set horas
     *
     * @param integer $horas
     *
     * @return EvaluadorConSeCurDict
     */
    public function setHoras($horas)
    {
        $this->horas = $horas;

        return $this;
    }

    /**
     * Get horas
     *
     * @return int
     */
    public function getHoras()
    {
        return $this->horas;
    }

    /**
     * Set evaluador
     *
     * @param \AppBundle\Entity\Evaluador $evaluador
     *
     * @return EvaluadorConSeCurDict
     */
    public function setEvaluador(\AppBundle\Entity\Evaluador $evaluador)
    {
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
}
