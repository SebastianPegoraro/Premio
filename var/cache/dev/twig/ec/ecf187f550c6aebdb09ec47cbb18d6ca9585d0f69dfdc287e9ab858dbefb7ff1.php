<?php

/* header.html.twig */
class __TwigTemplate_63a5d29c38e422f16471cde66b983924a4f2964b1c436a7e18cb158d884e27a6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_0cd54104f8ce192e702f60c5603ab0191200da8e0de7cb01e3d0436ffc06e06f = $this->env->getExtension("native_profiler");
        $__internal_0cd54104f8ce192e702f60c5603ab0191200da8e0de7cb01e3d0436ffc06e06f->enter($__internal_0cd54104f8ce192e702f60c5603ab0191200da8e0de7cb01e3d0436ffc06e06f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "header.html.twig"));

        // line 1
        echo "<header>
    <div id=\"header-presentation\" class=\"container hidden-xs\">
        <div class=\"row\">
            <div class=\"col-xs-6 text-left\">
                <img class=\"logo-premio\" src=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("images/logo-premio-calidad.png"), "html", null, true);
        echo "\" alt=\"Logo Premio Provincial a la calidad\">
            </div>
            <div class=\"col-xs-6 text-right\">
                <img class=\"logo-gob-header\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("images/logo-chacogob.png"), "html", null, true);
        echo "\" alt=\"Logo de Gobierno del Chaco\">
            </div>
        </div>
    </div>
    ";
        // line 12
        $this->loadTemplate("menu.html.twig", "header.html.twig", 12)->display($context);
        // line 13
        echo "</header>";
        
        $__internal_0cd54104f8ce192e702f60c5603ab0191200da8e0de7cb01e3d0436ffc06e06f->leave($__internal_0cd54104f8ce192e702f60c5603ab0191200da8e0de7cb01e3d0436ffc06e06f_prof);

    }

    public function getTemplateName()
    {
        return "header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 13,  41 => 12,  34 => 8,  28 => 5,  22 => 1,);
    }
}
/* <header>*/
/*     <div id="header-presentation" class="container hidden-xs">*/
/*         <div class="row">*/
/*             <div class="col-xs-6 text-left">*/
/*                 <img class="logo-premio" src="{{ asset('images/logo-premio-calidad.png') }}" alt="Logo Premio Provincial a la calidad">*/
/*             </div>*/
/*             <div class="col-xs-6 text-right">*/
/*                 <img class="logo-gob-header" src="{{ asset('images/logo-chacogob.png') }}" alt="Logo de Gobierno del Chaco">*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     {% include 'menu.html.twig' %}*/
/* </header>*/
