<?php

/* FOSUserBundle::layout.html.twig */
class __TwigTemplate_4b59299cbbea808e4313e82cc02a096ad70fff74f7f6e74d6d1bae1059e030fd extends Twig_Template
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
        $__internal_e2fed8c8eb2ecaf40c4b964cdbd98435caf36f07d1c7f153e9334ba172bd38f2 = $this->env->getExtension("native_profiler");
        $__internal_e2fed8c8eb2ecaf40c4b964cdbd98435caf36f07d1c7f153e9334ba172bd38f2->enter($__internal_e2fed8c8eb2ecaf40c4b964cdbd98435caf36f07d1c7f153e9334ba172bd38f2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle::layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e2fed8c8eb2ecaf40c4b964cdbd98435caf36f07d1c7f153e9334ba172bd38f2->leave($__internal_e2fed8c8eb2ecaf40c4b964cdbd98435caf36f07d1c7f153e9334ba172bd38f2_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_4f6c34334b93adb98ad9a67452507b655108035fbc0abfcca559f3ae196bb81f = $this->env->getExtension("native_profiler");
        $__internal_4f6c34334b93adb98ad9a67452507b655108035fbc0abfcca559f3ae196bb81f->enter($__internal_4f6c34334b93adb98ad9a67452507b655108035fbc0abfcca559f3ae196bb81f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

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
        
        $__internal_4f6c34334b93adb98ad9a67452507b655108035fbc0abfcca559f3ae196bb81f->leave($__internal_4f6c34334b93adb98ad9a67452507b655108035fbc0abfcca559f3ae196bb81f_prof);

    }

    // line 26
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_4e12149d62b8d674d2f8e5b8bc7f0301d4999396cb211d3bcad2bab16094da7f = $this->env->getExtension("native_profiler");
        $__internal_4e12149d62b8d674d2f8e5b8bc7f0301d4999396cb211d3bcad2bab16094da7f->enter($__internal_4e12149d62b8d674d2f8e5b8bc7f0301d4999396cb211d3bcad2bab16094da7f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 27
        echo "            ";
        
        $__internal_4e12149d62b8d674d2f8e5b8bc7f0301d4999396cb211d3bcad2bab16094da7f->leave($__internal_4e12149d62b8d674d2f8e5b8bc7f0301d4999396cb211d3bcad2bab16094da7f_prof);

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
