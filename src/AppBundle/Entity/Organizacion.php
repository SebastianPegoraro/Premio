<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use AppBundle\Entity\Traits\BlameableTrait;
use AppBundle\Utils\Utils;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganizacionRepository")
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminador", type="string")
 * @ORM\DiscriminatorMap({"organizacion_publica" = "OrganizacionPublica", "organizacion_privada" = "OrganizacionPrivada"})
 */
abstract class Organizacion
{
    use TimestampableEntity;
    use BlameableTrait;

    const ESTADO_INICIAL = 'inicial';
    const ESTADO_ACTIVO = 'activo';
    const ESTADO_BAJA = 'baja';
    const ESTADO_ACEPTADO = 'aceptado';
    const ESTADO_NO_ACEPTADO = 'no aceptado';

    const TYPE_PUBLICA = 'organizacion_publica';
    const TYPE_PRIVADA = 'organizacion_privada';

    public static $estados = array(
        self::ESTADO_INICIAL     => self::ESTADO_INICIAL,
        self::ESTADO_ACTIVO      => self::ESTADO_ACTIVO,
        self::ESTADO_BAJA        => self::ESTADO_BAJA,
        self::ESTADO_ACEPTADO    => self::ESTADO_ACEPTADO,
        self::ESTADO_NO_ACEPTADO => self::ESTADO_NO_ACEPTADO,
    );

    public static $estadosSiguientes = array(
        self::ESTADO_INICIAL => array(self::ESTADO_INICIAL, self::ESTADO_ACEPTADO, self::ESTADO_NO_ACEPTADO),
        self::ESTADO_ACEPTADO  => array(self::ESTADO_ACEPTADO, self::ESTADO_ACTIVO),
        self::ESTADO_NO_ACEPTADO  => array(self::ESTADO_NO_ACEPTADO),
        self::ESTADO_ACTIVO  => array(self::ESTADO_ACTIVO, self::ESTADO_BAJA),
        self::ESTADO_BAJA    => array(self::ESTADO_BAJA),
    );

	/**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $nombre;

    /**
     * @var ArrayCollection
     * Localizaciones
     * One-To-Many, Unidirectional with Join Table
     *
     * @ORM\ManyToMany(targetEntity="Localizacion", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinTable(
     *     name="organizacion_localizacion",
     *     joinColumns={@ORM\JoinColumn(name="organizacion_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="localizacion_id", referencedColumnName="id", unique=true, onDelete="CASCADE")}
     * )
     * @Assert\Valid()
     */
    protected $localizaciones;

    /**
     * @var \AppBundle\Entity\Embeddable\Contacto;
     *
     * @ORM\Embedded(class="\AppBundle\Entity\Embeddable\Contacto")
     * @Assert\Valid()
     */
     protected $contactoOrganizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_organizacion_apellido", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $responsableOrganizacionApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_organizacion_nombre", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $responsableOrganizacionNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_organizacion_funcion", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $responsableOrganizacionFuncion;

    /**
     * @var \AppBundle\Entity\Embeddable\Contacto;
     *
     * @ORM\Embedded(class="\AppBundle\Entity\Embeddable\Contacto")
     * @Assert\Valid()
     */
    protected $responsableOrganizacionContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="actividad_principal", type="text")
     *
     * @Assert\NotBlank()
     */
    protected $actividadPrincipal;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="OrganizacionCliente", mappedBy="organizacion", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     */
    protected $clientes;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="OrganizacionProveedor", mappedBy="organizacion", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     */
    protected $proveedores;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio_inicio_actividades", type="integer", nullable=true)
     * @Assert\Type("integer")
     * @Assert\Range(min=1900)
     */
    protected $anioInicioActividades;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="OrganizacionPremio", mappedBy="organizacion")
     */
    protected $organizacionPremios;

    /**
     * @var Usuario
     *
     * @ORM\OneToOne(targetEntity="Usuario", inversedBy="organizacion", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $usuario;

    public function __construct()
    {

    	$this->contactoOrganizacion = new \AppBundle\Entity\Embeddable\Contacto();
        $this->responsableOrganizacionContacto = new \AppBundle\Entity\Embeddable\Contacto();

        $this->localizaciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clientes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->proveedores = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Organizacion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get contactoOrganizacion
     *
     * @return \AppBundle\Entity\Embeddable\Contacto;
     */
    public function getContactoOrganizacion()
    {
        return $this->contactoOrganizacion;
    }

    /**
     * Set contactoOrganizacion
     *
     * @var \AppBundle\Entity\Embeddable\Contacto
     *
     * @return Organizacion;
     */
    public function setContactoOrganizacion(\AppBundle\Entity\Embeddable\Contacto $contactoOrganizacion)
    {
        $this->contactoOrganizacion = $contactoOrganizacion;
        return $this;
    }

    /**
     * Set responsableOrganizacionApellido
     *
     * @param string $responsableOrganizacionApellido
     *
     * @return Organizacion
     */
    public function setResponsableOrganizacionApellido($responsableOrganizacionApellido)
    {
        $this->responsableOrganizacionApellido = $responsableOrganizacionApellido;

        return $this;
    }

    /**
     * Get responsableOrganizacionApellido
     *
     * @return string
     */
    public function getResponsableOrganizacionApellido()
    {
        return $this->responsableOrganizacionApellido;
    }

    /**
     * Set responsableOrganizacionNombre
     *
     * @param string $responsableOrganizacionNombre
     *
     * @return Organizacion
     */
    public function setResponsableOrganizacionNombre($responsableOrganizacionNombre)
    {
        $this->responsableOrganizacionNombre = $responsableOrganizacionNombre;

        return $this;
    }

    /**
     * Get responsableOrganizacionNombre
     *
     * @return string
     */
    public function getResponsableOrganizacionNombre()
    {
        return $this->responsableOrganizacionNombre;
    }

    /**
     * Set responsableOrganizacionFuncion
     *
     * @param string $responsableOrganizacionFuncion
     *
     * @return Organizacion
     */
    public function setResponsableOrganizacionFuncion($responsableOrganizacionFuncion)
    {
        $this->responsableOrganizacionFuncion = $responsableOrganizacionFuncion;

        return $this;
    }

    /**
     * Get responsableOrganizacionFuncion
     *
     * @return string
     */
    public function getResponsableOrganizacionFuncion()
    {
        return $this->responsableOrganizacionFuncion;
    }

    /**
     * Get responsableOrganizacionContacto
     *
     * @return \AppBundle\Entity\Embeddable\Contacto
     */
    public function getResponsableOrganizacionContacto()
    {
        return $this->responsableOrganizacionContacto;
    }

    /**
     * Set responsableOrganizacionContacto
     *
     * @param \AppBundle\Entity\Embeddable\Contacto $responsableOrganizacionContacto
     *
     * @return Organizacion
     */
    public function setResponsableOrganizacionContacto(\AppBundle\Entity\Embeddable\Contacto $responsableOrganizacionContacto)
    {
        $this->responsableOrganizacionContacto = $responsableOrganizacionContacto;
        return $this;
    }

    /**
     * Set actividadPrincipal
     *
     * @param string $actividadPrincipal
     *
     * @return Organizacion
     */
    public function setActividadPrincipal($actividadPrincipal)
    {
        $this->actividadPrincipal = $actividadPrincipal;

        return $this;
    }

    /**
     * Get actividadPrincipal
     *
     * @return string
     */
    public function getActividadPrincipal()
    {
        return $this->actividadPrincipal;
    }

    /**
     * Set anioInicioActividades
     *
     * @param integer $anioInicioActividades
     *
     * @return Organizacion
     */
    public function setAnioInicioActividades($anioInicioActividades)
    {
        $this->anioInicioActividades = $anioInicioActividades;

        return $this;
    }

    /**
     * Get anioInicioActividades
     *
     * @return integer
     */
    public function getAnioInicioActividades()
    {
        return $this->anioInicioActividades;
    }

    /**
     * Add localizacione
     *
     * @param \AppBundle\Entity\Localizacion $localizacione
     *
     * @return Organizacion
     */
    public function addLocalizacione(\AppBundle\Entity\Localizacion $localizacione)
    {
        $this->localizaciones[] = $localizacione;

        return $this;
    }

    /**
     * Remove localizacione
     *
     * @param \AppBundle\Entity\Localizacion $localizacione
     */
    public function removeLocalizacione(\AppBundle\Entity\Localizacion $localizacione)
    {
        $this->localizaciones->removeElement($localizacione);
    }

    /**
     * Get localizaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocalizaciones()
    {
        return $this->localizaciones;
    }

    /**
     * Add cliente
     *
     * @param \AppBundle\Entity\OrganizacionCliente $cliente
     *
     * @return Organizacion
     */
    public function addCliente(\AppBundle\Entity\OrganizacionCliente $cliente)
    {
        $cliente->setOrganizacion($this);

        $this->clientes[] = $cliente;

        return $this;
    }

    /**
     * Remove cliente
     *
     * @param \AppBundle\Entity\OrganizacionCliente $cliente
     */
    public function removeCliente(\AppBundle\Entity\OrganizacionCliente $cliente)
    {
        $this->clientes->removeElement($cliente);
    }

    /**
     * Get clientes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClientes()
    {
        return $this->clientes;
    }

    /**
     * Add proveedore
     *
     * @param \AppBundle\Entity\OrganizacionProveedor $proveedore
     *
     * @return Organizacion
     */
    public function addProveedore(\AppBundle\Entity\OrganizacionProveedor $proveedore)
    {
        $proveedore->setOrganizacion($this);

        $this->proveedores[] = $proveedore;

        return $this;
    }

    /**
     * Remove proveedore
     *
     * @param \AppBundle\Entity\OrganizacionProveedor $proveedore
     */
    public function removeProveedore(\AppBundle\Entity\OrganizacionProveedor $proveedore)
    {
        $this->proveedores->removeElement($proveedore);
    }

    /**
     * Get proveedores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProveedores()
    {
        return $this->proveedores;
    }


    /**
     * Set premio
     *
     * @param \AppBundle\Entity\Premio $premio
     *
     * @return Organizacion
     */
    public function setPremio(\AppBundle\Entity\Premio $premio)
    {
        $this->premio = $premio;

        return $this;
    }

    /**
     * Get premio
     *
     * @return \AppBundle\Entity\Premio
     */
    public function getPremio()
    {
        return $this->premio;
    }

    public function __toString()
    {
        return $this->nombre . ' (' . $this->premio . ')';
    }

    public function getTipoOrganizacion()
    {
        if ($this->getType() == self::TYPE_PUBLICA) {
            return 'Pública';
        } else {
            return 'Privada';
        }
    }

    /**
     * @Assert\Callback
     */
    public function validateLocalizaciones(ExecutionContextInterface $context)
    {
        if ($this->getLocalizaciones()->count() > 0) {
            foreach ($this->localizaciones as $k => $l) {
                if (!$l->getDireccion()) {
                    $context->buildViolation('Este valor no debería estar vacío.')
                     ->atPath('localizaciones[' . $k . '].direccion')
                     ->addViolation();
                }

                if (!$l->getLocalidad()) {
                    $context->buildViolation('Este valor no debería ser nulo.')
                     ->atPath('localizaciones[' . $k . '].localidad')
                     ->addViolation();
                }
            }
        }
    }

    /**
     * @Assert\Callback
     */
    public function validateContactoOrganizacion(ExecutionContextInterface $context)
    {
        if (!$this->getContactoOrganizacion()->getTelefono()) {
            $context->buildViolation('Este valor no debería estar vacío.')
                ->atPath('contactoOrganizacion.telefono')
                ->addViolation();
        }

        // if (!$this->getContactoOrganizacion()->getEmail()) {
        //     $context->buildViolation('Este valor no debería estar vacío.')
        //         ->atPath('contactoOrganizacion.email')
        //         ->addViolation();
        // }
    }

    /**
     * @Assert\Callback
     */
    public function validateResponsableOrganizacionContacto(ExecutionContextInterface $context)
    {
        // if (!$this->getResponsableOrganizacionContacto()->getEmail()) {
        //     $context->buildViolation('Este valor no debería estar vacío.')
        //         ->atPath('responsableOrganizacionContacto.email')
        //         ->addViolation();
        // }
    }

    /**
     * @Assert\Callback
     */
    public function validateClientes(ExecutionContextInterface $context)
    {
        if (!$this->id) {
            if (Utils::hasArrayCollectionDuplicates($this->clientes, 'nombre')) {
                $context->buildViolation('Ud. agregó dos clientes con el mismo nombre.')
                ->atPath('clientes')
                ->addViolation();
            }
        }
    }

    /**
     * @Assert\Callback
     */
    public function validateProveedores(ExecutionContextInterface $context)
    {
        if (!$this->id) {
            if (Utils::hasArrayCollectionDuplicates($this->proveedores, 'nombre')) {
                $context->buildViolation('Ud. agregó dos proveedores con el mismo nombre.')
                ->atPath('proveedores')
                ->addViolation();
            }
        }
    }

    /**
     * Set equipo
     *
     * @param \AppBundle\Entity\EquipoEvaluador $equipo
     *
     * @return Organizacion
     */
    public function setEquipo(\AppBundle\Entity\EquipoEvaluador $equipo = null)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * Get equipo
     *
     * @return \AppBundle\Entity\EquipoEvaluador
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Organizacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    public function getType() {
        if ($this instanceof OrganizacionPublica) {
            return self::TYPE_PUBLICA;
        } else {
            return self::TYPE_PRIVADA;
        }
    }
}
