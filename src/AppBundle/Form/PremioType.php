<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Type\Bootstrap3DateTimeType;

class PremioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add(
                'anio', null,
                array('label' => 'Año', )
            )
            ->add(
                'fechaHoraInicioInscripcion', Bootstrap3DateTimeType::class,
                array('label' => 'Inicio Inscripción', )
            )
            ->add(
                'fechaHoraFinInscripcion', Bootstrap3DateTimeType::class,
                array('label' => 'Fin Inscripción', )
            )
            ->add(
                'fechaHoraInicioConcurso', Bootstrap3DateTimeType::class,
                array('label' => 'Inicio Concurso', )
            )
            ->add(
                'fechaHoraFinConcurso', Bootstrap3DateTimeType::class,
                array('label' => 'Fin Concurso', )
            )
            ->add(
                'formularioEvaluacion'
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Premio'
        ));
    }
}
