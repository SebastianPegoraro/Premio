<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use AppBundle\Entity\Traits\BlameableTrait;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Evaluador
 *
 * @ORM\Table(name="evaluador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvaluadorRepository")
 * @UniqueEntity(
 *     fields={"dni"},
 *     errorPath="",
 *     message="El dni ingresado ya existe en la base de datos. Ud. ya debería tener un usuario. Ingrese a la aplicación si desea modificar sus datos o bien para inscribirse al premio actual."
 * )
 * @UniqueEntity(
 *     fields={"contactoParticular.email"}
 * )
 * @Vich\Uploadable
 */
class Evaluador
{
    use TimestampableEntity;
    use BlameableTrait;

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
     * @ORM\Column(name="apellido", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="dni", type="integer", unique=true)
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @Assert\Range(min="5000000")
     */
    private $dni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date")
     * @Assert\NotBlank()
     */
    private $fechaNacimiento;

    /**
     * @var Localidad
     *
     * @ORM\ManyToOne(targetEntity="Localidad")
     * @ORM\JoinColumn(name="localidad_id", referencedColumnName="id", nullable=true)
     */
    private $lugarNacimiento;

    /**
     * Localizacion Particular
     * (ojo!!!) One-To-Many, Unidirectional with Join Table
     *
     * @ORM\ManyToMany(targetEntity="Localizacion", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinTable(
     *     name="evaluador_localizacion_particular",
     *     joinColumns={@ORM\JoinColumn(name="evaluador_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="localizacion_id", referencedColumnName="id", unique=true, onDelete="CASCADE")}
     * )
     * @Assert\Valid()
     */
    private $particularLocalizaciones;

    /**
     * @var \AppBundle\Entity\Embeddable\Contacto;
     *
     * @ORM\Embedded(class="\AppBundle\Entity\Embeddable\Contacto")
     * @Assert\Valid()
     */
     private $contactoParticular;

    /**
     * Localizacion Laboral
     * One-To-Many, Unidirectional with Join Table
     *
     * @ORM\ManyToMany(targetEntity="Localizacion", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinTable(
     *     name="evaluador_localizacion_laboral",
     *     joinColumns={@ORM\JoinColumn(name="evaluador_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="localizacion_id", referencedColumnName="id", unique=true, onDelete="CASCADE")}
     * )
     * @Assert\Valid()
     */
    private $laboralLocalizaciones;

    /**
     * @var \AppBundle\Entity\Embeddable\Contacto;
     *
     * @ORM\Embedded(class="\AppBundle\Entity\Embeddable\Contacto")
     * @Assert\Valid()
     */
    private $contactoLaboral;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EvaluadorEstudioUniversitario", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     * @Assert\Count(min = "1")
     */
    private $estudiosUniversitarios;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EvaluadorEstudioPosgrado", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     */
    private $estudiosPosgrados;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EvaluadorCurso", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     */
    private $cursos;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="cursa_carrera_actualmente", type="boolean") 
     */
    private $cursaCarreraActualmente;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="carrera_que_cursa_actualmente", type="string", nullable=true) 
     */
    private $carreraQueCursaActualmente;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EvaluadorIdioma", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     */
    private $idiomas;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EvaluadorConSeCurDict", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     */
    private $conSeCurDicts;

    /**
     * @var string
     *
     * @ORM\Column(name="publicaciones_y_trabajos", type="text", nullable=true)
     */
    private $publicacionesYTrabajos;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorTrabajoActual", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid() 
     */
    private $actualTrabajos;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorTrabajoEstatal", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid() 
     */
    private $estatalTrabajos;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorTrabajoDocente", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid() 
     */
    private $docenteTrabajos;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorTrabajoOng", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid() 
     */
    private $ongTrabajos;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorTrabajoEmpPrivada", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid() 
     */
    private $empPrivadaTrabajos;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorTrabajoIndependiente", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid() 
     */
    private $independienteTrabajos;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorCriterioPremio", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid() 
     */
    private $premioCriterios;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="EvaluadorExpGestionCalidad", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid() 
     */
    private $gestionCalidadExperiencias;

    /**
     * @var string
     *
     * @ORM\Column(name="impl_sistemas_gestion_calidad", type="text", nullable=true)
     */
    private $implSistemasGestionCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="experiencia_como_evaluador", type="text", nullable=true)
     */
    private $experienciaComoEvaluador;

    /**
     * @var string
     *
     * @ORM\Column(name="auditorias_o_evaluaciones_realizadas", type="text", nullable=true)
     */
    private $auditoriasOEvaluacionesRealizadas;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="EvaluadorPremio", mappedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\Valid()
     */
    private $evaluadorPremios;

    /**
     * @var Usuario
     *
     * @ORM\OneToOne(targetEntity="Usuario", inversedBy="evaluador", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $usuario;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="evaluador_image", fileNameProperty="imageName")
     * 
     * @var File
     *
     * @Assert\Image()
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $imageUpdatedAt;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Evaluador
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->imageUpdatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Evaluador
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }




    public function __construct()
    {
        $this->particularLocalizaciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contactoParticular = new \AppBundle\Entity\Embeddable\Contacto();

        $this->laboralLocalizaciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contactoLaboral = new \AppBundle\Entity\Embeddable\Contacto();

        $this->estudiosUniversitarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estudiosPosgrados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cursos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idiomas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->conSeCurDicts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actualTrabajos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->docenteTrabajos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estatalTrabajos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ongTrabajos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->empPrivadaTrabajos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->independienteTrabajos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->premioCriterios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gestionCalidadExperiencias = new \Doctrine\Common\Collections\ArrayCollection();

        $this->cursaCarreraActualmente = false;

        $this->evaluadorPremios = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Evaluador
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Evaluador
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
     * Set dni
     *
     * @param integer $dni
     *
     * @return Evaluador
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return int
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Evaluador
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set lugarNacimiento
     *
     * @param \AppBundle\Entity\Localidad $lugarNacimiento
     *
     * @return Evaluador
     */
    public function setLugarNacimiento(\AppBundle\Entity\Localidad $lugarNacimiento = null)
    {
        $this->lugarNacimiento = $lugarNacimiento;

        return $this;
    }

    /**
     * Get lugarNacimiento
     *
     * @return \AppBundle\Entity\Localidad
     */
    public function getLugarNacimiento()
    {
        return $this->lugarNacimiento;
    }

    /**
     * Add particularLocalizacione
     *
     * @param \AppBundle\Entity\Localizacion $particularLocalizacione
     *
     * @return Evaluador
     */
    public function addParticularLocalizacione(\AppBundle\Entity\Localizacion $particularLocalizacione)
    {
        $this->particularLocalizaciones[] = $particularLocalizacione;

        return $this;
    }

    /**
     * Remove particularLocalizacione
     *
     * @param \AppBundle\Entity\Localizacion $particularLocalizacione
     */
    public function removeParticularLocalizacione(\AppBundle\Entity\Localizacion $particularLocalizacione)
    {
        $this->particularLocalizaciones->removeElement($particularLocalizacione);
    }

    /**
     * Get particularLocalizaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticularLocalizaciones()
    {
        return $this->particularLocalizaciones;
    }

    /**
    * get contactoParticular
    *
    * @return \AppBundle\Entity\Embeddable\Contacto
    */
    public function getContactoParticular()
    {
        return $this->contactoParticular;
    }

    /**
    * set contactoParticular
    *
    * @return Evaluador
    */
    public function setContactoParticular(\AppBundle\Entity\Embeddable\Contacto $contactoParticular)
    {
        $this->contactoParticular = $contactoParticular;

        return $this;
    }

    /**
     * Add laboralLocalizacione
     *
     * @param \AppBundle\Entity\Localizacion $laboralLocalizacione
     *
     * @return Evaluador
     */
    public function addLaboralLocalizacione(\AppBundle\Entity\Localizacion $laboralLocalizacione)
    {
        $this->laboralLocalizaciones[] = $laboralLocalizacione;

        return $this;
    }

    /**
     * Remove laboralLocalizacione
     *
     * @param \AppBundle\Entity\Localizacion $laboralLocalizacione
     */
    public function removeLaboralLocalizacione(\AppBundle\Entity\Localizacion $laboralLocalizacione)
    {
        $this->laboralLocalizaciones->removeElement($laboralLocalizacione);
    }

    /**
     * Get laboralLocalizaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLaboralLocalizaciones()
    {
        return $this->laboralLocalizaciones;
    }

    /**
     * get contactoLaboral
     *
     * @return \AppBundle\Entity\Embeddable\Contacto
     */
    public function getContactoLaboral()
    {
       return $this->contactoLaboral;
    }

    /**
     * set contactoLaboral
     *
     * @return Evaluador
     */
    public function setContactoLaboral(\AppBundle\Entity\Embeddable\Contacto $contactoLaboral)
    {
       $this->contactoLaboral = $contactoLaboral;
       return $this;
    }

    /**
     * Add estudiosUniversitario
     *
     * @param \AppBundle\Entity\EvaluadorEstudioUniversitario $estudiosUniversitario
     *
     * @return Evaluador
     */
    public function addEstudiosUniversitario(\AppBundle\Entity\EvaluadorEstudioUniversitario $estudioUniversitario)
    {
        $estudioUniversitario->setEvaluador($this);

        $this->estudiosUniversitarios[] = $estudioUniversitario;

        return $this;
    }

    /**
     * Remove estudiosUniversitario
     *
     * @param \AppBundle\Entity\EvaluadorEstudioUniversitario $estudiosUniversitario
     */
    public function removeEstudiosUniversitario(\AppBundle\Entity\EvaluadorEstudioUniversitario $estudioUniversitario)
    {
        $this->estudiosUniversitarios->removeElement($estudioUniversitario);
    }

    /**
     * Get estudiosUniversitarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstudiosUniversitarios()
    {
        return $this->estudiosUniversitarios;
    }

    /**
     * Add estudiosPosgrado
     *
     * @param \AppBundle\Entity\EvaluadorEstudioPosgrado $estudioPosgrado
     *
     * @return Evaluador
     */
    public function addEstudiosPosgrado(\AppBundle\Entity\EvaluadorEstudioPosgrado $estudioPosgrado)
    {
        $estudioPosgrado->setEvaluador($this);

        $this->estudiosPosgrados[] = $estudioPosgrado;

        return $this;
    }

    /**
     * Remove estudiosPosgrado
     *
     * @param \AppBundle\Entity\EvaluadorEstudioPosgrado $estudioPosgrado
     */
    public function removeEstudiosPosgrado(\AppBundle\Entity\EvaluadorEstudioPosgrado $estudioPosgrado)
    {
        $this->estudiosPosgrados->removeElement($estudioPosgrado);
    }

    /**
     * Get estudiosPosgrados
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstudiosPosgrados()
    {
        return $this->estudiosPosgrados;
    }

    /**
     * Add curso
     *
     * @param \AppBundle\Entity\EvaluadorCurso $curso
     *
     * @return Evaluador
     */
    public function addCurso(\AppBundle\Entity\EvaluadorCurso $curso)
    {
        $curso->setEvaluador($this);

        $this->cursos[] = $curso;

        return $this;
    }

    /**
     * Remove curso
     *
     * @param \AppBundle\Entity\EvaluadorCurso $curso
     */
    public function removeCurso(\AppBundle\Entity\EvaluadorCurso $curso)
    {
        $this->cursos->removeElement($curso);
    }

    /**
     * Get cursos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * Set cursaCarreraActualmente
     *
     * @param boolean $cursaCarreraActualmente
     *
     * @return Evaluador
     */
    public function setCursaCarreraActualmente($cursaCarreraActualmente)
    {
        $this->cursaCarreraActualmente = $cursaCarreraActualmente;

        return $this;
    }

    /**
     * Get cursaCarreraActualmente
     *
     * @return boolean
     */
    public function getCursaCarreraActualmente()
    {
        return $this->cursaCarreraActualmente;
    }

    /**
     * Set carreraQueCursaActualmente
     *
     * @param string $carreraQueCursaActualmente
     *
     * @return Evaluador
     */
    public function setCarreraQueCursaActualmente($carreraQueCursaActualmente)
    {
        $this->carreraQueCursaActualmente = $carreraQueCursaActualmente;

        return $this;
    }

    /**
     * Get carreraQueCursaActualmente
     *
     * @return string
     */
    public function getCarreraQueCursaActualmente()
    {
        return $this->carreraQueCursaActualmente;
    }

    /**
     * Add idioma
     *
     * @param \AppBundle\Entity\EvaluadorIdioma $idioma
     *
     * @return Evaluador
     */
    public function addIdioma(\AppBundle\Entity\EvaluadorIdioma $idioma)
    {
        $idioma->setEvaluador($this);

        $this->idiomas[] = $idioma;

        return $this;
    }

    /**
     * Remove idioma
     *
     * @param \AppBundle\Entity\EvaluadorIdioma $idioma
     */
    public function removeIdioma(\AppBundle\Entity\EvaluadorIdioma $idioma)
    {
        $this->idiomas->removeElement($idioma);
    }

    /**
     * Get idiomas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdiomas()
    {
        return $this->idiomas;
    }

    /**
     * Add conSeCurDict
     *
     * @param \AppBundle\Entity\EvaluadorConSeCurDict $conSeCurDict
     *
     * @return Evaluador
     */
    public function addConSeCurDict(\AppBundle\Entity\EvaluadorConSeCurDict $conSeCurDict)
    {
        $conSeCurDict->setEvaluador($this);

        $this->conSeCurDicts[] = $conSeCurDict;

        return $this;
    }

    /**
     * Remove conSeCurDict
     *
     * @param \AppBundle\Entity\EvaluadorConSeCurDict $conSeCurDict
     */
    public function removeConSeCurDict(\AppBundle\Entity\EvaluadorConSeCurDict $conSeCurDict)
    {
        $this->conSeCurDicts->removeElement($conSeCurDict);
    }

    /**
     * Get conSeCurDicts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConSeCurDicts()
    {
        return $this->conSeCurDicts;
    }

    /**
     * Get publicacionesYTrabajos
     *
     * @return string
     */
    public function getPublicacionesYTrabajos()
    {
        return $this->publicacionesYTrabajos;
    }
     
    /**
     * Set publicacionesYTrabajo
     * 
     * @param string $publicacionesYTrabajos Publicaciones y trabajos.
     *
     * @return Evaluador
     */ 
    public function setPublicacionesYTrabajos($publicacionesYTrabajos)
    {
        $this->publicacionesYTrabajos = $publicacionesYTrabajos;

        return $this;
    }

    /**
     * Add actualTrabajo 
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoActual $actualTrabajo Trabajo actual.
     *
     * @return Evaluador
     */
    public function addActualTrabajo(\AppBundle\Entity\EvaluadorTrabajoActual $actualTrabajo)
    {
        $actualTrabajo->setEvaluador($this);

        $this->actualTrabajos[] = $actualTrabajo;

        return $this;
    }

    /**
     * Remove actualTrabajo
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoActual $actualTrabajo Trabajo actual.
     */
    public function removeActualTrabajo(\AppBundle\Entity\EvaluadorTrabajoActual $actualTrabajo)
    {
        $this->actualTrabajos->removeElement($actualTrabajo);
    }

    public function getActualTrabajos()
    {
        return $this->actualTrabajos;
    }

    /**
     * Add estatalTrabajo 
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoEstatal $estatalTrabajo Trabajo estatal.
     *
     * @return Evaluador
     */
    public function addEstatalTrabajo(\AppBundle\Entity\EvaluadorTrabajoEstatal $estatalTrabajo)
    {
        $estatalTrabajo->setEvaluador($this);

        $this->estatalTrabajos[] = $estatalTrabajo;

        return $this;
    }

    /**
     * Remove estatalTrabajo
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoEstatal $estatalTrabajo Trabajo estatal.
     */
    public function removeEstatalTrabajo(\AppBundle\Entity\EvaluadorTrabajoEstatal $estatalTrabajo)
    {
        $this->estatalTrabajos->removeElement($estatalTrabajo);
    }

    public function getEstatalTrabajos()
    {
        return $this->estatalTrabajos;
    }
    
    /**
     * Add docenteTrabajo 
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoDocente $docenteTrabajo Trabajo docente.
     *
     * @return Evaluador
     */
    public function addDocenteTrabajo(\AppBundle\Entity\EvaluadorTrabajoDocente $docenteTrabajo)
    {
        $docenteTrabajo->setEvaluador($this);

        $this->docenteTrabajos[] = $docenteTrabajo;

        return $this;
    }

    /**
     * Remove docenteTrabajo
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoDocente $docenteTrabajo Trabajo docente.
     */
    public function removeDocenteTrabajo(\AppBundle\Entity\EvaluadorTrabajoDocente $docenteTrabajo)
    {
        $this->docenteTrabajos->removeElement($docenteTrabajo);
    }

    public function getDocenteTrabajos()
    {
        return $this->docenteTrabajos;
    }

    /**
     * Add ongTrabajo 
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoOng $ongTrabajo Trabajo ong.
     *
     * @return Evaluador
     */
    public function addOngTrabajo(\AppBundle\Entity\EvaluadorTrabajoOng $ongTrabajo)
    {
        $ongTrabajo->setEvaluador($this);

        $this->ongTrabajos[] = $ongTrabajo;

        return $this;
    }

    /**
     * Remove ongTrabajo
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoOng $ongTrabajo Trabajo ong.
     */
    public function removeOngTrabajo(\AppBundle\Entity\EvaluadorTrabajoOng $ongTrabajo)
    {
        $this->ongTrabajos->removeElement($ongTrabajo);
    }

    public function getOngTrabajos()
    {
        return $this->ongTrabajos;
    }

    /**
     * Add empPrivadaTrabajo 
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoEmpPrivada $empPrivadaTrabajo Trabajo empresa privada.
     *
     * @return Evaluador
     */
    public function addEmpPrivadaTrabajo(\AppBundle\Entity\EvaluadorTrabajoEmpPrivada $empPrivadaTrabajo)
    {
        $empPrivadaTrabajo->setEvaluador($this);

        $this->empPrivadaTrabajos[] = $empPrivadaTrabajo;

        return $this;
    }

    /**
     * Remove empPrivadaTrabajo
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoEmpPrivada $empPrivadaTrabajo Trabajo empresa privada.
     */
    public function removeEmpPrivadaTrabajo(\AppBundle\Entity\EvaluadorTrabajoEmpPrivada $empPrivadaTrabajo)
    {
        $this->empPrivadaTrabajos->removeElement($empPrivadaTrabajo);
    }

    public function getEmpPrivadaTrabajos()
    {
        return $this->empPrivadaTrabajos;
    }

    /**
     * Add independienteTrabajo 
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoIndependiente $independienteTrabajo Trabajo independiente.
     *
     * @return Evaluador
     */
    public function addIndependienteTrabajo(\AppBundle\Entity\EvaluadorTrabajoIndependiente $independienteTrabajo)
    {
        $independienteTrabajo->setEvaluador($this);

        $this->independienteTrabajos[] = $independienteTrabajo;

        return $this;
    }

    /**
     * Remove independienteTrabajo
     *
     * @param \AppBundle\Entity\EvaluadorTrabajoIndependiente $independienteTrabajo Trabajo independiente.
     */
    public function removeIndependienteTrabajo(\AppBundle\Entity\EvaluadorTrabajoIndependiente $independienteTrabajo)
    {
        $this->independienteTrabajos->removeElement($independienteTrabajo);
    }

    public function getIndependienteTrabajos()
    {
        return $this->independienteTrabajos;
    }

    /**
     * Add premioCriterio 
     *
     * @param \AppBundle\Entity\EvaluadorCriterioPremio $premioCriterio Criterio del premio.
     *
     * @return Evaluador
     */
    public function addPremioCriterio(\AppBundle\Entity\EvaluadorCriterioPremio $premioCriterio)
    {
        $premioCriterio->setEvaluador($this);

        $this->premioCriterios[] = $premioCriterio;

        return $this;
    }

    /**
     * Remove premioCriterio
     *
     * @param \AppBundle\Entity\EvaluadorCriterioPremio $premioCriterio Criterio del premio.
     */
    public function removePremioCriterio(\AppBundle\Entity\EvaluadorCriterioPremio $premioCriterio)
    {
        $this->premioCriterios->removeElement($premioCriterio);
    }

    public function getPremioCriterios()
    {
        return $this->premioCriterios;
    }

    /**
     * Add gestionCalidadExperiencia 
     *
     * @param \AppBundle\Entity\EvaluadorExpGestionCalidad $gestionCalidadExperiencia Experiencia en gestion de Calidad.
     *
     * @return Evaluador
     */
    public function addGestionCalidadExperiencia(\AppBundle\Entity\EvaluadorExpGestionCalidad $gestionCalidadExperiencia)
    {
        $gestionCalidadExperiencia->setEvaluador($this);

        $this->gestionCalidadExperiencias[] = $gestionCalidadExperiencia;

        return $this;
    }

    /**
     * Remove gestionCalidadExperiencia
     *
     * @param \AppBundle\Entity\EvaluadorExpGestionCalidad $gestionCalidadExperiencia Experiencia en gestion de Calidad.
     */
    public function removeGestionCalidadExperiencia(\AppBundle\Entity\EvaluadorExpGestionCalidad $gestionCalidadExperiencia)
    {
        $this->gestionCalidadExperiencias->removeElement($gestionCalidadExperiencia);
    }

    public function getGestionCalidadExperiencias()
    {
        return $this->gestionCalidadExperiencias;
    }

    /**
     * Get implSistemasGestionCalidad
     *
     * @return string
     */
    public function getImplSistemasGestionCalidad()
    {
        return $this->implSistemasGestionCalidad;
    }
     
    /**
     * Set implSistemasGestionCalidad
     *
     * @param string $implSistemasGestionCalidad implementación de sistemas de calidad
     *
     * @return Evaluador
     */ 
    public function setImplSistemasGestionCalidad($implSistemasGestionCalidad)
    {
        $this->implSistemasGestionCalidad = $implSistemasGestionCalidad;
        return $this;
    }

    /**
     * Get auditoriasOEvaluacionesRealizadas
     *
     * @return string
     */
    public function getAuditoriasOEvaluacionesRealizadas()
    {
        return $this->auditoriasOEvaluacionesRealizadas;
    }
     
    /**
     * Set auditoriasOEvaluacionesRealizadas
     *
     * @param string $auditoriasOEvaluacionesRealizadas Auditorias o evaluaciones realizadas
     *
     * @return Evaluador
     */ 
    public function setAuditoriasOEvaluacionesRealizadas($auditoriasOEvaluacionesRealizadas)
    {
        $this->auditoriasOEvaluacionesRealizadas = $auditoriasOEvaluacionesRealizadas;
        return $this;
    }

    /**
     * Get experienciaComoEvaluador
     *
     * @return string
     */
    public function getExperienciaComoEvaluador()
    {
        return $this->experienciaComoEvaluador;
    }
     
    /**
     * Set experienciaComoEvaluador
     *
     * @param string experienciaComoEvaluador Experiencia como evaluador.
     *
     * @return string
     */ 
    public function setExperienciaComoEvaluador($experienciaComoEvaluador)
    {
        $this->experienciaComoEvaluador = $experienciaComoEvaluador;
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
     
    /**
     * Set observaciones
     *
     * @param string observaciones Observaciones
     *
     * @return string
     */ 
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
        return $this;
    }

    /**
     * __toString method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->apellido . ', ' . $this->nombre;
    }

    /**
     * @Assert\Callback
     */
    public function validateParticularContacto(ExecutionContextInterface $context)
    {
        if ($this->getContactoParticular()) {
            if (!$this->getContactoParticular()->getTelefono()) {
                $context->buildViolation('Este valor no debería estar vacío.')
                    ->atPath('contactoParticular.telefono')
                    ->addViolation();
            }

            if (!$this->getContactoParticular()->getEmail()) {
                $context->buildViolation('Este valor no debería estar vacío.')
                    ->atPath('contactoParticular.email')
                    ->addViolation();
            }
        }
    }

    /**
     * @Assert\Callback
     */
    public function validateParticularLocalizaciones(ExecutionContextInterface $context)
    {
        if ($this->getParticularLocalizaciones()->count() > 0) {
            $first = $this->getParticularLocalizaciones()->first();

            if (!$first->getDireccion()) {
                $context->buildViolation('Este valor no debería estar vacío.')
                    ->atPath('particularLocalizaciones[0].direccion')
                    ->addViolation();
            }

            if (!$first->getLocalidad()) {
                $context->buildViolation('Este valor no debería ser nulo.')
                    ->atPath('particularLocalizaciones[0].localidad')
                    ->addViolation();
            }
        }
    }

    /**
     * @Assert\Callback
     */
    public function validateCarreraQueCursaActualmente(ExecutionContextInterface $context)
    {
        if ($this->getCursaCarreraActualmente() && !$this->getCarreraQueCursaActualmente()) {
            $context->buildViolation('Este valor no debería estar vacío.')
                ->atPath('carreraQueCursaActualmente')
                ->addViolation();
        }
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Evaluador
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add evaluadorPremio
     *
     * @param \AppBundle\Entity\EvaluadorPremio $evaluadorPremio
     *
     * @return Evaluador
     */
    public function addEvaluadorPremio(\AppBundle\Entity\EvaluadorPremio $evaluadorPremio)
    {
        $evaluadorPremio->setEvaluador($this);

        $this->evaluadorPremios[] = $evaluadorPremio;

        return $this;
    }

    /**
     * Remove evaluadorPremio
     *
     * @param \AppBundle\Entity\EvaluadorPremio $evaluadorPremio
     */
    public function removeEvaluadorPremio(\AppBundle\Entity\EvaluadorPremio $evaluadorPremio)
    {
        $this->evaluadorPremios->removeElement($evaluadorPremio);
    }

    /**
     * Get evaluadorPremios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluadorPremios()
    {
        return $this->evaluadorPremios;
    }

    public function getInscripcionEn(Premio $premio){

        foreach ($this->getEvaluadorPremios() as $ep) {
            $idPremioEvaluador = $ep->getPremio()->getId();
            if ( $premio->getId() == $idPremioEvaluador ) {
                return $ep;
            }
        }
        return null;   
    }

    public function getEdad(){

        $birthdate = $this->getFechaNacimiento();
        $today = new \DateTime();
        $age = $birthdate->diff($today)->y;
        return $age;
    }
}
