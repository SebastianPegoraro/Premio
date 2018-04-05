<?php

/* header.html.twig */
class __TwigTemplate_092c378f547550e3fe9b669b76f1891e189646d6466fd0d9fcc79b0439515b73 extends Twig_Template
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
        $__internal_627287e88064394428a63bb7831d63756804eb7a061361e7197c1cbfce08a2b4 = $this->env->getExtension("native_profiler");
        $__internal_627287e88064394428a63bb7831d63756804eb7a061361e7197c1cbfce08a2b4->enter($__internal_627287e88064394428a63bb7831d63756804eb7a061361e7197c1cbfce08a2b4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "header.html.twig"));

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
        
        $__internal_627287e88064394428a63bb7831d63756804eb7a061361e7197c1cbfce08a2b4->leave($__internal_627287e88064394428a63bb7831d63756804eb7a061361e7197c1cbfce08a2b4_prof);

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
