<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use AppBundle\Entity\Organizacion;

class OrganizacionPublicaFilterType extends AbstractType
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
                'categoria',
                Filters\EntityFilterType::class,
                array(
                    'class' => 'AppBundle:CategoriaPublica',
                    'label' => 'Categoría',
                )
            )
            ->add(
                'estado',
                Filters\ChoiceFilterType::class,
                array('choices' => Organizacion::$estados)
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
        return 'organizacion_publica_filter';
    }
}
