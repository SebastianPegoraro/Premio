<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Form\Type\Select2\Select2RemoteEntityType;

class LocalizacionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'direccion', null,
                array(
                    'label' => 'Dirección',
                )
            )
            ->add(
                'localidad',
                Select2RemoteEntityType::class,
                array(
                    'class'   => 'AppBundle:Localidad',
                    'urlType'     => 'route',
                    'url'         => 'admin_localidad_select2_search',
                    //'placeholder' => '',
                    'configs' => array(
                        'width' => '100%',
                        'theme' => 'bootstrap',
                    ),
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
            'data_class' => 'AppBundle\Entity\Localizacion'
        ));
    }
}
