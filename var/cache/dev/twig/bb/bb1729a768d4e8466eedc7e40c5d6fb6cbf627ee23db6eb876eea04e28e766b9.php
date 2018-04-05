<?php

/* FOSUserBundle:Security:login.html.twig */
class __TwigTemplate_044cd069955ef686f3cab82ad829f9c3c3c507c036b60b3aa6408628eeac011d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Security:login.html.twig", 1);
        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
            'page_javascripts' => array($this, 'block_page_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "FOSUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_623aa94dafb7554131b84a40392085ee10a80f4f737edbd981a0f41713468058 = $this->env->getExtension("native_profiler");
        $__internal_623aa94dafb7554131b84a40392085ee10a80f4f737edbd981a0f41713468058->enter($__internal_623aa94dafb7554131b84a40392085ee10a80f4f737edbd981a0f41713468058_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Security:login.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_623aa94dafb7554131b84a40392085ee10a80f4f737edbd981a0f41713468058->leave($__internal_623aa94dafb7554131b84a40392085ee10a80f4f737edbd981a0f41713468058_prof);

    }

    // line 5
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_919a6219cd83084383b711ddc543a4ec8c7f9c9a0470f6e97d4744bc3d4f7f84 = $this->env->getExtension("native_profiler");
        $__internal_919a6219cd83084383b711ddc543a4ec8c7f9c9a0470f6e97d4744bc3d4f7f84->enter($__internal_919a6219cd83084383b711ddc543a4ec8c7f9c9a0470f6e97d4744bc3d4f7f84_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 6
        echo "<div class=\"row\">
\t<div class=\"col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 well\">
\t\t";
        // line 8
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 9
            echo "\t\t    <div class=\"alert alert-danger\">
\t\t    \t<i class=\"fa fa-exclamation-circle\"></i> ";
            // line 10
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "messageKey", array()), $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "messageData", array()), "security"), "html", null, true);
            echo "
\t\t    </div>
\t\t";
        }
        // line 13
        echo "\t\t<form action=\"";
        echo $this->env->getExtension('routing')->getPath("fos_user_security_check");
        echo "\" method=\"post\">
\t\t    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\" />

\t\t    <div class=\"form-group\">
\t\t\t    <label for=\"username\">";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>
\t\t\t    <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" class=\"form-control\"  required=\"required\" />
\t\t\t</div>

\t\t\t<div class=\"form-group\">
\t\t\t    <label for=\"password\">";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>
\t\t\t    <input type=\"password\" id=\"password\" name=\"_password\" required=\"required\" class=\"form-control\" />
\t\t\t</div>
\t\t\t<div class=\"checkbox\">
\t\t\t    <label for=\"remember_me\">
\t\t\t\t    <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\" />
\t\t\t\t    ";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "
\t\t\t\t</label>
\t\t\t</div>
\t\t\t<a href=\"";
        // line 31
        echo $this->env->getExtension('routing')->getPath("fos_user_resetting_request");
        echo "\">
\t\t\t\t<i class=\"fa fa-question-circle\"></i> Olvidé mi contraseña
\t\t\t</a>
\t\t\t<div class=\"text-right\">

\t\t\t\t<button class=\"btn btn-primary\" type=\"submit\" id=\"_submit\" name=\"_submit\" value=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\">
\t\t\t\t\t<i class=\"fa fa-lg fa-sign-in\"></i> ";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "
\t\t\t\t</button>
\t\t\t</div>\t
\t\t</form>
\t</div>
</div>
";
        
        $__internal_919a6219cd83084383b711ddc543a4ec8c7f9c9a0470f6e97d4744bc3d4f7f84->leave($__internal_919a6219cd83084383b711ddc543a4ec8c7f9c9a0470f6e97d4744bc3d4f7f84_prof);

    }

    // line 45
    public function block_page_javascripts($context, array $blocks = array())
    {
        $__internal_1f67bc28701e89c908a1cfa4f426221c68a86c9b29b9c516422f1fd68784bfcc = $this->env->getExtension("native_profiler");
        $__internal_1f67bc28701e89c908a1cfa4f426221c68a86c9b29b9c516422f1fd68784bfcc->enter($__internal_1f67bc28701e89c908a1cfa4f426221c68a86c9b29b9c516422f1fd68784bfcc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_javascripts"));

        // line 46
        echo "<script type=\"text/javascript\">
\t(function(\$) {
\t\t\$('#username').focus();
\t}(jQuery));
</script>
";
        
        $__internal_1f67bc28701e89c908a1cfa4f426221c68a86c9b29b9c516422f1fd68784bfcc->leave($__internal_1f67bc28701e89c908a1cfa4f426221c68a86c9b29b9c516422f1fd68784bfcc_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 46,  119 => 45,  105 => 37,  101 => 36,  93 => 31,  87 => 28,  78 => 22,  71 => 18,  67 => 17,  61 => 14,  56 => 13,  50 => 10,  47 => 9,  45 => 8,  41 => 6,  35 => 5,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* {% block fos_user_content %}*/
/* <div class="row">*/
/* 	<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 well">*/
/* 		{% if error %}*/
/* 		    <div class="alert alert-danger">*/
/* 		    	<i class="fa fa-exclamation-circle"></i> {{ error.messageKey|trans(error.messageData, 'security') }}*/
/* 		    </div>*/
/* 		{% endif %}*/
/* 		<form action="{{ path("fos_user_security_check") }}" method="post">*/
/* 		    <input type="hidden" name="_csrf_token" value="{{ csrf_token }}" />*/
/* */
/* 		    <div class="form-group">*/
/* 			    <label for="username">{{ 'security.login.username'|trans }}</label>*/
/* 			    <input type="text" id="username" name="_username" value="{{ last_username }}" class="form-control"  required="required" />*/
/* 			</div>*/
/* */
/* 			<div class="form-group">*/
/* 			    <label for="password">{{ 'security.login.password'|trans }}</label>*/
/* 			    <input type="password" id="password" name="_password" required="required" class="form-control" />*/
/* 			</div>*/
/* 			<div class="checkbox">*/
/* 			    <label for="remember_me">*/
/* 				    <input type="checkbox" id="remember_me" name="_remember_me" value="on" />*/
/* 				    {{ 'security.login.remember_me'|trans }}*/
/* 				</label>*/
/* 			</div>*/
/* 			<a href="{{ path('fos_user_resetting_request') }}">*/
/* 				<i class="fa fa-question-circle"></i> Olvidé mi contraseña*/
/* 			</a>*/
/* 			<div class="text-right">*/
/* */
/* 				<button class="btn btn-primary" type="submit" id="_submit" name="_submit" value="{{ 'security.login.submit'|trans }}">*/
/* 					<i class="fa fa-lg fa-sign-in"></i> {{ 'security.login.submit'|trans }}*/
/* 				</button>*/
/* 			</div>	*/
/* 		</form>*/
/* 	</div>*/
/* </div>*/
/* {% endblock fos_user_content %}*/
/* */
/* {% block page_javascripts %}*/
/* <script type="text/javascript">*/
/* 	(function($) {*/
/* 		$('#username').focus();*/
/* 	}(jQuery));*/
/* </script>*/
/* {% endblock %}*/
/* */
