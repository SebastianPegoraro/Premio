<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class OrganizacionPremioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('estado')
            ->add('responsableEnPremioApellido')
            ->add('responsableEnPremioNombre')
            ->add('responsableEnPremioFuncion')
            //->add('premio')
            ->add('organizacion')
            //->add('equipo')
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
            )
        ;
    }

    public function onPreSetData(FormEvent $event)
    {
        $entity = $event->getData();
        $form = $event->getForm();

        if ($entity->getOrganizacion() instanceof \AppBundle\Entity\OrganizacionPublica) {
            $form->add('organizacion', OrganizacionPublicaType::class);
        } else {
            $form->add('organizacion', OrganizacionPrivadaType::class);
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\OrganizacionPremio'
        ));
    }
}
