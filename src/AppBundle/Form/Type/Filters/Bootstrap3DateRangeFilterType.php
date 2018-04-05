<?php

namespace AppBundle\Form\Type\Filters;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Type\Filters\Bootstrap3DateFilterType;

/**
 * Bootstrap3DateRangeFilterType class
 *
 * @author Facundo Sosa López <fssl2004@gmail.com>
 */
class Bootstrap3DateRangeFilterType extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder->add('left_date', Bootstrap3DateFilterType::class, $options['left_date_options']);
        $builder->add('right_date', Bootstrap3DateFilterType::class, $options['right_date_options']);

        $builder->setAttribute('filter_value_keys', array(
            'left_date'  => $options['left_date_options'],
            'right_date' => $options['right_date_options'],
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array(
                'required'               => false,
                'left_date_options'      => array(),
                'right_date_options'     => array(),
                'data_extraction_method' => 'value_keys',
            ))
            ->setAllowedValues('data_extraction_method', array('value_keys'))
        ;
    }

    public function getBlockPrefix()
    {
        return 'filter_bootstrap3_date_range';
    }
}