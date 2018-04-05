<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * Class Boostrap3DatePickerType
 *
 * @package AppBundle\Form\Type
 */
class Bootstrap3DateType extends AbstractType
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
                'format'  => 'yyyy-MM-dd',
                'html5'   => false,
                'options' => array(),
            )
        );

        $resolver
            ->setAllowedValues('format', 'yyyy-MM-dd')
            ->setAllowedValues('widget', 'single_text')
            ->setAllowedValues('html5', false)
        ;
    }

    /**
     * Get Parent.
     *
     * @return null|string|\Symfony\Component\Form\FormTypeInterface
     */
    public function getParent()
    {
        return DateType::class;
    }

    /**
     * Creates display options
     *
     * @param array $typeOptions This type options
     * @return array|null
     */
    private function createDisplayOptions($typeOptions=array())
    {
        $jsOptions = $typeOptions['options'];

        $displayOptions = array(
            'format'           => 'DD/MM/YYYY',
            'showTodayButton'  => true,
            'ignoreReadonly'   => true,
            'allowInputToggle' => true,
            'showClear'        => true,
        );

        //Default locale 'es'
        if (!array_key_exists('locale', $jsOptions)) {
            $displayOptions['locale'] = 'es';
        }

        // if (array_key_exists('required', $typeOptions) && $typeOptions['required'] == false) {
        //     $displayOptions['showClear'] = true;
        // }

        $displayOptions = array_merge($jsOptions, $displayOptions);

        return empty($displayOptions) ? null : $displayOptions;
    }

} 