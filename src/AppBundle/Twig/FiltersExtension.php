<?php

namespace AppBundle\Twig;

use Symfony\Component\Form\Extension\Core\View\ChoiceView;
use Symfony\Component\Form\FormView;
use Doctrine\Common\Collections\Collection;

/**
 * Class IprodichTwigExtension
 *
 * @author Facundo Sosa López <fssl2004@gmail.com>
 */
class FiltersExtension extends \Twig_Extension
{
    private $filtered;
    private $appliedFilters;
    private $renderOptions = array('date_format' => 'd/m/Y H:i');
    private $tmpRenderOpts = array();
    private $emptyValues = array(null, false);
    private $hasErrors = false;

    /**
     * Get Tests
     *
     * @return array
     */
    public function getTests()
    {
        $tests = array();

        $tests[] = new \Twig_SimpleTest('filtered', array($this, 'isFiltered'));

        return $tests;
    }

    /**
     * get Functions
     *
     * @return array
     */
    public function getFunctions()
    {
        $functions = array();

        $functions[] = new \Twig_SimpleFunction('getAppliedFilters', array($this, 'getAppliedFilters'));
        $functions[] = new \Twig_SimpleFunction(
            'renderAppliedFilters', array($this, 'renderAplliedFilters'), array('is_safe' => array('html'))
        );
        $functions[] = new \Twig_SimpleFunction('hasErrors', array($this, 'hasErrors'));        

        return $functions;
    }
    
    /**
     * Indica si el formulario esta filtrado o no
     *
     * @param FormView $form Objeto FormView.
     *
     * @return bool
     */
    public function isFiltered(FormView $form)
    {
        $data = $form->vars['data'];
        $this->filtered = false;
        $this->_doIsFiltered($data);
        return $this->filtered;
    }

    /**
     * Método recursivo utilizado para detectar si el formulario esta filtrado
     *
     * @param mixed $data Data
     *
     * @return void
     */
    private function _doIsFiltered($data)
    {
        if (!$this->_isEmptyValue($data)) {
            if (is_array($data)) {
                foreach ($data as $v) {
                    $this->_doIsFiltered($v);
                    if ($this->filtered) {
                        return;
                    }
                }
            } else {
                $isFiltered = !($data instanceof Collection) || $data->count()>0;
                $this->filtered = $isFiltered;
                return;
            }
        }
    }

    /**
     * Test if $data is an empty value.
     *
     * @param mixed $data Data
     *
     * @return bool
     */
    private function _isEmptyValue($data)
    {
        $inEmptyValues = false;

        foreach ($this->emptyValues as $ev) {
            if ($data === $ev) {
                $inEmptyValues = true;
                break;
            }
        }
        return $inEmptyValues;
    }

    /**
     * Devuelve un array con los filtros aplicados y sus valores.
     *
     * @param FormView $form Objeto FormView
     *
     * @return array
     */
    public function getAppliedFilters(FormView $form)
    {
        $data = $form->vars['data'];
        $this->filtered = false;
        $this->_doIsFiltered($data);

        $this->appliedFilters = array();
        if ($this->filtered) {
            $this->_doGetAppliedFilters($form, $this->appliedFilters);
            return isset($this->appliedFilters[ucfirst($form->vars['name'])])
                ? $this->appliedFilters[ucfirst($form->vars['name'])]
                : array();
        }

        return $this->appliedFilters;
    }

    /**
     * Método privado recursivo utilizado para detectar si el formulario esta filtrado
     *
     * @param FormView $form Objecto FormView.
     * @param array    &$res Array resultado
     *
     * @return void
     */
    private function _doGetAppliedFilters(FormView $form, array &$res)
    {
        $label = empty($form->vars['label']) ? ucfirst($form->vars['name']) : $form->vars['label'];
        $isMultipleChoice = $this->_isWidget($form, 'choice') && $form->vars['multiple'];
        $isExpandedChoice = $this->_isWidget($form, 'choice') && $form->vars['expanded'];
        if ($form->count()>0 && !$isMultipleChoice && !$isExpandedChoice) {
            $res[$label] = array();
            foreach ($form->children as $c) {
                $this->_doGetAppliedFilters($c, $res[$label]);
            }
            if (count($res[$label]) === 0) {
                unset($res[$label]);
            }
        } else {
            $data = $this->_getCleanData($form);
            $isAddable = $label !== '_token' && !$this->_isEmptyValue($data);
            if ($isAddable && ($data instanceof Collection && $data->count() === 0)) {
                $isAddable = false;
            }
            if ($isAddable) {
                $res[$label] = $data;
            }
        }
    }

    /**
     * Returns clean data
     *
     * @param FormView $form Form View
     *
     * @return mixed
     */
    private function _getCleanData(FormView $form)
    {
        $data = $form->vars['data'];

        //checkbox
        if ($this->_isWidget($form, 'checkbox')) {
            if ($data === false) {
                $data = null;
            }
        }

        //choice
        if ($this->_isWidget($form, 'choice')) {
            $choices = isset($form->vars['choices']) ? $form->vars['choices'] : array();
            $value = $form->vars['value'];
            //$isMultiple = isset($form->vars['multiple']) && $form->vars['multiple'] === true;
            $isExpanded = isset($form->vars['expanded']) && $form->vars['expanded'] === true;

            if (count($choices) > 0) {
                if (!is_array($value)) {
                    $value = array($value);
                }
                if ($isExpanded) {
                    $data = $this->_handleChoiceExpanded($choices, $value);
                } else {
                    $data = $this->_handleChoiceNotExpanded($choices, $value);
                }

                if (is_array($data) && count($data) === 1) {
                    $data = implode($data);
                }
            }
        }

        if ($this->_isWidget($form, 'entity_hidden')) {
            $data = $form->vars['entity'];
        }

        return $data;
    }

    /**
     * Cleans not expanded choice data.
     *
     * @param array $choices Choices
     * @param array $value   Value
     *
     * @return array|null
     */
    private function _handleChoiceNotExpanded(array $choices, array $value)
    {
        $data = null;
        if (count($value) > 0) {
            $data = array();
            foreach ($choices as $cv) {
                if (is_array($cv)) {
                    foreach ($cv as $v) {
                        if (in_array($v->value, $value)) {
                            $data[] = $v->label;
                        }
                    }
                } else {
                    if (in_array($cv->value, $value)) {
                        $data[] = $cv->label;
                    }
                }
            }
            if (count($data) === 0) {
                $data = null;
            }
        }

        return $data;
    }

    /**
     * Cleans expanded choice data.
     *
     * @param array $choices Choices
     * @param array $value   Value
     *
     * @return array|null
     */
    private function _handleChoiceExpanded(array $choices,array $value)
    {
        $data = null;

        $hasSelectedValues = false;
        foreach ($value as $v) {
            if ($v) {
                $hasSelectedValues = true;
                break;
            }
        }

        if ($hasSelectedValues) {
            $data = array();
            foreach ($value as $k => $v) {
                if ($v) {
                    $data[] = $choices[$k]->label;
                }
            }
            if (count($data) === 0) {
                $data = null;
            }
        }

        return $data;
    }

    /**
     * checks if is a kind of widget
     *
     * @param FormView $form   Form view
     * @param string   $widget string representing the widget to test
     *
     * @return bool
     */
    private function _isWidget(FormView $form, $widget)
    {
        return in_array($widget, $form->vars['block_prefixes']);
    }

    /**
     * Renderiza los filtros aplicados utizando uls y lis.
     *
     * @param FormView $form    Objeto FormView
     * @param array    $options Render Options.
     *
     * @return string
     */
    public function renderAplliedFilters(FormView $form, array $options = array())
    {
        $this->tmpRenderOpts = array_merge($this->renderOptions, $options);

        $appliedFilters = $this->getAppliedFilters($form);
        $output = $this->_doRenderAplliedFilters($appliedFilters);

        $this->tmpRenderOpts = array();

        return $output;
    }

    /**
     * Método privado recursivo utilizado para renderizar los filtros aplicados.
     *
     * @param mixed $data Data
     *
     * @return string
     */
    private function _doRenderAplliedFilters($data, $addUl = true)
    {
        $output = ' ';
        if (is_array($data)) {
            if (count($data) > 0) {
                $output .= $addUl ? '<ul>' : '';
                foreach ($data as $k => $v) {
                    $label = is_numeric($k) && is_int($k) ? '' : $k . ($v === true ? '' : ': ');

                    if (empty($label)) {
                        $output .= $this->_doRenderAplliedFilters($v, false);
                    } else {
                        $output .= '<li>'
                            . $label
                            . $this->_doRenderAplliedFilters($v)
                            . '</li>';
                    }
                }
                $output .= $addUl ? '</ul>' : '';
            }
        } else {
            if ($data instanceof Collection) {
                foreach ($data as $k => $v) {
                    $output .= $v->__toString();
                    if ($k < $data->count()-1) {
                        $output .= ', ';
                    }
                }
            } else {
                if ($data instanceof \DateTime) {
                    $output .= '"' . $data->format($this->tmpRenderOpts['date_format']) . '"';
                } else {
                    if ($data === true) {
                        $output = '';
                    } elseif ($data === false) {

                    } else {
                        $output .= '"' . $data . '"';
                    }
                }
            }
        }
        return $output;
    }

    /**
     * checks if form has errors
     *
     * @param FormView $form Form View
     *
     * @return bool
     */
    public function hasErrors(FormView $form)
    {
        $this->hasErrors = false;
        $this->_doHasErrors($form);
        return $this->hasErrors;
    }

    /**
     * Recursive method for has errors
     *
     * @param FormView $form Form View
     *
     * @return void
     */
    private function _doHasErrors(FormView $form)
    {
        $this->hasErrors = isset($form->vars['errors']) &&
            //($form->vars['errors'] instanceof Symfony\Component\Form\FormErrorIterator) &&
            $form->vars['errors']->count() > 0;

        if (!$this->hasErrors) {
            foreach ($form->children as $c) {
                $this->_doHasErrors($c);
                if ($this->hasErrors) {
                    return;
                }
            }
        }
    }
    
    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return 'filters_extension';
    }
}