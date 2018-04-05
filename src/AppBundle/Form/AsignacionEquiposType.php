<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class AsignacionEquiposType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'evaluadores',
                CollectionType::class,
                array(
                    'entry_type'  => EvaluadorPremioParaAsignacionEquiposType::class,
                    'constraints' => new Valid(),
                    //'error_bubbling' => false,
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $callback = function ($data, ExecutionContextInterface $context, $payload) {
            $evaluadores = $data['evaluadores'];
            $aux = array();
            foreach ($evaluadores as $e) {
                $equipo = $e->getEquipo();
                if ($equipo && $e->getEsJefeDeEquipo()) {
                    if (!array_key_exists($equipo->getId(), $aux)) {
                        $aux[$equipo->getId()] = array(
                            'equipo'      => $equipo->getNombre(),
                            'evaluadores' => array($e->getEvaluador()->__toString()), 
                            'cant'        => 1,
                        );

                    } else {
                        $aux[$equipo->getId()]['cant'] += 1;
                        $aux[$equipo->getId()]['evaluadores'][] = $e->getEvaluador()->__toString();
                    }    
                }
            }

            $error = '';
            
            foreach ($aux as $a) {
                if ($a['cant'] > 1) {
                    $error .= '<li>' . $a['equipo'] . ': <ul><li>' . implode('</li><li>', $a['evaluadores']) . '</li></ul></li>';
                }
            }
            
            if (!empty($error)) {
                $context
                    ->buildViolation(
                        'Esta tratando de asignar mas de un jefe a estos equipos: <ul>' . $error. '</ul>'
                    )
                    ->addViolation();
            }
        };

        $resolver->setDefaults(array(
            'constraints' => array(
                new Callback($callback),
            ),
        ));
    }
}
