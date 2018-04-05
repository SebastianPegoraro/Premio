<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Organizacion;
use AppBundle\Entity\OrganizacionPrivada;
use AppBundle\Form\Type\Select2\Select2ChoiceType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class OrganizacionPrivadaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $anioInicioActividadesChoices = array_combine(
            range(date('Y'), 1900), range(date('Y'), 1900)
        );
        
        $builder
            ->add(
                'nombre', null,
                array('label' => 'Razón Social o Nombre de la Empresa')
            )
            ->add(
                'cuit', null,
                array(
                    'label' => 'Cuit (sin guiones "-")',
                )
            )
            ->add(
                'localizaciones',
                CollectionType::class,
                array(
                    'entry_type' => LocalizacionType::class,
                    'label'      => 'Localizaciones',
                )
            )
            ->add(
                'contactoOrganizacion',
                \AppBundle\Form\ContactoType::class,
                array(
                    'label' => 'Contacto',
                )
            )
            ->add(
                'responsableOrganizacionApellido', null,
                array('label' => 'Apellido')
            )
            ->add(
                'responsableOrganizacionNombre', null,
                array('label' => 'Nombre')
            )
            ->add(
                'responsableOrganizacionFuncion', null,
                array('label' => 'Cargo')
            )
            ->add(
                'responsableOrganizacionContacto',
                \AppBundle\Form\ContactoType::class,
                array(
                    'label' => 'Contacto del Responsable Máximo de la Organización',
                )
            )
            ->add(
                'responsableEnPremioApellido', null,
                array('label' => 'Apellido')
            )
            ->add(
                'responsableEnPremioNombre', null,
                array('label' => 'Nombre')
            )
            ->add(
                'responsableEnPremioFuncion', null,
                array('label' => 'Cargo')
            )
            ->add(
                'responsableEnPremioContacto',
                \AppBundle\Form\ContactoType::class,
                array(
                    'label' => 'Contacto del Responsable Frente al Premio',
                )
            )
            ->add(
                'actividadPrincipal', null,
                array(
                    'label' => 'Descripción de la Actividad',
                    'attr'  => array('rows' => 5),
                )
            )
            ->add(
                'tipo',
                ChoiceType::class,
                array(
                    'choices'  => OrganizacionPrivada::$tipoOptions,
                    'expanded' => true,
                )
            )
            ->add(
                'categoria', null,
                array(
                    'label'    => 'Seleccione la categoría correspondiente',
                    'expanded' => true,
                )
            )
            ->add(
                'clientes',
                CollectionType::class,
                array(
                    'entry_type' => OrganizacionClienteType::class,
                    'label'      => 'Clientes Principales',
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'proveedores',
                CollectionType::class,
                array(
                    'entry_type' => OrganizacionProveedorType::class,
                    'label'      => 'Proveedores Principales',
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'error_bubbling' => false,
                )
            )
            ->add(
                'anioInicioActividades', Select2ChoiceType::class,
                array(
                    'label' => 'Año de inicio de Actividades',
                    'choices' => $anioInicioActividadesChoices,
                    'placeholder' => '',
                    'configs' => array(
                        'theme' => 'bootstrap',
                    ),
                )
            )

            ->add(
                'cantTrabajadoresPropios', null,
                array(
                    'label' => 'Números de Trabajadores Propios'
                )
            )
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $op = $event->getData();
            $form = $event->getForm();

            if ($op->getId()) {
                // $form->add(
                //     'estado', ChoiceType::class,
                //     array(
                //         'choices' => array_combine(
                //             Organizacion::$estadosSiguientes[$op->getEstado()],
                //             Organizacion::$estadosSiguientes[$op->getEstado()]
                //         )
                //     )
                // );
                $form->add(
                    'estado', ChoiceType::class,
                    array(
                        'choices' => Organizacion::$estados,
                    )
                );
            }
            
        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\OrganizacionPrivada'
        ));
    }
}
