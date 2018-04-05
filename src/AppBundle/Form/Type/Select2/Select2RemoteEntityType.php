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
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Util\StringUtil;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use AppBundle\Form\DataTransformer\Select2RemoteModelTransformer;
use AppBundle\Form\DataTransformer\Select2RemoteViewTransformer;

/**
 * @author Facundo Sosa López <fssl2004@gmail.com>
 */
class Select2RemoteEntityType extends Select2Type
{
    protected $widget = FormType::class;
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $builder->getData();

        $builder
            ->addViewTransformer(
                new Select2RemoteViewTransformer(
                   $this->om,
                   $options['class'],
                   $options['multiple']
                )
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        $view->vars['url'] = $options['url'];
        $view->vars['urlType'] = $options['urlType'];
        $view->vars['multiple'] = $options['multiple'];
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
        	->setDefaults(
        		array(
                    'multiple'    => false,
                    'compound'    => false,
                    'placeholder' => '',
     			)
    		)
            ->setRequired('url')
            ->setRequired('urlType')
            ->setRequired('class')
            ->setAllowedTypes('url', 'string')
            ->setAllowedTypes('urlType', 'string')
            ->setAllowedValues('urlType', array('route', 'external'))
            ->setAllowedTypes('class', 'string')
            ->setAllowedTypes('multiple', 'boolean')
            ->setAllowedValues('multiple', array(true, false))
        ;
    }

    public function getBlockPrefix()
    {
        return 'select2_remote_entity';
    }
}
