<?php 

namespace AppBundle\Form\Type\Filters;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Type\Bootstrap3DateTimeType;

/**
 * Bootstrap3DateFilterType
 */
class Bootstrap3DateTimeFilterType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults(array(
                'required'               => false,
                'data_extraction_method' => 'default',
            ))
            ->setAllowedValues('data_extraction_method', array('default'))
        ;
    }

    public function getParent()
    {
        return Bootstrap3DateTimeType::class;
    }

    public function getBlockPrefix()
    {
        return 'filter_bootstrap3_datetime';
    }
}