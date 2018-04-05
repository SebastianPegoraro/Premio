<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Form\Type\Bootstrap3DateType;
use AppBundle\Form\Type\Select2\Select2RemoteEntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EvaluadorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //DATOS PERSONALES
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('imageFile', VichImageType::class, array(
                    'required' => false,
                    'label' => 'Foto',
                )
            )
            ->add(
                'fechaNacimiento', Bootstrap3DateType::class,
                array(
                    'label'   => 'Fecha de Nacimiento',
                    'options' => array(
                        'viewMode' => 'years',
                    ),
                )
            )
            ->add(
                'lugarNacimiento', Select2RemoteEntityType::class,
                array(
                    'label' => 'Lugar de Nacimiento',
                    'class'   => 'AppBundle:Localidad',
                    'urlType'     => 'route',
                    'url'         => 'admin_localidad_select2_search',
                    'configs' => array(
                        'theme' => 'bootstrap',
                    )
                )
            )
            ->add(
                'particularLocalizaciones',
                CollectionType::class,
                array(
                    'entry_type' => LocalizacionType::class,
                    'label'      => 'Dirección Particular',
                )
            )
            ->add(
                'contactoParticular',
                \AppBundle\Form\ContactoType::class,
                array(
                    'label' => 'Contacto Particular',
                )
            )
            ->add(
                'laboralLocalizaciones',
                CollectionType::class,
                array(
                    'entry_type' => LocalizacionType::class,
                    'label'      => 'Dirección Laboral',
                )
            )
            ->add(
                'contactoLaboral',
                \AppBundle\Form\ContactoType::class,
                array(
                    'label' => 'Contacto Laboral',
                )
            )
            //ESTUDIOS UNIVERSITARIOS
            ->add(
                'estudiosUniversitarios',
                CollectionType::class,
                array(
                    'entry_type'   => EvaluadorEstudioUniversitarioType::class,
                    'label'        => 'Estudios Universitarios',
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'error_bubbling' => false,
                )
            )
            //ESTUDIOS DE POSTGRADO
            ->add(
                'estudiosPosgrados',
                CollectionType::class,
                array(
                    'entry_type'   => EvaluadorEstudioPosgradoType::class,
                    'label'        => 'Estudios de Postgrado',
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'error_bubbling' => false,
                )
            )
            //CURSOS
            ->add(
                'cursos',
                CollectionType::class,
                array(
                    'entry_type'   => EvaluadorCursoType::class,
                    'label'        => 'Cursos mas relevantes (sean o no de gestión de calidad)',
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'cursaCarreraActualmente', ChoiceType::class,
                array(
                    'label'    => 'Cursa actualmente alguna carrera?',
                    'choices'  => array('No' => false, 'Sí' => true),
                    'expanded' => true,
                )
            )
            ->add('carreraQueCursaActualmente')
            //IDIOMAS
            ->add(
                'idiomas',
                CollectionType::class,
                array(
                    'entry_type'   => EvaluadorIdiomaType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'conSeCurDicts',
                CollectionType::class,
                array(
                    'label'          => 'Conferencias, Seminarios y Cursos dictados',
                    'entry_type'     => EvaluadorConSeCurDictType::class,
                    'allow_add'      => true,
                    'allow_delete'   => true,
                    'by_reference'   => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'publicacionesYTrabajos', null,
                array(
                    'label' => 'Publicaciones y Trabajos de Investigación',
                    'attr'  => array('rows' => 5)
                )
            )
            ->add(
                'actualTrabajos',
                CollectionType::class,
                array(
                    'label'          => 'Trabajo Actual',
                    'entry_type'     => EvaluadorTrabajoActualType::class,
                    'allow_add'      => true,
                    'allow_delete'   => true,
                    'by_reference'   => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'estatalTrabajos',
                CollectionType::class,
                array(
                    'label'          => 'Esperiencia de Trabajo en Instituciones Estatales (excluida la docencia)',
                    'entry_type'     => EvaluadorTrabajoEstatalType::class,
                    'allow_add'      => true,
                    'allow_delete'   => true,
                    'by_reference'   => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'docenteTrabajos',
                CollectionType::class,
                array(
                    'label'          => 'Experiencia de trabajo en Instituciones Docentes',
                    'entry_type'     => EvaluadorTrabajoDocenteType::class,
                    'allow_add'      => true,
                    'allow_delete'   => true,
                    'by_reference'   => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'ongTrabajos',
                CollectionType::class,
                array(
                    'label'          => 'Experiencia de trabajo en Organizaciones No Gubernamentales',
                    'entry_type'     => EvaluadorTrabajoOngType::class,
                    'allow_add'      => true,
                    'allow_delete'   => true,
                    'by_reference'   => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'empPrivadaTrabajos',
                CollectionType::class,
                array(
                    'label'          => 'Experiencia de trabajo en Empresas Privadas',
                    'entry_type'     => EvaluadorTrabajoEmpPrivadaType::class,
                    'allow_add'      => true,
                    'allow_delete'   => true,
                    'by_reference'   => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'independienteTrabajos',
                CollectionType::class,
                array(
                    'label'          => 'Experiencia como Profesional Independiente',
                    'entry_type'     => EvaluadorTrabajoIndependienteType::class,
                    'allow_add'      => true,
                    'allow_delete'   => true,
                    'by_reference'   => false,
                    'error_bubbling' => false,
                )
            );

        $premioCriteriosLabel = <<<EOT
Basado en sus conocimientos y experiencia, asigne un número en la escala de 1 a 10 a la lista de criterios del Premio
detallada más abajo, siendo 10 aquel en le cual Ud. tiene mayor experiencia y conocimiento y 1 el que menos domina
(se ruega no repetir números)
EOT;

        $builder
            ->add(
                'premioCriterios',
                CollectionType::class,
                array(
                    'label'          => $premioCriteriosLabel,
                    'entry_type'     => EvaluadorCriterioPremioType::class,
                    'by_reference'   => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'gestionCalidadExperiencias',
                CollectionType::class,
                array(
                    'label'          => 'Experiencia en Gestión de Calidad',
                    'entry_type'     => EvaluadorExpGestionCalidadType::class,
                    'allow_add'      => true,
                    'allow_delete'   => true,
                    'by_reference'   => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'implSistemasGestionCalidad', null,
                array(
                    'label' => 'Implementación de Sistemas de Gestión de Calidad',
                    'attr'  => array('rows' => 5),
                )
            )
            ->add(
                'auditoriasOEvaluacionesRealizadas', null,
                array(
                    'attr'  => array('rows' => 5),
                )
            )
            ->add(
                'experienciaComoEvaluador', null,
                array(
                    'label' => 'Experiencia como Evaluador',
                    'attr'  => array('rows' => 5),
                )
            )
            ->add(
                'observaciones', null,
                array(
                    'label' => 'Observaciones que estime correspondan',
                    'attr'  => array('rows' => 5),
                )
            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Evaluador'
        ));
    }
}
