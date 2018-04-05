<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\EvaluadorIdioma;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Form\Type\Select2\Select2EntityType;
use AppBundle\Form\Type\Select2\Select2RemoteEntityType;

class EvaluadorIdiomaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'lee', ChoiceType::class,
                array(
                    'choices'     => EvaluadorIdioma::$idomaCalificacionOptions,
                    'placeholder' => '',
                )
            )
            ->add(
                'habla', ChoiceType::class,
                array(
                    'choices'     => EvaluadorIdioma::$idomaCalificacionOptions,
                    'placeholder' => '',
                )
            )
            ->add(
                'escribe', ChoiceType::class,
                array(
                    'choices'     => EvaluadorIdioma::$idomaCalificacionOptions,
                    'placeholder' => '',
                )
            )
            ->add(
                'idioma', Select2RemoteEntityType::class,
                array(
                    'class'   => 'AppBundle:Idioma',
                    'urlType'     => 'route',
                    'url'         => 'admin_idioma_select2_search',
                    'configs' => array(
                        'theme' => 'bootstrap',
                    )
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
            'data_class' => 'AppBundle\Entity\EvaluadorIdioma'
        ));
    }
}
