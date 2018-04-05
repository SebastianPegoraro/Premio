<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Type;
//use Symfony\Component\Validator\Constraints\Regex;


class RespuestaEvaluacionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'porcentaje', NumberType::class/*,
                array(
                    'scale' => 0,
                    'constraints' => array(
                        new Type(
                            array(
                                'type' => 'integer',
                                'message' => 'Debe ingresar un valor entero.'
                            )
                        )
                    )     
                )*/
            )
            ->add('children',
                CollectionType::class,
                array(
                    'entry_type' => RespuestaEvaluacionType::class,
                )
            )
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $re = $event->getData();
            $form = $event->getForm();

            if ($re->getChildren()->count()) {
                $form->add(
                    'porcentaje', HiddenType::class,
                    array(
                        'error_bubbling' => false,
                    )
                );
            }
        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\RespuestaEvaluacion'
        ));
    }
}
