<?php

/*
 * This file is part of the GenemuFormBundle package.
 *
 * (c) Olivier Chauvel <olivier@generation-multiple.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type\Select2;

use AppBundle\Form\DataTransformer\ArrayToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Select2Type to JQueryLib
 *
 * @author Bilal Amarni <bilal.amarni@gmail.com>
 * @author Chris Tickner <chris.tickner@gmail.com>
 */
abstract class Select2Type extends AbstractType
{
    protected $widget = ChoiceType::class;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['configs'] = $this->createDisplayOptions($options);

        /*Inserta un block prefix select2*/
        $idx = array_search($this->getBlockPrefix(), $view->vars['block_prefixes']);
        array_splice(
            $view->vars['block_prefixes'],
            $idx,
            0,
            'select2'            
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $defaults = array();
        $resolver
            ->setDefaults(array(
                'configs'  => $defaults,
                'expanded' => false,
            ))
            ->setAllowedValues('expanded', false)
            ->setNormalizer('configs', function (Options $options, $configs) use ($defaults) {
                    return array_merge($defaults, $configs);
                }
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this->widget;
    }

        /**
     * Creates display options
     *
     * @param array $typeOptions This type options
     * @return array|null
     */
    private function createDisplayOptions($typeOptions=array())
    {
        $jsOptions = $typeOptions['configs'];

        $displayOptions = array(
            'allowClear' => true,
        );

        //Default language 'es'
        if (!array_key_exists('language', $jsOptions)) {
            $displayOptions['language'] = 'es';
        }


        //Si se seteo la opción placeholder del widget la traspaso a jsOptions
        if (array_key_exists('placeholder', $typeOptions)) {
            $jsOptions['placeholder'] = empty($typeOptions['placeholder']) ? '' : $typeOptions['placeholder'];
        }

        if (!array_key_exists('placeholder', $jsOptions)) {
            $displayOptions['placeholder'] = '';
        }

        //Default width '100%'
        if (!array_key_exists('width', $jsOptions)) {
            $displayOptions['width'] = '100%';
        }

        $displayOptions = array_merge($jsOptions, $displayOptions);

        return empty($displayOptions) ? null : $displayOptions;
    }

}
