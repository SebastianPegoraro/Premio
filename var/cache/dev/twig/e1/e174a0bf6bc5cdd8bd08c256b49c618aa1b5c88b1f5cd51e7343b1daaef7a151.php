<?php

/* FOSUserBundle::layout.html.twig */
class __TwigTemplate_4e425581db0b0f7e550fcf3e5132bd60024f72b29a89f88a652753df838136ca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "FOSUserBundle::layout.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_cdfad0171888b5c52bef2bc4ba4a9e02e421f50d7ea9933dfbc111c781f6c311 = $this->env->getExtension("native_profiler");
        $__internal_cdfad0171888b5c52bef2bc4ba4a9e02e421f50d7ea9933dfbc111c781f6c311->enter($__internal_cdfad0171888b5c52bef2bc4ba4a9e02e421f50d7ea9933dfbc111c781f6c311_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle::layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_cdfad0171888b5c52bef2bc4ba4a9e02e421f50d7ea9933dfbc111c781f6c311->leave($__internal_cdfad0171888b5c52bef2bc4ba4a9e02e421f50d7ea9933dfbc111c781f6c311_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_128c6e81ec94708d5e273e29b0e8b444c9d4d43b3b1a770364cd2b4a1ec547b4 = $this->env->getExtension("native_profiler");
        $__internal_128c6e81ec94708d5e273e29b0e8b444c9d4d43b3b1a770364cd2b4a1ec547b4->enter($__internal_128c6e81ec94708d5e273e29b0e8b444c9d4d43b3b1a770364cd2b4a1ec547b4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    ";
        // line 14
        echo "
        ";
        // line 15
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "hasPreviousSession", array())) {
            // line 16
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "all", array(), "method"));
            foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
                // line 17
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["messages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 18
                    echo "                    <div class=\"flash-";
                    echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                    echo "\">
                        ";
                    // line 19
                    echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                    echo "
                    </div>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 22
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "        ";
        }
        // line 24
        echo "    
        <div class=\"container\">
            ";
        // line 26
        $this->displayBlock('fos_user_content', $context, $blocks);
        // line 28
        echo "        </div>
   
";
        
        $__internal_128c6e81ec94708d5e273e29b0e8b444c9d4d43b3b1a770364cd2b4a1ec547b4->leave($__internal_128c6e81ec94708d5e273e29b0e8b444c9d4d43b3b1a770364cd2b4a1ec547b4_prof);

    }

    // line 26
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_5ebe0aaace8262af880cce19170cd6b205be47def1b19818840cccbbb091a13a = $this->env->getExtension("native_profiler");
        $__internal_5ebe0aaace8262af880cce19170cd6b205be47def1b19818840cccbbb091a13a->enter($__internal_5ebe0aaace8262af880cce19170cd6b205be47def1b19818840cccbbb091a13a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 27
        echo "            ";
        
        $__internal_5ebe0aaace8262af880cce19170cd6b205be47def1b19818840cccbbb091a13a->leave($__internal_5ebe0aaace8262af880cce19170cd6b205be47def1b19818840cccbbb091a13a_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 27,  96 => 26,  87 => 28,  85 => 26,  81 => 24,  78 => 23,  72 => 22,  63 => 19,  58 => 18,  53 => 17,  48 => 16,  46 => 15,  43 => 14,  41 => 4,  35 => 3,  11 => 1,);
    }
}
/* {% extends 'base.html.twig' %}*/
/* */
/* {% block body %}*/
/*     {# <div>*/
/*         {% if is_granted("IS_AUTHENTICATED_REMEMBERED") %}*/
/*             {{ 'layout.logged_in_as'|trans({'%username%': app.user.username}, 'FOSUserBundle') }} |*/
/*             <a href="{{ path('fos_user_security_logout') }}">*/
/*              {{ 'layout.logout'|trans({}, 'FOSUserBundle') }}*/
/*             </a>*/
/*             {% else %}*/
/*             <a href="{{ path('fos_user_security_login') }}">{{ 'layout.login'|trans({}, 'FOSUserBundle') }}</a>*/
/*         {% endif %}*/
/*     </div> #}*/
/* */
/*         {% if app.request.hasPreviousSession %}*/
/*             {% for type, messages in app.session.flashbag.all() %}*/
/*                 {% for message in messages %}*/
/*                     <div class="flash-{{ type }}">*/
/*                         {{ message }}*/
/*                     </div>*/
/*                 {% endfor %}*/
/*             {% endfor %}*/
/*         {% endif %}*/
/*     */
/*         <div class="container">*/
/*             {% block fos_user_content %}*/
/*             {% endblock fos_user_content %}*/
/*         </div>*/
/*    */
/* {% endblock %}*/
/* */
/* */
/* */
