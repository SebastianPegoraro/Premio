<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;

class LocalidadFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'nombre',
                Filters\TextFilterType::class,
                array('condition_pattern' => FilterOperands::STRING_CONTAINS)
            )
            ->add(
                'provincia',
                Filters\EntityFilterType::class,
                array(
                    'class'    => 'AppBundle:Provincia',
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
            'csrf_protection'   => false,
            'validation_groups' => array('filtering')
            //'data_class' => 'AppBundle\Entity\Provincia'
        ));
    }

    public function getBlockPrefix()
    {
        return 'provincia_filter';
    }
}
