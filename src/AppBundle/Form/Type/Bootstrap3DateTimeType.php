<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

/**
 * Class Boostrap3DateTimeType
 *
 * @package AppBundle\Form\Type
 */
class Bootstrap3DateTimeType extends AbstractType
{
    /**
     * Build View
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['options'] = $this->createDisplayOptions($options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'widget'  => 'single_text',
                'format'  => 'yyyy-MM-dd HH:mm:ss',
                'options' => array(),
                'with_minutes' => true,
            )
        );

        $resolver
            ->setAllowedValues('format', 'yyyy-MM-dd HH:mm:ss')
            ->setAllowedValues('widget', 'single_text')
            ->setAllowedValues('with_minutes', true)
        ;
    }

    /**
     * Get Parent.
     *
     * @return null|string|\Symfony\Component\Form\FormTypeInterface
     */
    public function getParent()
    {
        return DateTimeType::class;
    }

    private function createDisplayOptions($typeOptions=array())
    {
        //bootstrap3 datepicker js options
        $jsOptions = $typeOptions['options'];

        $displayOptions = array(
            'format'   => 'DD/MM/YYYY - HH:mm',
            'showTodayButton' => true,
            'ignoreReadonly' => true,
            'allowInputToggle' => true,
            'showClear' => true,
        );

        //Default locale 'es'
        if (!array_key_exists('locale', $jsOptions)) {
            $displayOptions['locale'] = 'es';
        }

        // if (array_key_exists('required', $typeOptions) && $typeOptions['required'] == false) {
        //     $displayOptions['showClear'] = true;
        // }

        if (isset($typeOptions['with_seconds']) && $typeOptions['with_seconds']) {
            $displayOptions['format'] = 'DD/MM/YYYY HH:mm:ss';
            $displayOptions['useSeconds'] = true;
        }

        $displayOptions = array_merge($jsOptions, $displayOptions);

        return empty($displayOptions) ? null : $displayOptions;
    }
} 