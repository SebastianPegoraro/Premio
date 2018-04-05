<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Type\Select2\Select2EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\EvaluadorPremio;


class EquipoEvaluadorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'nombre', null,
                array(
                    'label' => 'Nombre del Equipo',
                )
            )
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $ee = $event->getData();
            $form = $event->getForm();

            $organizacionQBCallback = function (EntityRepository $er) use ($ee) {
                return $er->getQBForEquipoEvaluadorType($ee);
            };

            $evaluadoresQBCallback = function (EntityRepository $er) use ($ee) {
                return $er->getQBForEquipoEvaluadorType($ee);
            };

            $form
                ->add(
                    'organizacion', Select2EntityType::class,
                    array(
                        'class'         => 'AppBundle:Organizacion',
                        'label'         => 'Evalúa a',
                        'query_builder' => $organizacionQBCallback,
                        'choice_label'  => function ($o) {
                            return $o->getNombre() . ' [' . $o->getTipoOrganizacion() . ']';
                        },
                        'placeholder'  => '',
                        'configs'      => array(
                            'theme' => 'bootstrap',
                        )
                    )
                )
                ->add(
                    'evaluadores', Select2EntityType::class,
                    array(
                        'class'         => 'AppBundle:EvaluadorPremio',
                        'label'         => 'Evaluadores integrantes',
                        'query_builder' => $evaluadoresQBCallback,
                        'choice_label'  => 'evaluador',
                        'placeholder'   => '',
                        'by_reference'  => false,
                        'multiple'      => true,
                        'configs'       => array(
                            'theme' => 'bootstrap',
                        )
                    )
                )
            ;
        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EquipoEvaluador'
        ));
    }
}
