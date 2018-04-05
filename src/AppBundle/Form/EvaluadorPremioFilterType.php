<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderExecuterInterface;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\EvaluadorPremio;
use AppBundle\Form\EvaluadorFilterType;
use AppBundle\Form\Type\Filters\Bootstrap3DateRangeFilterType;

class EvaluadorPremioFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'estado', Filters\ChoiceFilterType::class,
                array(
                    'choices'    => EvaluadorPremio::$estados,
                )
            )
            ->add(
                'createdAt', Bootstrap3DateRangeFilterType::class,
                array(
                    'label' => 'Fecha de Inscripción',
                    'left_date_options'  => array(
                        'label' => 'Desde',
                    ),
                    'right_date_options' => array(
                        'label' => 'Hasta',
                    ) 
                )
            )
            ->add(
                'evaluador', EvaluadorFilterType::class,
                array(
                    'add_shared' => function (FilterBuilderExecuterInterface $qbe) {
                        $closure = function (QueryBuilder $filterBuilder, $alias, $joinAlias, Expr $expr) {
                            $filterBuilder->leftJoin($alias . '.evaluador', $joinAlias);
                        };

                        $qbe->addOnce($qbe->getAlias().'.evaluador', 'ev', $closure);
                    }
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
            'validation_groups' => array('filtering'),
        ));
    }

    public function getBlockPrefix()
    {
        return 'evaluadorpremio_filter';
    }
}
