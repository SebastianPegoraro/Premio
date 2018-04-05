<?php

namespace AppBundle\Form\Type\Filters;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Type\Filters\Bootstrap3DateTimeFilterType;

/**
 * Bootstrap3DateTimeRangeFilterType class
 *
 * @author Facundo Sosa López <fssl2004@gmail.com>
 */
class Bootstrap3DateTimeRangeFilterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('left_datetime', Bootstrap3DateTimeFilterType::class, $options['left_datetime_options']);
        $builder->add('right_datetime', Bootstrap3DateTimeFilterType::class, $options['right_datetime_options']);

        $builder->setAttribute('filter_value_keys', array(
            'left_datetime'  => $options['left_datetime_options'],
            'right_datetime' => $options['right_datetime_options'],
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array(
                'required'               => false,
                'left_datetime_options'  => array(),
                'right_datetime_options' => array(),
                'data_extraction_method' => 'value_keys',
            ))
            ->setAllowedValues('data_extraction_method', array('value_keys'))
        ;
    }

    public function getBlockPrefix()
    {
        return 'filter_bootstrap3_datetime_range';
    }
}
