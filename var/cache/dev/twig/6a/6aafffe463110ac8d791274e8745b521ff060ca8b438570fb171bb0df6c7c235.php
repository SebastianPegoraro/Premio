<?php

/* base.html.twig */
class __TwigTemplate_e1bfc017aa5789dc87f4b101d56147b3706879f1f639fef8aea3dd8f32b971e8 extends Twig_Template
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
        $__internal_7b43f64b91b253551a207906d2cb3d1b27052acd39ec6b0aafb4a4a3aed9f37a = $this->env->getExtension("native_profiler");
        $__internal_7b43f64b91b253551a207906d2cb3d1b27052acd39ec6b0aafb4a4a3aed9f37a->enter($__internal_7b43f64b91b253551a207906d2cb3d1b27052acd39ec6b0aafb4a4a3aed9f37a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

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
        
        $__internal_7b43f64b91b253551a207906d2cb3d1b27052acd39ec6b0aafb4a4a3aed9f37a->leave($__internal_7b43f64b91b253551a207906d2cb3d1b27052acd39ec6b0aafb4a4a3aed9f37a_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_0adbe64244f3d0b9451725baaf8e4a5025f61971abed2151eed898c6b6a18cde = $this->env->getExtension("native_profiler");
        $__internal_0adbe64244f3d0b9451725baaf8e4a5025f61971abed2151eed898c6b6a18cde->enter($__internal_0adbe64244f3d0b9451725baaf8e4a5025f61971abed2151eed898c6b6a18cde_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Premio Provincial a la calidad";
        
        $__internal_0adbe64244f3d0b9451725baaf8e4a5025f61971abed2151eed898c6b6a18cde->leave($__internal_0adbe64244f3d0b9451725baaf8e4a5025f61971abed2151eed898c6b6a18cde_prof);

    }

    // line 8
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_532d07a3ec8a23c19f750f529875c36d2286fc82f97dc4b6cf469270141574b8 = $this->env->getExtension("native_profiler");
        $__internal_532d07a3ec8a23c19f750f529875c36d2286fc82f97dc4b6cf469270141574b8->enter($__internal_532d07a3ec8a23c19f750f529875c36d2286fc82f97dc4b6cf469270141574b8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

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
        
        $__internal_532d07a3ec8a23c19f750f529875c36d2286fc82f97dc4b6cf469270141574b8->leave($__internal_532d07a3ec8a23c19f750f529875c36d2286fc82f97dc4b6cf469270141574b8_prof);

    }

    // line 16
    public function block_page_stylesheets($context, array $blocks = array())
    {
        $__internal_f5878e251671f21a04463815170281c822ca0851e609a54c203020e6243744f4 = $this->env->getExtension("native_profiler");
        $__internal_f5878e251671f21a04463815170281c822ca0851e609a54c203020e6243744f4->enter($__internal_f5878e251671f21a04463815170281c822ca0851e609a54c203020e6243744f4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_stylesheets"));

        
        $__internal_f5878e251671f21a04463815170281c822ca0851e609a54c203020e6243744f4->leave($__internal_f5878e251671f21a04463815170281c822ca0851e609a54c203020e6243744f4_prof);

    }

    // line 30
    public function block_flashes($context, array $blocks = array())
    {
        $__internal_8d0583a6a2b11c14916af86ec8ef0718f595ca510291e7f9d6df6ca98975ce1f = $this->env->getExtension("native_profiler");
        $__internal_8d0583a6a2b11c14916af86ec8ef0718f595ca510291e7f9d6df6ca98975ce1f->enter($__internal_8d0583a6a2b11c14916af86ec8ef0718f595ca510291e7f9d6df6ca98975ce1f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "flashes"));

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
        
        $__internal_8d0583a6a2b11c14916af86ec8ef0718f595ca510291e7f9d6df6ca98975ce1f->leave($__internal_8d0583a6a2b11c14916af86ec8ef0718f595ca510291e7f9d6df6ca98975ce1f_prof);

    }

    // line 45
    public function block_body($context, array $blocks = array())
    {
        $__internal_5605be89fc27e1ab650d74e83472c4782f0b7724ab9c0f09f83345184b110a0f = $this->env->getExtension("native_profiler");
        $__internal_5605be89fc27e1ab650d74e83472c4782f0b7724ab9c0f09f83345184b110a0f->enter($__internal_5605be89fc27e1ab650d74e83472c4782f0b7724ab9c0f09f83345184b110a0f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_5605be89fc27e1ab650d74e83472c4782f0b7724ab9c0f09f83345184b110a0f->leave($__internal_5605be89fc27e1ab650d74e83472c4782f0b7724ab9c0f09f83345184b110a0f_prof);

    }

    // line 50
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_ac43cfaaaec715ccf0110a37133ca7d33c99737b993dfb53a8e42fcbb7c60604 = $this->env->getExtension("native_profiler");
        $__internal_ac43cfaaaec715ccf0110a37133ca7d33c99737b993dfb53a8e42fcbb7c60604->enter($__internal_ac43cfaaaec715ccf0110a37133ca7d33c99737b993dfb53a8e42fcbb7c60604_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

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
        
        $__internal_ac43cfaaaec715ccf0110a37133ca7d33c99737b993dfb53a8e42fcbb7c60604->leave($__internal_ac43cfaaaec715ccf0110a37133ca7d33c99737b993dfb53a8e42fcbb7c60604_prof);

    }

    // line 66
    public function block_page_javascripts($context, array $blocks = array())
    {
        $__internal_aee0933fe6db1f811380efdc2a300a229413ce93c38d11c798131751d422eb43 = $this->env->getExtension("native_profiler");
        $__internal_aee0933fe6db1f811380efdc2a300a229413ce93c38d11c798131751d422eb43->enter($__internal_aee0933fe6db1f811380efdc2a300a229413ce93c38d11c798131751d422eb43_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_javascripts"));

        
        $__internal_aee0933fe6db1f811380efdc2a300a229413ce93c38d11c798131751d422eb43->leave($__internal_aee0933fe6db1f811380efdc2a300a229413ce93c38d11c798131751d422eb43_prof);

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
