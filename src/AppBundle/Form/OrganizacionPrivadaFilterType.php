<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use AppBundle\Entity\OrganizacionPrivada;
use AppBundle\Entity\Organizacion;

class OrganizacionPrivadaFilterType extends AbstractType
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
                    'class' => 'AppBundle:CategoriaPrivada',
                    'label' => 'Categoría',
                )
            )
            ->add(
                'tipo',
                Filters\ChoiceFilterType::class,
                array(
                    'choices'  => OrganizacionPrivada::$tipoOptions,
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
        ));
    }

    public function getBlockPrefix()
    {
        return 'organizacion_privada_filter';
    }
}
