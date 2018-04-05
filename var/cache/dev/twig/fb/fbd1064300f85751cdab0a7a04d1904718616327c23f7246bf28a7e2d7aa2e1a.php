<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_91c9a336beb50c3bba0d7159d427782a706def2123841f59c6b8e0a081f5d322 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_91d39dcae324ff103e825eb76eabd9cc0fd6c2f4355065a7c85bb28dc177a519 = $this->env->getExtension("native_profiler");
        $__internal_91d39dcae324ff103e825eb76eabd9cc0fd6c2f4355065a7c85bb28dc177a519->enter($__internal_91d39dcae324ff103e825eb76eabd9cc0fd6c2f4355065a7c85bb28dc177a519_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_91d39dcae324ff103e825eb76eabd9cc0fd6c2f4355065a7c85bb28dc177a519->leave($__internal_91d39dcae324ff103e825eb76eabd9cc0fd6c2f4355065a7c85bb28dc177a519_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_697ce905f03b95a33cb22585d21fe465badeebeaccc5165f1a649c8ae0085c42 = $this->env->getExtension("native_profiler");
        $__internal_697ce905f03b95a33cb22585d21fe465badeebeaccc5165f1a649c8ae0085c42->enter($__internal_697ce905f03b95a33cb22585d21fe465badeebeaccc5165f1a649c8ae0085c42_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_697ce905f03b95a33cb22585d21fe465badeebeaccc5165f1a649c8ae0085c42->leave($__internal_697ce905f03b95a33cb22585d21fe465badeebeaccc5165f1a649c8ae0085c42_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_31c714d9046913b3c93c39b6bad9286c23b7977dc619cd29372349018ba47323 = $this->env->getExtension("native_profiler");
        $__internal_31c714d9046913b3c93c39b6bad9286c23b7977dc619cd29372349018ba47323->enter($__internal_31c714d9046913b3c93c39b6bad9286c23b7977dc619cd29372349018ba47323_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_31c714d9046913b3c93c39b6bad9286c23b7977dc619cd29372349018ba47323->leave($__internal_31c714d9046913b3c93c39b6bad9286c23b7977dc619cd29372349018ba47323_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_5c0fb3a714ad71cd3fb552bc26406a28fa712949dd5e628860a5450a62cd6068 = $this->env->getExtension("native_profiler");
        $__internal_5c0fb3a714ad71cd3fb552bc26406a28fa712949dd5e628860a5450a62cd6068->enter($__internal_5c0fb3a714ad71cd3fb552bc26406a28fa712949dd5e628860a5450a62cd6068_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_5c0fb3a714ad71cd3fb552bc26406a28fa712949dd5e628860a5450a62cd6068->leave($__internal_5c0fb3a714ad71cd3fb552bc26406a28fa712949dd5e628860a5450a62cd6068_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include '@Twig/Exception/exception.html.twig' %}*/
/* {% endblock %}*/
/* */
