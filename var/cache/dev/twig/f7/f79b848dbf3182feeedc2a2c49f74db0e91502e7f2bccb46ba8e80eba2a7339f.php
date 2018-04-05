<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_cc9c54aacc50e6a8c35d31504f61a15975502d533160b480cb6a9b519c674f87 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e4fb9be3931e87b5280f07b5e9c1826adf241b530384eeecd73804811a457ac7 = $this->env->getExtension("native_profiler");
        $__internal_e4fb9be3931e87b5280f07b5e9c1826adf241b530384eeecd73804811a457ac7->enter($__internal_e4fb9be3931e87b5280f07b5e9c1826adf241b530384eeecd73804811a457ac7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e4fb9be3931e87b5280f07b5e9c1826adf241b530384eeecd73804811a457ac7->leave($__internal_e4fb9be3931e87b5280f07b5e9c1826adf241b530384eeecd73804811a457ac7_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_3106c06dff6f4512c56577748a57a2e7520fd1d856fe66126f8d5bed4e3203e0 = $this->env->getExtension("native_profiler");
        $__internal_3106c06dff6f4512c56577748a57a2e7520fd1d856fe66126f8d5bed4e3203e0->enter($__internal_3106c06dff6f4512c56577748a57a2e7520fd1d856fe66126f8d5bed4e3203e0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_3106c06dff6f4512c56577748a57a2e7520fd1d856fe66126f8d5bed4e3203e0->leave($__internal_3106c06dff6f4512c56577748a57a2e7520fd1d856fe66126f8d5bed4e3203e0_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_583789df4a6d6ae682411f3375d70b4ca0bc78e2baa67c4653e5e2396781099b = $this->env->getExtension("native_profiler");
        $__internal_583789df4a6d6ae682411f3375d70b4ca0bc78e2baa67c4653e5e2396781099b->enter($__internal_583789df4a6d6ae682411f3375d70b4ca0bc78e2baa67c4653e5e2396781099b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_583789df4a6d6ae682411f3375d70b4ca0bc78e2baa67c4653e5e2396781099b->leave($__internal_583789df4a6d6ae682411f3375d70b4ca0bc78e2baa67c4653e5e2396781099b_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_6cf53ffe5f3dc9e921bb454d1422e2133046e819b4867a67e09f971fe87bbfc8 = $this->env->getExtension("native_profiler");
        $__internal_6cf53ffe5f3dc9e921bb454d1422e2133046e819b4867a67e09f971fe87bbfc8->enter($__internal_6cf53ffe5f3dc9e921bb454d1422e2133046e819b4867a67e09f971fe87bbfc8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_6cf53ffe5f3dc9e921bb454d1422e2133046e819b4867a67e09f971fe87bbfc8->leave($__internal_6cf53ffe5f3dc9e921bb454d1422e2133046e819b4867a67e09f971fe87bbfc8_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@WebProfiler/Profiler/layout.html.twig' %}*/
/* */
/* {% block toolbar %}{% endblock %}*/
/* */
/* {% block menu %}*/
/* <span class="label">*/
/*     <span class="icon">{{ include('@WebProfiler/Icon/router.svg') }}</span>*/
/*     <strong>Routing</strong>*/
/* </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {{ render(path('_profiler_router', { token: token })) }}*/
/* {% endblock %}*/
/* */
