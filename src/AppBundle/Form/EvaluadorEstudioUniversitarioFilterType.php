<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use AppBundle\Form\Type\Select2\Select2RemoteEntityType;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class EvaluadorEstudioUniversitarioFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'tituloUniversitario', Select2RemoteEntityType::class,
                array(
                    'label'    => 'Título Universitario',
                    'required' => false, 
                    'class'    => 'AppBundle:TituloUniversitario',
                    'urlType'     => 'route',
                    'url'         => 'admin_titulouniversitario_select2_search',
                    'configs' => array(
                        'theme' => 'bootstrap',
                    ),
                    'apply_filter' => function (QueryInterface $filterQuery, $field, $values) {
                        if (empty($values['value'])) {
                            return null;
                        }

                        $paramName = sprintf('p_%s', str_replace('.', '_', $field));

                        // expression that represent the condition
                        $expression = $filterQuery->getExpr()->eq($field, ':'.$paramName);

                        // expression parameters
                        $parameters = array($paramName => $values['value']); // [ name => value ]
                        // or if you need to define the parameter's type
                        // $parameters = array($paramName => array($values['value'], \PDO::PARAM_STR)); // [ name => [value, type] ]

                        return $filterQuery->createCondition($expression, $parameters);
                    }, 
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
        ));
    }

    public function getBlockPrefix()
    {
        return 'evaluadorestudiouniversitario_filter';
    }
}
