<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Type\Select2\Select2RemoteEntityType;
use AppBundle\Form\Type\Select2\Select2ChoiceType;
use AppBundle\Utils\Utils;

class EvaluadorEstudioUniversitarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $anioChoices = Utils::anioChoices(80);

        $builder
            ->add(
                'anio', Select2ChoiceType::class,
                array(
                    'label'       => 'Año',
                    'choices'     => $anioChoices,
                    'placeholder' => '',
                    'configs' => array(
                        'theme' => 'bootstrap',
                    ),
                )
            )
            ->add(
                'tituloUniversitario', Select2RemoteEntityType::class,
                array(
                    'class'   => 'AppBundle:TituloUniversitario',
                    'urlType'     => 'route',
                    'url'         => 'admin_titulouniversitario_select2_search',
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
            'data_class' => 'AppBundle\Entity\EvaluadorEstudioUniversitario'
        ));
    }
}
