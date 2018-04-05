<?php

/* default/index.html.twig */
class __TwigTemplate_29c60b4c7e23a03fb3d3e1b6c9b6fd4ff767986004e58303417363a9862d49e0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "default/index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_242e132cd8dcc8b5244826ddaa1fb547d8e9741074d90798bf0a4470cfded5a6 = $this->env->getExtension("native_profiler");
        $__internal_242e132cd8dcc8b5244826ddaa1fb547d8e9741074d90798bf0a4470cfded5a6->enter($__internal_242e132cd8dcc8b5244826ddaa1fb547d8e9741074d90798bf0a4470cfded5a6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_242e132cd8dcc8b5244826ddaa1fb547d8e9741074d90798bf0a4470cfded5a6->leave($__internal_242e132cd8dcc8b5244826ddaa1fb547d8e9741074d90798bf0a4470cfded5a6_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_3afcba1f14d3e89117dec7c80bfb34afe4b4274370927ba0e42615e68f7fee9b = $this->env->getExtension("native_profiler");
        $__internal_3afcba1f14d3e89117dec7c80bfb34afe4b4274370927ba0e42615e68f7fee9b->enter($__internal_3afcba1f14d3e89117dec7c80bfb34afe4b4274370927ba0e42615e68f7fee9b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "\t";
        $context["nombrePremio"] = (((array_key_exists("premioActual", $context) && (isset($context["premioActual"]) ? $context["premioActual"] : $this->getContext($context, "premioActual")))) ? ($this->getAttribute((isset($context["premioActual"]) ? $context["premioActual"] : $this->getContext($context, "premioActual")), "__toString", array(), "method")) : ("Premio Provincial a la Calidad"));
        // line 5
        echo "\t";
        $context["esPeriodoInscripcion"] = ((array_key_exists("premioActual", $context) && (isset($context["premioActual"]) ? $context["premioActual"] : $this->getContext($context, "premioActual"))) && $this->getAttribute((isset($context["premioActual"]) ? $context["premioActual"] : $this->getContext($context, "premioActual")), "esPeriodoDeInscripcion", array(), "method"));
        // line 6
        echo "\t";
        // line 9
        echo "\t";
        if ( !(isset($context["esPeriodoInscripcion"]) ? $context["esPeriodoInscripcion"] : $this->getContext($context, "esPeriodoInscripcion"))) {
            // line 10
            echo "\t\t<h1 class=\"text-center\" style=\"color: #024e83;\">
\t\t\t<strong><em>";
            // line 11
            echo twig_escape_filter($this->env, (isset($context["nombrePremio"]) ? $context["nombrePremio"] : $this->getContext($context, "nombrePremio")), "html", null, true);
            echo "</em></strong>
\t\t</h1>
\t";
        }
        // line 14
        echo "    <div class=\"container\">
        <div class=\"row\">
\t\t\t<div class=\"";
        // line 16
        echo (((isset($context["esPeriodoInscripcion"]) ? $context["esPeriodoInscripcion"] : $this->getContext($context, "esPeriodoInscripcion"))) ? ("col-sm-4") : ("col-sm-12"));
        echo " text-center\">
\t\t\t\t<img class=\"main-logo\" src=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("images/home-logo-premio-calidad.png"), "html", null, true);
        echo "\" alt=\"Logo del Premio Provincial a la calidad.\">
\t\t\t</div>
\t\t\t";
        // line 19
        if ((isset($context["esPeriodoInscripcion"]) ? $context["esPeriodoInscripcion"] : $this->getContext($context, "esPeriodoInscripcion"))) {
            // line 20
            echo "\t\t\t<div class=\"col-sm-8 text-center\">
\t\t\t\t<h1 class=\"text-center\" style=\"color: #024e83;\">
\t\t\t\t\t<strong><em>";
            // line 22
            echo twig_escape_filter($this->env, (isset($context["nombrePremio"]) ? $context["nombrePremio"] : $this->getContext($context, "nombrePremio")), "html", null, true);
            echo "</em></strong>
\t\t\t\t</h1>
\t\t\t\t<br>
\t\t\t\t<br>

\t\t\t\t<ul class=\"nav nav-pills nav-stacked\" style=\"letter-spacing: 1px;\">
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"";
            // line 29
            echo $this->env->getExtension('routing')->getPath("organizacionpublica_new");
            echo "\">
\t\t\t\t\t\t\t<strong>FORMULARIO DE INSCRIPCIÓN PARA ORGANIZACIONES PÚBLICAS</strong>
\t\t\t\t\t\t</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"";
            // line 34
            echo $this->env->getExtension('routing')->getPath("organizacionprivada_new");
            echo "\">
\t\t\t\t\t\t\t<strong>FORMULARIO DE INSCRIPCIÓN PARA ORGANIZACIONES PRIVADAS</strong>
\t\t\t\t\t\t</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"";
            // line 39
            echo $this->env->getExtension('routing')->getPath("evaluador_new");
            echo "\">
\t\t\t\t\t\t\t<strong>FORMULARIO DE REGISTRO PARA EVALUADORES</strong>
\t\t\t\t\t\t</a>
\t\t\t\t\t</li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t";
        }
        // line 46
        echo "        </div>
    </div>
";
        
        $__internal_3afcba1f14d3e89117dec7c80bfb34afe4b4274370927ba0e42615e68f7fee9b->leave($__internal_3afcba1f14d3e89117dec7c80bfb34afe4b4274370927ba0e42615e68f7fee9b_prof);

    }

    public function getTemplateName()
    {
        return "default/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 46,  105 => 39,  97 => 34,  89 => 29,  79 => 22,  75 => 20,  73 => 19,  68 => 17,  64 => 16,  60 => 14,  54 => 11,  51 => 10,  48 => 9,  46 => 6,  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'base.html.twig' %}*/
/* */
/* {% block body %}*/
/* 	{% set nombrePremio = premioActual is defined and premioActual ? premioActual.__toString() : 'Premio Provincial a la Calidad' %}*/
/* 	{% set esPeriodoInscripcion = premioActual is defined and premioActual and premioActual.esPeriodoDeInscripcion() %}*/
/* 	{# <h1 class="text-center" style="color: #024e83;">*/
/* 		<strong><em>{{ nombrePremio }}</em></strong>*/
/* 	</h1> #}*/
/* 	{% if not esPeriodoInscripcion %}*/
/* 		<h1 class="text-center" style="color: #024e83;">*/
/* 			<strong><em>{{ nombrePremio }}</em></strong>*/
/* 		</h1>*/
/* 	{% endif %}*/
/*     <div class="container">*/
/*         <div class="row">*/
/* 			<div class="{{ esPeriodoInscripcion ? 'col-sm-4' : 'col-sm-12' }} text-center">*/
/* 				<img class="main-logo" src="{{ asset('images/home-logo-premio-calidad.png') }}" alt="Logo del Premio Provincial a la calidad.">*/
/* 			</div>*/
/* 			{% if esPeriodoInscripcion %}*/
/* 			<div class="col-sm-8 text-center">*/
/* 				<h1 class="text-center" style="color: #024e83;">*/
/* 					<strong><em>{{ nombrePremio }}</em></strong>*/
/* 				</h1>*/
/* 				<br>*/
/* 				<br>*/
/* */
/* 				<ul class="nav nav-pills nav-stacked" style="letter-spacing: 1px;">*/
/* 					<li>*/
/* 						<a href="{{ path('organizacionpublica_new') }}">*/
/* 							<strong>FORMULARIO DE INSCRIPCIÓN PARA ORGANIZACIONES PÚBLICAS</strong>*/
/* 						</a>*/
/* 					</li>*/
/* 					<li>*/
/* 						<a href="{{ path('organizacionprivada_new') }}">*/
/* 							<strong>FORMULARIO DE INSCRIPCIÓN PARA ORGANIZACIONES PRIVADAS</strong>*/
/* 						</a>*/
/* 					</li>*/
/* 					<li>*/
/* 						<a href="{{ path('evaluador_new')}}">*/
/* 							<strong>FORMULARIO DE REGISTRO PARA EVALUADORES</strong>*/
/* 						</a>*/
/* 					</li>*/
/* 				</ul>*/
/* 			</div>*/
/* 			{% endif %}*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* */
