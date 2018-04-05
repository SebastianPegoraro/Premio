<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\EvaluadorPremio;
use AppBundle\Form\EvaluadorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EvaluadorPremioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estado')
            ->add('evaluador', EvaluadorType::class)
            ->add(
                'estado', ChoiceType::class,
                array(
                    'choices' => EvaluadorPremio::$estados,
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
            'data_class'  => 'AppBundle\Entity\EvaluadorPremio',
        ));
    }
}
