<?php

/* menu.html.twig */
class __TwigTemplate_ef3f0166d24cd8a4cec6f6ad1c7f455b87425ae410f259d5de7c6aeab8e8a9e6 extends Twig_Template
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
        $__internal_94349d29e75953ce09b62b2031952e8ab31c38347c74f65d04ca45b95e38a992 = $this->env->getExtension("native_profiler");
        $__internal_94349d29e75953ce09b62b2031952e8ab31c38347c74f65d04ca45b95e38a992->enter($__internal_94349d29e75953ce09b62b2031952e8ab31c38347c74f65d04ca45b95e38a992_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "menu.html.twig"));

        // line 1
        echo "<nav class=\"navbar navbar-default\">
  <div class=\"container\">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class=\"navbar-header\">
      <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </button>
      <a class=\"navbar-brand visible-xs-inline-block\" href=\"#\">
        <img src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("images/logo-premio-movil.png"), "html", null, true);
        echo "\" class=\"logo-movil\">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
      <ul class=\"nav navbar-nav\">
        <li><a href=\"";
        // line 19
        echo $this->env->getExtension('routing')->getPath("homepage");
        echo "\"><i class=\"fa fa-home\"></i> Inicio</a></li>
        ";
        // line 34
        echo "      </ul>
      ";
        // line 41
        echo "      <ul class=\"nav navbar-nav navbar-right\">
        ";
        // line 42
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array())) {
            // line 43
            echo "          ";
            if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
                // line 44
                echo "            <li class=\"dropdown\">
              <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class=\"fa fa-cogs\"></i> Administración <span class=\"caret\"></span></a>
              <ul class=\"dropdown-menu\">
                <li><a href=\"";
                // line 47
                echo $this->env->getExtension('routing')->getPath("adminpremio_index");
                echo "\">Adm. Premio</a></li>
                ";
                // line 52
                echo "                <li role=\"separator\" class=\"divider\"></li>
                <li><a href=\"";
                // line 53
                echo $this->env->getExtension('routing')->getPath("admin_premio_index");
                echo "\">Premios</a></li>
                <li><a href=\"";
                // line 54
                echo $this->env->getExtension('routing')->getPath("evaluador_index");
                echo "\">Evaluadores</a></li>
                <li><a href=\"";
                // line 55
                echo $this->env->getExtension('routing')->getPath("admin_formularioevaluacion_index");
                echo "\">Formularios de Evaluación</a></li>
                <li role=\"separator\" class=\"divider\"></li>
                <li><a href=\"";
                // line 57
                echo $this->env->getExtension('routing')->getPath("admin_titulouniversitario_index");
                echo "\">Títulos Universitarios</a></li>
                <li role=\"separator\" class=\"divider\"></li>
                <li><a href=\"";
                // line 59
                echo $this->env->getExtension('routing')->getPath("admin_localidad_index");
                echo "\">Localidades</a></li>
                <li><a href=\"";
                // line 60
                echo $this->env->getExtension('routing')->getPath("admin_provincia_index");
                echo "\">Provincias</a></li>
                <li role=\"separator\" class=\"divider\"></li>
                <li><a href=\"";
                // line 62
                echo $this->env->getExtension('routing')->getPath("admin_idioma_index");
                echo "\">Idiomas</a></li>
              </ul>
            </li>    
          ";
            }
            // line 66
            echo "            <li class=\"dropdown\">
              <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">
                <i class=\"fa fa-user\"></i>
              ";
            // line 69
            if (($this->env->getExtension('security')->isGranted("ROLE_EVALUADOR") && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "evaluador", array()))) {
                // line 70
                echo "                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "evaluador", array()), "apellido", array()), "html", null, true);
                echo ", ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "evaluador", array()), "nombre", array()), "html", null, true);
                echo "
              ";
            } else {
                // line 72
                echo "                ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "username", array()), "html", null, true);
                echo "
              ";
            }
            // line 74
            echo "                <span class=\"caret\"></span>
              </a>
              <ul class=\"dropdown-menu\">
              ";
            // line 77
            if (($this->env->getExtension('security')->isGranted("ROLE_EVALUADOR") && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "evaluador", array()))) {
                // line 78
                echo "                  <li><a href=\"";
                echo $this->env->getExtension('routing')->getPath("evaluador_panel");
                echo "\">Panel</a></li>
                  <li role=\"separator\" class=\"divider\"></li>
                  <li><a href=\"";
                // line 80
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("evaluador_show", array("id" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "evaluador", array()), "id", array()))), "html", null, true);
                echo "\">Mis Datos</a></li>
              ";
            }
            // line 82
            echo "                <li><a href=\"";
            echo $this->env->getExtension('routing')->getPath("fos_user_profile_show");
            echo "\">Perfil</a></li>
                <li role=\"separator\" class=\"divider\"></li>
                <li><a href=\"";
            // line 84
            echo $this->env->getExtension('routing')->getPath("fos_user_security_logout");
            echo "\"><i class=\"fa fa-sign-out\"></i> Salir</a></li>
              </ul>
            </li>
        ";
        } else {
            // line 88
            echo "          <li><a href=\"";
            echo $this->env->getExtension('routing')->getPath("fos_user_security_login");
            echo "\"><i class=\"fa fa-sign-in\"></i> Entrar</a></li>
        ";
        }
        // line 90
        echo "      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
";
        
        $__internal_94349d29e75953ce09b62b2031952e8ab31c38347c74f65d04ca45b95e38a992->leave($__internal_94349d29e75953ce09b62b2031952e8ab31c38347c74f65d04ca45b95e38a992_prof);

    }

    public function getTemplateName()
    {
        return "menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 90,  158 => 88,  151 => 84,  145 => 82,  140 => 80,  134 => 78,  132 => 77,  127 => 74,  121 => 72,  113 => 70,  111 => 69,  106 => 66,  99 => 62,  94 => 60,  90 => 59,  85 => 57,  80 => 55,  76 => 54,  72 => 53,  69 => 52,  65 => 47,  60 => 44,  57 => 43,  55 => 42,  52 => 41,  49 => 34,  45 => 19,  35 => 12,  22 => 1,);
    }
}
/* <nav class="navbar navbar-default">*/
/*   <div class="container">*/
/*     <!-- Brand and toggle get grouped for better mobile display -->*/
/*     <div class="navbar-header">*/
/*       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">*/
/*         <span class="sr-only">Toggle navigation</span>*/
/*         <span class="icon-bar"></span>*/
/*         <span class="icon-bar"></span>*/
/*         <span class="icon-bar"></span>*/
/*       </button>*/
/*       <a class="navbar-brand visible-xs-inline-block" href="#">*/
/*         <img src="{{ asset('images/logo-premio-movil.png') }}" class="logo-movil">*/
/*       </a>*/
/*     </div>*/
/* */
/*     <!-- Collect the nav links, forms, and other content for toggling -->*/
/*     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">*/
/*       <ul class="nav navbar-nav">*/
/*         <li><a href="{{ path('homepage') }}"><i class="fa fa-home"></i> Inicio</a></li>*/
/*         {#<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>*/
/*         <li><a href="#">Link</a></li>*/
/*         <li class="dropdown">*/
/*           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>*/
/*           <ul class="dropdown-menu">*/
/*             <li><a href="#">Action</a></li>*/
/*             <li><a href="#">Another action</a></li>*/
/*             <li><a href="#">Something else here</a></li>*/
/*             <li role="separator" class="divider"></li>*/
/*             <li><a href="#">Separated link</a></li>*/
/*             <li role="separator" class="divider"></li>*/
/*             <li><a href="#">One more separated link</a></li>*/
/*           </ul>*/
/*         </li>#}*/
/*       </ul>*/
/*       {# <form class="navbar-form navbar-left" role="search">*/
/*         <div class="form-group">*/
/*           <input type="text" class="form-control" placeholder="Search">*/
/*         </div>*/
/*         <button type="submit" class="btn btn-default">Submit</button>*/
/*       </form> #}*/
/*       <ul class="nav navbar-nav navbar-right">*/
/*         {% if app.user %}*/
/*           {% if is_granted('ROLE_ADMIN') %}*/
/*             <li class="dropdown">*/
/*               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i> Administración <span class="caret"></span></a>*/
/*               <ul class="dropdown-menu">*/
/*                 <li><a href="{{ path('adminpremio_index') }}">Adm. Premio</a></li>*/
/*                 {# <li role="separator" class="divider"></li>*/
/*                 <li><a href="{{ path('evaluador_index') }}">Evaluadores</a></li>*/
/*                 <li><a href="{{ path('organizacionpublica_index') }}">Inscripción de Organizaciones Públicas</a></li>*/
/*                 <li><a href="{{ path('organizacionprivada_index') }}">Inscripción de Empresas Privadas</a></li> #}*/
/*                 <li role="separator" class="divider"></li>*/
/*                 <li><a href="{{ path('admin_premio_index') }}">Premios</a></li>*/
/*                 <li><a href="{{ path('evaluador_index') }}">Evaluadores</a></li>*/
/*                 <li><a href="{{ path('admin_formularioevaluacion_index') }}">Formularios de Evaluación</a></li>*/
/*                 <li role="separator" class="divider"></li>*/
/*                 <li><a href="{{ path('admin_titulouniversitario_index') }}">Títulos Universitarios</a></li>*/
/*                 <li role="separator" class="divider"></li>*/
/*                 <li><a href="{{ path('admin_localidad_index') }}">Localidades</a></li>*/
/*                 <li><a href="{{ path('admin_provincia_index') }}">Provincias</a></li>*/
/*                 <li role="separator" class="divider"></li>*/
/*                 <li><a href="{{ path('admin_idioma_index') }}">Idiomas</a></li>*/
/*               </ul>*/
/*             </li>    */
/*           {% endif %}*/
/*             <li class="dropdown">*/
/*               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">*/
/*                 <i class="fa fa-user"></i>*/
/*               {% if is_granted('ROLE_EVALUADOR') and app.user.evaluador %}*/
/*                 {{  app.user.evaluador.apellido }}, {{  app.user.evaluador.nombre }}*/
/*               {% else %}*/
/*                 {{ app.user.username }}*/
/*               {% endif %}*/
/*                 <span class="caret"></span>*/
/*               </a>*/
/*               <ul class="dropdown-menu">*/
/*               {% if is_granted('ROLE_EVALUADOR') and app.user.evaluador %}*/
/*                   <li><a href="{{ path('evaluador_panel') }}">Panel</a></li>*/
/*                   <li role="separator" class="divider"></li>*/
/*                   <li><a href="{{ path ('evaluador_show', { 'id': app.user.evaluador.id }) }}">Mis Datos</a></li>*/
/*               {% endif %}*/
/*                 <li><a href="{{ path('fos_user_profile_show') }}">Perfil</a></li>*/
/*                 <li role="separator" class="divider"></li>*/
/*                 <li><a href="{{ path('fos_user_security_logout') }}"><i class="fa fa-sign-out"></i> Salir</a></li>*/
/*               </ul>*/
/*             </li>*/
/*         {% else %}*/
/*           <li><a href="{{ path('fos_user_security_login') }}"><i class="fa fa-sign-in"></i> Entrar</a></li>*/
/*         {% endif %}*/
/*       </ul>*/
/*     </div><!-- /.navbar-collapse -->*/
/*   </div><!-- /.container-fluid -->*/
/* </nav>*/
/* */
