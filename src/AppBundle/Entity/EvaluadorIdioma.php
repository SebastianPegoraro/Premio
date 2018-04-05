<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluadorIdioma
 *
 * @ORM\Table(name="evaluador_idioma")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorIdiomaRepository")
 */
class EvaluadorIdioma
{
    const IDIOMA_CALIFICACION_REGULAR = 'REGULAR';
    const IDIOMA_CALIFICACION_BUENO = 'BUENO';
    const IDIOMA_CALIFICACION_MUY_BUENO = 'MUY BUENO';

    public static $idomaCalificacionOptions = array(
        'Regular' => self::IDIOMA_CALIFICACION_REGULAR,
        'Bueno' => self::IDIOMA_CALIFICACION_BUENO,
        'Muy Bueno' => self::IDIOMA_CALIFICACION_MUY_BUENO,
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
     * @var Idioma
     * 
     * @ORM\ManyToOne(targetEntity="Idioma", inversedBy="evaluadorIdiomas")
     * @ORM\JoinColumn(name="idioma_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $idioma;

    /**
     * @var string
     *
     * @ORM\Column(name="lee", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $lee;

    /**
     * @var string
     *
     * @ORM\Column(name="habla", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $habla;

    /**
     * @var string
     *
     * @ORM\Column(name="escribe", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $escribe;

    /**
     * @var Evaluador
     *
     * @ORM\ManyToOne(targetEntity="Evaluador", inversedBy="idiomas")
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
     * Set lee
     *
     * @param string $lee
     *
     * @return EvaluadorIdioma
     */
    public function setLee($lee)
    {
        $this->lee = $lee;

        return $this;
    }

    /**
     * Get lee
     *
     * @return string
     */
    public function getLee()
    {
        return $this->lee;
    }

    /**
     * Set habla
     *
     * @param string $habla
     *
     * @return EvaluadorIdioma
     */
    public function setHabla($habla)
    {
        $this->habla = $habla;

        return $this;
    }

    /**
     * Get habla
     *
     * @return string
     */
    public function getHabla()
    {
        return $this->habla;
    }

    /**
     * Set escribe
     *
     * @param string $escribe
     *
     * @return EvaluadorIdioma
     */
    public function setEscribe($escribe)
    {
        $this->escribe = $escribe;

        return $this;
    }

    /**
     * Get escribe
     *
     * @return string
     */
    public function getEscribe()
    {
        return $this->escribe;
    }

    /**
     * Set idioma
     *
     * @param \AppBundle\Entity\Idioma $idioma
     *
     * @return EvaluadorIdioma
     */
    public function setIdioma(\AppBundle\Entity\Idioma $idioma = null)
    {
        $this->idioma = $idioma;

        return $this;
    }

    /**
     * Get idioma
     *
     * @return \AppBundle\Entity\Idioma
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set evaluador
     *
     * @param \AppBundle\Entity\Evaluador $evaluador
     *
     * @return EvaluadorIdioma
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
