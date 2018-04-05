<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Validator\Constraints as PremioCalidadAssert;

/**
 * OrganizacionPrivada
 *
 * @ORM\Table(name="organizacion_privada")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganizacionPrivadaRepository")
 *
 * @UniqueEntity(
 *     fields={"premio", "cuit"},
 *     message="Ya se encuentra inscripto en el premio actual (el cuit ya esta registrado para el premio actual)."
 * )
 */
class OrganizacionPrivada extends Organizacion
{
    const TIPO_PRODUCTOR_BIENES = 'bienes';
    const TIPO_PRODUCTOR_SERVICIOS = 'servicios';

    public static $tipoOptions = array(
        'Productores de Bienes'    => self::TIPO_PRODUCTOR_BIENES,
        'Prestadores de Servicios' => self::TIPO_PRODUCTOR_SERVICIOS,
    );

    /**
     * @var string
     *
     * @ORM\Column(name="cuit", type="string", length=11)
     * @Assert\NotBlank()
     * @PremioCalidadAssert\Cuit
     */
    private $cuit;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=10)
     * @Assert\NotBlank()
     */
    private $tipo;

    /**
     * @var CategoriaPrivada
     *
     * @ORM\ManyToOne(targetEntity="CategoriaPrivada", inversedBy="privadaOrganizaciones")
     * @ORM\JoinColumn(name="categoria_privada_id", referencedColumnName="id", onDelete="RESTRICT", nullable=false)
     * 
     * @Assert\NotNull()
     */
    private $categoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_trabajadores_propios", type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min=1)
     */
    private $cantTrabajadoresPropios;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set cuit
     *
     * @param string $cuit
     *
     * @return OrganizacionPrivada
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;

        return $this;
    }

    /**
     * Get cuit
     *
     * @return string
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return OrganizacionPrivada
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set cantTrabajadoresPropios
     *
     * @param integer $cantTrabajadoresPropios
     *
     * @return OrganizacionPrivada
     */
    public function setCantTrabajadoresPropios($cantTrabajadoresPropios)
    {
        $this->cantTrabajadoresPropios = $cantTrabajadoresPropios;

        return $this;
    }

    /**
     * Get cantTrabajadoresPropios
     *
     * @return integer
     */
    public function getCantTrabajadoresPropios()
    {
        return $this->cantTrabajadoresPropios;
    }

    /**
     * Set categoria
     *
     * @param \AppBundle\Entity\CategoriaPrivada $categoria
     *
     * @return OrganizacionPrivada
     */
    public function setCategoria(\AppBundle\Entity\CategoriaPrivada $categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\CategoriaPrivada
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @Assert\Callback
     */
    public function validateAnioInicioActividades(ExecutionContextInterface $context)
    {
        if (!$this->getAnioInicioActividades()) {
            $context->buildViolation('Este valor no debería estar vacío.')
                ->atPath('anioInicioActividades')
                ->addViolation();
        }
    }

    /**
     * @Assert\Callback
     */
    public function validateCantidadClientes(ExecutionContextInterface $context)
    {
        if ($this->getClientes()->count() == 0) {
            $context->buildViolation('Debe ingresar al menos 1 cliente.')
                ->atPath('clientes')
                ->addViolation();
        }
    }

    /**
     * @Assert\Callback
     */
    public function validateCantidadProveedores(ExecutionContextInterface $context)
    {
        if ($this->getProveedores()->count() == 0) {
            $context->buildViolation('Debe ingresar al menos 1 proveedor.')
                ->atPath('proveedores')
                ->addViolation();
        }
    }

    public function getTipoStr()
    {
        return array_search($this->getTipo(), self::$tipoOptions);        
    }

}
