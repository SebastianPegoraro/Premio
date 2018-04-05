<?php

/* FOSUserBundle:Profile:show.html.twig */
class __TwigTemplate_c290cf47f18b16726dc3b3bd1522a7447a76a4e65fc3e90d959902f70a51c79e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Profile:show.html.twig", 1);
        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "FOSUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f71dccbd536aa0eb130516984489544d5be83e8186fad6648212b0190704206a = $this->env->getExtension("native_profiler");
        $__internal_f71dccbd536aa0eb130516984489544d5be83e8186fad6648212b0190704206a->enter($__internal_f71dccbd536aa0eb130516984489544d5be83e8186fad6648212b0190704206a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Profile:show.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f71dccbd536aa0eb130516984489544d5be83e8186fad6648212b0190704206a->leave($__internal_f71dccbd536aa0eb130516984489544d5be83e8186fad6648212b0190704206a_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_54456c0380da99c287af0d8ce7f011dde5182de20df79683e60f7e2acc79044b = $this->env->getExtension("native_profiler");
        $__internal_54456c0380da99c287af0d8ce7f011dde5182de20df79683e60f7e2acc79044b->enter($__internal_54456c0380da99c287af0d8ce7f011dde5182de20df79683e60f7e2acc79044b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Profile:show_content.html.twig", "FOSUserBundle:Profile:show.html.twig", 4)->display($context);
        
        $__internal_54456c0380da99c287af0d8ce7f011dde5182de20df79683e60f7e2acc79044b->leave($__internal_54456c0380da99c287af0d8ce7f011dde5182de20df79683e60f7e2acc79044b_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Profile:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% block fos_user_content %}*/
/* {% include "FOSUserBundle:Profile:show_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
