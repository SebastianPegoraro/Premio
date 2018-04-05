<?php

/* FOSUserBundle:Profile:show_content.html.twig */
class __TwigTemplate_bafe2e3415206a7f87afe4ce5cf2713c86eb2cca991aa6f81225840b492db306 extends Twig_Template
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
        $__internal_fe68f2af902d1f27eddd3f8b4134311137fde558162b8a374e4f7e15da7bf063 = $this->env->getExtension("native_profiler");
        $__internal_fe68f2af902d1f27eddd3f8b4134311137fde558162b8a374e4f7e15da7bf063->enter($__internal_fe68f2af902d1f27eddd3f8b4134311137fde558162b8a374e4f7e15da7bf063_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Profile:show_content.html.twig"));

        // line 2
        echo "
<div class=\"row\">
    <div class=\"col-sm-12\">
      \t<div class=\"panel panel-primary\">
            <div class=\"panel-heading\">
                <h3 class=\"panel-title main-title\">Perfil</h3>
            </div>
            <div class=\"panel-body\">
            \t<div class=\"col-sm-8\">
                    <table class=\"table table-bordered table-condensed\">
                        <tbody>
                            <tr>
                                <th class=\"width-perc-20\">";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("profile.show.username", array(), "FOSUserBundle"), "html", null, true);
        echo "</th>
                                <td>";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "html", null, true);
        echo "</td>
                            </tr>
                            <tr>
                                <th class=\"width-perc-20\">";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("profile.show.email", array(), "FOSUserBundle"), "html", null, true);
        echo "</th>
                                <td>";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "email", array()), "html", null, true);
        echo "</td>
                            </tr>
                        </tbody>
                    </table>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-sm-4\">
            \t\t<ul class=\"nav nav-pills nav-stacked\">
\t\t\t\t\t\t<li role=\"presentation\" class=\"active\" ><a href=\"#\"><i class=\"fa fa-user\"></i> Perfil</a></li>
\t\t\t\t\t\t<li role=\"presentation\"><a href=\"";
        // line 27
        echo $this->env->getExtension('routing')->getPath("fos_user_profile_edit");
        echo "\"><i class=\"fa fa-edit\"></i> Editar Perfil</a></li>
\t\t\t\t\t</ul>
            \t</div>
            </div>
        </div>
    </div>
</div>
";
        
        $__internal_fe68f2af902d1f27eddd3f8b4134311137fde558162b8a374e4f7e15da7bf063->leave($__internal_fe68f2af902d1f27eddd3f8b4134311137fde558162b8a374e4f7e15da7bf063_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Profile:show_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 27,  50 => 19,  46 => 18,  40 => 15,  36 => 14,  22 => 2,);
    }
}
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* <div class="row">*/
/*     <div class="col-sm-12">*/
/*       	<div class="panel panel-primary">*/
/*             <div class="panel-heading">*/
/*                 <h3 class="panel-title main-title">Perfil</h3>*/
/*             </div>*/
/*             <div class="panel-body">*/
/*             	<div class="col-sm-8">*/
/*                     <table class="table table-bordered table-condensed">*/
/*                         <tbody>*/
/*                             <tr>*/
/*                                 <th class="width-perc-20">{{ 'profile.show.username'|trans }}</th>*/
/*                                 <td>{{ user.username }}</td>*/
/*                             </tr>*/
/*                             <tr>*/
/*                                 <th class="width-perc-20">{{ 'profile.show.email'|trans }}</th>*/
/*                                 <td>{{ user.email }}</td>*/
/*                             </tr>*/
/*                         </tbody>*/
/*                     </table>*/
/* 				</div>*/
/* 				<div class="col-sm-4">*/
/*             		<ul class="nav nav-pills nav-stacked">*/
/* 						<li role="presentation" class="active" ><a href="#"><i class="fa fa-user"></i> Perfil</a></li>*/
/* 						<li role="presentation"><a href="{{ path('fos_user_profile_edit') }}"><i class="fa fa-edit"></i> Editar Perfil</a></li>*/
/* 					</ul>*/
/*             	</div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
