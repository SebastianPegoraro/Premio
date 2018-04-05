<?php

/* footer.html.twig */
class __TwigTemplate_f80ca72aaa3ce20e6e9f5120eb67d732af32ac8ddb81ee72b0fc34b7e6286e15 extends Twig_Template
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
        $__internal_352924f1a424c79b37e95f0e90102985e9d5fca6d39f88aeacb2216e92f3fc98 = $this->env->getExtension("native_profiler");
        $__internal_352924f1a424c79b37e95f0e90102985e9d5fca6d39f88aeacb2216e92f3fc98->enter($__internal_352924f1a424c79b37e95f0e90102985e9d5fca6d39f88aeacb2216e92f3fc98_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "footer.html.twig"));

        // line 1
        echo "<footer>
    <div id=\"footer-presentation\" class=\"container\">
        <div class=\"row\">
        \t<div class=\"col-sm-6\">
        \t\t<img class=\"logo-sggc\" src=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("images/logo-sggc.png"), "html", null, true);
        echo "\">
        \t</div>
        \t<div class=\"col-sm-3\">
        \t\t<img class=\"logo-scgpe\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("images/logo-sub-cgpe.png"), "html", null, true);
        echo "\">
        \t</div>
        \t<div class=\"col-sm-3\">
        \t\t<img class=\"logo-gob-footer\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("images/logo-chacogob.png"), "html", null, true);
        echo "\">
        \t</div>
        </div>
    </div>
</footer>";
        
        $__internal_352924f1a424c79b37e95f0e90102985e9d5fca6d39f88aeacb2216e92f3fc98->leave($__internal_352924f1a424c79b37e95f0e90102985e9d5fca6d39f88aeacb2216e92f3fc98_prof);

    }

    public function getTemplateName()
    {
        return "footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 11,  34 => 8,  28 => 5,  22 => 1,);
    }
}
/* <footer>*/
/*     <div id="footer-presentation" class="container">*/
/*         <div class="row">*/
/*         	<div class="col-sm-6">*/
/*         		<img class="logo-sggc" src="{{ asset('images/logo-sggc.png') }}">*/
/*         	</div>*/
/*         	<div class="col-sm-3">*/
/*         		<img class="logo-scgpe" src="{{ asset('images/logo-sub-cgpe.png') }}">*/
/*         	</div>*/
/*         	<div class="col-sm-3">*/
/*         		<img class="logo-gob-footer" src="{{ asset('images/logo-chacogob.png') }}">*/
/*         	</div>*/
/*         </div>*/
/*     </div>*/
/* </footer>*/
