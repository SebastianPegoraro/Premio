<?php

/* base.html.twig */
class __TwigTemplate_05ed908f608c28be59c30d690b9d2128e044f0977f7dd76faa3bd7596a10386a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'page_stylesheets' => array($this, 'block_page_stylesheets'),
            'flashes' => array($this, 'block_flashes'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
            'page_javascripts' => array($this, 'block_page_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_25e7fbcfb2376ed8cbc9ab43dd2632e0ac79709b9212a5678c311780c105aa29 = $this->env->getExtension("native_profiler");
        $__internal_25e7fbcfb2376ed8cbc9ab43dd2632e0ac79709b9212a5678c311780c105aa29->enter($__internal_25e7fbcfb2376ed8cbc9ab43dd2632e0ac79709b9212a5678c311780c105aa29_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    ";
        // line 8
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 16
        echo "    ";
        $this->displayBlock('page_stylesheets', $context, $blocks);
        // line 17
        echo "    <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
      <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->
  </head>
  <body>
    ";
        // line 27
        $this->loadTemplate("header.html.twig", "base.html.twig", 27)->display($context);
        // line 28
        echo "
    <div id=\"main\">
        ";
        // line 30
        $this->displayBlock('flashes', $context, $blocks);
        // line 43
        echo " 

        ";
        // line 45
        $this->displayBlock('body', $context, $blocks);
        // line 46
        echo "    </div>

    ";
        // line 48
        $this->loadTemplate("footer.html.twig", "base.html.twig", 48)->display($context);
        // line 49
        echo "
    ";
        // line 50
        $this->displayBlock('javascripts', $context, $blocks);
        // line 66
        echo "    ";
        $this->displayBlock('page_javascripts', $context, $blocks);
        // line 67
        echo "  </body>
</html>";
        
        $__internal_25e7fbcfb2376ed8cbc9ab43dd2632e0ac79709b9212a5678c311780c105aa29->leave($__internal_25e7fbcfb2376ed8cbc9ab43dd2632e0ac79709b9212a5678c311780c105aa29_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_7d71fa45e9a61d328c8ec72cd85a1bba1d9c75eccd1402f208505c968d012a28 = $this->env->getExtension("native_profiler");
        $__internal_7d71fa45e9a61d328c8ec72cd85a1bba1d9c75eccd1402f208505c968d012a28->enter($__internal_7d71fa45e9a61d328c8ec72cd85a1bba1d9c75eccd1402f208505c968d012a28_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Premio Provincial a la calidad";
        
        $__internal_7d71fa45e9a61d328c8ec72cd85a1bba1d9c75eccd1402f208505c968d012a28->leave($__internal_7d71fa45e9a61d328c8ec72cd85a1bba1d9c75eccd1402f208505c968d012a28_prof);

    }

    // line 8
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_b62e6838a9d1b1d8d6bde45bc3896663493d7b89fab68bd8c7af0eef0560e4c7 = $this->env->getExtension("native_profiler");
        $__internal_b62e6838a9d1b1d8d6bde45bc3896663493d7b89fab68bd8c7af0eef0560e4c7->enter($__internal_b62e6838a9d1b1d8d6bde45bc3896663493d7b89fab68bd8c7af0eef0560e4c7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 9
        echo "        ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "538beaf_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_538beaf_0") : $this->env->getExtension('asset')->getAssetUrl("_controller/css/app.min_app_2.css");
            // line 13
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
        ";
        } else {
            // asset "538beaf"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_538beaf") : $this->env->getExtension('asset')->getAssetUrl("_controller/css/app.min.css");
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
        ";
        }
        unset($context["asset_url"]);
        // line 15
        echo "    ";
        
        $__internal_b62e6838a9d1b1d8d6bde45bc3896663493d7b89fab68bd8c7af0eef0560e4c7->leave($__internal_b62e6838a9d1b1d8d6bde45bc3896663493d7b89fab68bd8c7af0eef0560e4c7_prof);

    }

    // line 16
    public function block_page_stylesheets($context, array $blocks = array())
    {
        $__internal_f17a297f41577e55bddb60616685ed529b83d0723afdf5b47bdb0bedc2c13639 = $this->env->getExtension("native_profiler");
        $__internal_f17a297f41577e55bddb60616685ed529b83d0723afdf5b47bdb0bedc2c13639->enter($__internal_f17a297f41577e55bddb60616685ed529b83d0723afdf5b47bdb0bedc2c13639_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_stylesheets"));

        
        $__internal_f17a297f41577e55bddb60616685ed529b83d0723afdf5b47bdb0bedc2c13639->leave($__internal_f17a297f41577e55bddb60616685ed529b83d0723afdf5b47bdb0bedc2c13639_prof);

    }

    // line 30
    public function block_flashes($context, array $blocks = array())
    {
        $__internal_08cbe7bf9a4aa924e6bfe69625cf4288ca218f60ea8aead4445dc00e332190b4 = $this->env->getExtension("native_profiler");
        $__internal_08cbe7bf9a4aa924e6bfe69625cf4288ca218f60ea8aead4445dc00e332190b4->enter($__internal_08cbe7bf9a4aa924e6bfe69625cf4288ca218f60ea8aead4445dc00e332190b4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "flashes"));

        echo "                
            ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "all", array(), "method"));
        foreach ($context['_seq'] as $context["type"] => $context["flashMessages"]) {
            // line 32
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["flashMessages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
                // line 33
                echo "                    ";
                if (($context["type"] == "error")) {
                    // line 34
                    echo "                       ";
                    $context["type"] = "danger";
                    // line 35
                    echo "                    ";
                }
                // line 36
                echo "                    <div class=\"container\">
                        <div class=\"alert alert-";
                // line 37
                echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                echo "\" role=\"alert\">
                           ";
                // line 38
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["flashMessage"]), "html", null, true);
                echo "
                        </div>
                    </div>        
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['flashMessages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "        ";
        
        $__internal_08cbe7bf9a4aa924e6bfe69625cf4288ca218f60ea8aead4445dc00e332190b4->leave($__internal_08cbe7bf9a4aa924e6bfe69625cf4288ca218f60ea8aead4445dc00e332190b4_prof);

    }

    // line 45
    public function block_body($context, array $blocks = array())
    {
        $__internal_338fa4b6e7c7b28d2a423598bb1c7d52b636a044130de39b2ea3e356464588d9 = $this->env->getExtension("native_profiler");
        $__internal_338fa4b6e7c7b28d2a423598bb1c7d52b636a044130de39b2ea3e356464588d9->enter($__internal_338fa4b6e7c7b28d2a423598bb1c7d52b636a044130de39b2ea3e356464588d9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_338fa4b6e7c7b28d2a423598bb1c7d52b636a044130de39b2ea3e356464588d9->leave($__internal_338fa4b6e7c7b28d2a423598bb1c7d52b636a044130de39b2ea3e356464588d9_prof);

    }

    // line 50
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_f2e97cfa0881c428e77c2dbb675841bd71a36d448baba011ef27f5bd6aa90f84 = $this->env->getExtension("native_profiler");
        $__internal_f2e97cfa0881c428e77c2dbb675841bd71a36d448baba011ef27f5bd6aa90f84->enter($__internal_f2e97cfa0881c428e77c2dbb675841bd71a36d448baba011ef27f5bd6aa90f84_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 51
        echo "        ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "d94884e_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_0") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_jquery.min_1.js");
            // line 63
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "d94884e_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_1") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_moment-with-locales.min_2.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "d94884e_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_2") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_jquery.mousewheel.min_3.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "d94884e_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_3") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_bootstrap.min_4.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "d94884e_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_4") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_bootstrap-datetimepicker.min_5.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "d94884e_5"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_5") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_select2.min_6.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "d94884e_6"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_6") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_es_7.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "d94884e_7"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_7") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_fileinput.min_8.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "d94884e_8"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_8") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_es_9.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "d94884e_9"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e_9") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min_application_10.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
        } else {
            // asset "d94884e"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d94884e") : $this->env->getExtension('asset')->getAssetUrl("_controller/js/app.min.js");
            echo "            <script src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
        }
        unset($context["asset_url"]);
        // line 65
        echo "    ";
        
        $__internal_f2e97cfa0881c428e77c2dbb675841bd71a36d448baba011ef27f5bd6aa90f84->leave($__internal_f2e97cfa0881c428e77c2dbb675841bd71a36d448baba011ef27f5bd6aa90f84_prof);

    }

    // line 66
    public function block_page_javascripts($context, array $blocks = array())
    {
        $__internal_ba4324a7179608d5d8a02242e0d04a51ffd0f500908369ae2a2d2927ab13c047 = $this->env->getExtension("native_profiler");
        $__internal_ba4324a7179608d5d8a02242e0d04a51ffd0f500908369ae2a2d2927ab13c047->enter($__internal_ba4324a7179608d5d8a02242e0d04a51ffd0f500908369ae2a2d2927ab13c047_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_javascripts"));

        
        $__internal_ba4324a7179608d5d8a02242e0d04a51ffd0f500908369ae2a2d2927ab13c047->leave($__internal_ba4324a7179608d5d8a02242e0d04a51ffd0f500908369ae2a2d2927ab13c047_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  304 => 66,  297 => 65,  229 => 63,  224 => 51,  218 => 50,  207 => 45,  200 => 43,  194 => 42,  184 => 38,  180 => 37,  177 => 36,  174 => 35,  171 => 34,  168 => 33,  163 => 32,  159 => 31,  151 => 30,  140 => 16,  133 => 15,  119 => 13,  114 => 9,  108 => 8,  96 => 7,  88 => 67,  85 => 66,  83 => 50,  80 => 49,  78 => 48,  74 => 46,  72 => 45,  68 => 43,  66 => 30,  62 => 28,  60 => 27,  46 => 17,  43 => 16,  41 => 8,  37 => 7,  29 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="en">*/
/*   <head>*/
/*     <meta charset="utf-8">*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*     <title>{% block title %}Premio Provincial a la calidad{% endblock %}</title>*/
/*     {% block stylesheets %}*/
/*         {% stylesheets filter="cssrewrite, scssphp" output="css/app.min.css"*/
/*             "assets/css/*.css"*/
/*             "assets/scss/app.scss"*/
/*         %}*/
/*             <link rel="stylesheet" href="{{ asset_url }}" />*/
/*         {% endstylesheets %}*/
/*     {% endblock %}*/
/*     {% block page_stylesheets %}{% endblock %}*/
/*     <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/* */
/*     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->*/
/*     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->*/
/*     <!--[if lt IE 9]>*/
/*       <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>*/
/*       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>*/
/*     <![endif]-->*/
/*   </head>*/
/*   <body>*/
/*     {% include 'header.html.twig' %}*/
/* */
/*     <div id="main">*/
/*         {% block flashes %}                */
/*             {% for type, flashMessages in app.session.flashbag.all() %}*/
/*                 {% for flashMessage in flashMessages %}*/
/*                     {% if type == 'error' %}*/
/*                        {% set type = 'danger' %}*/
/*                     {% endif %}*/
/*                     <div class="container">*/
/*                         <div class="alert alert-{{ type }}" role="alert">*/
/*                            {{ flashMessage|trans }}*/
/*                         </div>*/
/*                     </div>        */
/*                 {% endfor %}*/
/*             {% endfor %}*/
/*         {% endblock %} */
/* */
/*         {% block body %}{% endblock %}*/
/*     </div>*/
/* */
/*     {% include 'footer.html.twig' %}*/
/* */
/*     {% block javascripts %}*/
/*         {% javascripts filter="?jsqueeze" output="js/app.min.js"*/
/*             "assets/js/jquery.min.js"*/
/*             "assets/js/moment-with-locales.min.js"*/
/*             "assets/js/jquery.mousewheel.min.js"*/
/*             "assets/js/bootstrap.min.js"*/
/*             "assets/js/bootstrap-datetimepicker.min.js"*/
/*             "assets/js/select2/select2.min.js"*/
/*             "assets/js/select2/i18n/es.js"*/
/*             "assets/js/bootstrap-file-input/fileinput.min.js"*/
/*             "assets/js/bootstrap-file-input/locales/es.js"*/
/*             "assets/js/application.js"*/
/*         %}*/
/*             <script src="{{ asset_url }}"></script>*/
/*         {% endjavascripts %}*/
/*     {% endblock %}*/
/*     {% block page_javascripts %}{% endblock %}*/
/*   </body>*/
/* </html>*/
