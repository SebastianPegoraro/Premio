<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;

use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderExecuterInterface;

class EvaluadorFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'apellido',
                Filters\TextFilterType::class,
                array('condition_pattern' => FilterOperands::STRING_CONTAINS)
            )
            ->add(
                'nombre',
                Filters\TextFilterType::class,
                array('condition_pattern' => FilterOperands::STRING_CONTAINS)
            )
            ->add(
                'dni',
                Filters\NumberRangeFilterType::class,
                array(
                    'left_number_options'  => array(
                        'label' => 'Desde',
                        'condition_operator' => FilterOperands::OPERATOR_GREATER_THAN_EQUAL
                    ),
                    'right_number_options' => array(
                        'label' => 'Hasta',
                        'condition_operator' => FilterOperands::OPERATOR_LOWER_THAN_EQUAL
                    ),
                )
            )
            ->add(
                'particularLocalizaciones',
                Filters\CollectionAdapterFilterType::class,
                array(
                    'label'      => 'Domicilio Particular',
                    'entry_type' => LocalizacionFilterType::class,
                    'add_shared' => function (FilterBuilderExecuterInterface $qbe)  {
                        $closure = function (QueryBuilder $filterBuilder, $alias, $joinAlias, Expr $expr) {
                            // add the join clause to the doctrine query builder
                            // the where clause for the label and color fields will be added automatically with the right alias later by the Lexik\Filter\QueryBuilderUpdater
                            $filterBuilder->leftJoin($alias . '.particularLocalizaciones', $joinAlias);
                        };

                        // then use the query builder executor to define the join and its alias.
                        $qbe->addOnce($qbe->getAlias().'.particularLocalizaciones', 'l', $closure);
                    }
                )
            )
            ->add(
                'estudiosUniversitarios',
                Filters\CollectionAdapterFilterType::class,
                array(
                    'label'      => 'Estudios Universitarios',
                    'entry_type' => EvaluadorEstudioUniversitarioFilterType::class,
                    'add_shared' => function (FilterBuilderExecuterInterface $qbe)  {
                        $closure = function (QueryBuilder $filterBuilder, $alias, $joinAlias, Expr $expr) {
                            // add the join clause to the doctrine query builder
                            // the where clause for the label and color fields will be added automatically with the right alias later by the Lexik\Filter\QueryBuilderUpdater
                            $filterBuilder->leftJoin($alias . '.estudiosUniversitarios', $joinAlias);
                        };

                        // then use the query builder executor to define the join and its alias.
                        $qbe->addOnce($qbe->getAlias().'.estudiosUniversitarios', 'eu', $closure);
                    }
                )
            )
        ;
    }

    public function getParent()
    {
        return Filters\SharedableFilterType::class; // this allow us to use the "add_shared" option
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
        return 'evaluador_filter';
    }
}
