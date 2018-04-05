<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CriterioEvaluacionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('puntajeMaximo')
            ->add('parent')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $ce = $event->getData();
            $form = $event->getForm();
            
            if ($ce && $ce->getId()) {
                $parentQB = function (EntityRepository $er) use ($ce){
                    return $er->createQueryBuilder('ce')
                        ->andWhere('ce <> :criterio')
                        ->andWhere('ce.formularioEvaluacion = :formulario')
                        ->setParameter('criterio', $ce)
                        ->setParameter('formulario', $ce->getFormularioEvaluacion());
                };
                $form->add(
                    'parent', null,
                    array(
                        'query_builder' => $parentQB,
                        'placeholder'   => '',
                    )
                );
            } else {
                $form->add(
                    'parent', null,
                    array(
                        'choices'     => array(),
                        'placeholder' => '',
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
            'data_class' => 'AppBundle\Entity\CriterioEvaluacion'
        ));
    }
}
