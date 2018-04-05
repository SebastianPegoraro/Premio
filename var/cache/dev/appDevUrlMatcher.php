<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/js/097376d')) {
            // _assetic_097376d
            if ($pathinfo === '/js/097376d.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '097376d',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_097376d',);
            }

            // _assetic_097376d_0
            if ($pathinfo === '/js/097376d_collection_1.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '097376d',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_097376d_0',);
            }

        }

        if (0 === strpos($pathinfo, '/css/app.min')) {
            // _assetic_538beaf
            if ($pathinfo === '/css/app.min.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '538beaf',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_538beaf',);
            }

            // _assetic_538beaf_0
            if ($pathinfo === '/css/app.min_app_2.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '538beaf',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_538beaf_0',);
            }

        }

        if (0 === strpos($pathinfo, '/js/app.min')) {
            // _assetic_d94884e
            if ($pathinfo === '/js/app.min.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_d94884e',);
            }

            if (0 === strpos($pathinfo, '/js/app.min_')) {
                // _assetic_d94884e_0
                if ($pathinfo === '/js/app.min_jquery.min_1.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_d94884e_0',);
                }

                // _assetic_d94884e_1
                if ($pathinfo === '/js/app.min_moment-with-locales.min_2.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_d94884e_1',);
                }

                // _assetic_d94884e_2
                if ($pathinfo === '/js/app.min_jquery.mousewheel.min_3.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_d94884e_2',);
                }

                if (0 === strpos($pathinfo, '/js/app.min_bootstrap')) {
                    // _assetic_d94884e_3
                    if ($pathinfo === '/js/app.min_bootstrap.min_4.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_d94884e_3',);
                    }

                    // _assetic_d94884e_4
                    if ($pathinfo === '/js/app.min_bootstrap-datetimepicker.min_5.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_d94884e_4',);
                    }

                }

                // _assetic_d94884e_5
                if ($pathinfo === '/js/app.min_select2.min_6.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 5,  '_format' => 'js',  '_route' => '_assetic_d94884e_5',);
                }

                // _assetic_d94884e_6
                if ($pathinfo === '/js/app.min_es_7.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 6,  '_format' => 'js',  '_route' => '_assetic_d94884e_6',);
                }

                // _assetic_d94884e_7
                if ($pathinfo === '/js/app.min_fileinput.min_8.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 7,  '_format' => 'js',  '_route' => '_assetic_d94884e_7',);
                }

                // _assetic_d94884e_8
                if ($pathinfo === '/js/app.min_es_9.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 8,  '_format' => 'js',  '_route' => '_assetic_d94884e_8',);
                }

                // _assetic_d94884e_9
                if ($pathinfo === '/js/app.min_application_10.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'd94884e',  'pos' => 9,  '_format' => 'js',  '_route' => '_assetic_d94884e_9',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/css/pdf.min')) {
            // _assetic_68bd9bb
            if ($pathinfo === '/css/pdf.min.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '68bd9bb',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_68bd9bb',);
            }

            // _assetic_68bd9bb_0
            if ($pathinfo === '/css/pdf.min_pdf_2.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '68bd9bb',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_68bd9bb_0',);
            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            if (0 === strpos($pathinfo, '/admin/gestionpremio')) {
                // adminpremio_index
                if (rtrim($pathinfo, '/') === '/admin/gestionpremio') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'adminpremio_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\AdminPremioController::indexAction',  '_route' => 'adminpremio_index',);
                }

                if (0 === strpos($pathinfo, '/admin/gestionpremio/organizacionp')) {
                    // adminpremio_organizacionprivada
                    if ($pathinfo === '/admin/gestionpremio/organizacionprivada') {
                        return array (  '_controller' => 'AppBundle\\Controller\\AdminPremioController::organizacionPrivadaAction',  '_route' => 'adminpremio_organizacionprivada',);
                    }

                    // adminpremio_organizacionpublica
                    if ($pathinfo === '/admin/gestionpremio/organizacionpublica') {
                        return array (  '_controller' => 'AppBundle\\Controller\\AdminPremioController::organizacionpublicaAction',  '_route' => 'adminpremio_organizacionpublica',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/admin/criterioevaluacion')) {
                // admin_criterioevaluacion_index
                if (rtrim($pathinfo, '/') === '/admin/criterioevaluacion') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_criterioevaluacion_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_criterioevaluacion_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\CriterioEvaluacionController::indexAction',  '_route' => 'admin_criterioevaluacion_index',);
                }
                not_admin_criterioevaluacion_index:

                // admin_criterioevaluacion_new
                if ($pathinfo === '/admin/criterioevaluacion/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_criterioevaluacion_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\CriterioEvaluacionController::newAction',  '_route' => 'admin_criterioevaluacion_new',);
                }
                not_admin_criterioevaluacion_new:

                // admin_criterioevaluacion_show
                if (preg_match('#^/admin/criterioevaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_criterioevaluacion_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_criterioevaluacion_show')), array (  '_controller' => 'AppBundle\\Controller\\CriterioEvaluacionController::showAction',));
                }
                not_admin_criterioevaluacion_show:

                // admin_criterioevaluacion_edit
                if (preg_match('#^/admin/criterioevaluacion/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_criterioevaluacion_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_criterioevaluacion_edit')), array (  '_controller' => 'AppBundle\\Controller\\CriterioEvaluacionController::editAction',));
                }
                not_admin_criterioevaluacion_edit:

                // admin_criterioevaluacion_delete
                if (preg_match('#^/admin/criterioevaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_admin_criterioevaluacion_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_criterioevaluacion_delete')), array (  '_controller' => 'AppBundle\\Controller\\CriterioEvaluacionController::deleteAction',));
                }
                not_admin_criterioevaluacion_delete:

            }

        }

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        if (0 === strpos($pathinfo, '/test')) {
            // test
            if ($pathinfo === '/test') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_test;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::testAction',  '_route' => 'test',);
            }
            not_test:

            // test_2
            if ($pathinfo === '/test2') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_test_2;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::test2Action',  '_route' => 'test_2',);
            }
            not_test_2:

        }

        if (0 === strpos($pathinfo, '/admin/equipoevaluador')) {
            // admin_equipoevaluador_index
            if (rtrim($pathinfo, '/') === '/admin/equipoevaluador') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_admin_equipoevaluador_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_equipoevaluador_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::indexAction',  '_route' => 'admin_equipoevaluador_index',);
            }
            not_admin_equipoevaluador_index:

            // admin_equipoevaluador_new
            if ($pathinfo === '/admin/equipoevaluador/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_admin_equipoevaluador_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::newAction',  '_route' => 'admin_equipoevaluador_new',);
            }
            not_admin_equipoevaluador_new:

            // admin_equipoevaluador_show
            if (preg_match('#^/admin/equipoevaluador/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_equipoevaluador_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_show')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::showAction',));
            }
            not_admin_equipoevaluador_show:

            // admin_equipoevaluador_edit
            if (preg_match('#^/admin/equipoevaluador/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_admin_equipoevaluador_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_edit')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::editAction',));
            }
            not_admin_equipoevaluador_edit:

            // admin_equipoevaluador_delete
            if (preg_match('#^/admin/equipoevaluador/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_admin_equipoevaluador_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_delete')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::deleteAction',));
            }
            not_admin_equipoevaluador_delete:

            // admin_equipoevaluador_asignaciones
            if ($pathinfo === '/admin/equipoevaluador/asignaciones') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_admin_equipoevaluador_asignaciones;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::asignacionesAction',  '_route' => 'admin_equipoevaluador_asignaciones',);
            }
            not_admin_equipoevaluador_asignaciones:

            // admin_equipoevaluador_respuestas-evaluadores
            if (0 === strpos($pathinfo, '/admin/equipoevaluador/respuestas-evaluadores') && preg_match('#^/admin/equipoevaluador/respuestas\\-evaluadores/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_respuestas-evaluadores')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::showRespuestasEvaluadoresAction',));
            }

            // admin_equipoevaluador_pdf-respuestas-evaluadores
            if (0 === strpos($pathinfo, '/admin/equipoevaluador/pdf-respuestas-evaluadores') && preg_match('#^/admin/equipoevaluador/pdf\\-respuestas\\-evaluadores/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_pdf-respuestas-evaluadores')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::pdfRespuestasEvaluadoresAction',));
            }

            // admin_equipoevaluador_form-evaluacion
            if (0 === strpos($pathinfo, '/admin/equipoevaluador/formulario-evaluacion') && preg_match('#^/admin/equipoevaluador/formulario\\-evaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_admin_equipoevaluador_formevaluacion;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_form-evaluacion')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::formEvaluacionAction',));
            }
            not_admin_equipoevaluador_formevaluacion:

            if (0 === strpos($pathinfo, '/admin/equipoevaluador/envio-formulario-evaluacion')) {
                // admin_equipoevaluador_envio-form-evaluacion
                if (preg_match('#^/admin/equipoevaluador/envio\\-formulario\\-evaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_equipoevaluador_envioformevaluacion;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_envio-form-evaluacion')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::envioFormEvaluacionAction',));
                }
                not_admin_equipoevaluador_envioformevaluacion:

                // admin_equipoevaluador_envio-form-evaluacion-post-visita
                if (0 === strpos($pathinfo, '/admin/equipoevaluador/envio-formulario-evaluacion-post-visita') && preg_match('#^/admin/equipoevaluador/envio\\-formulario\\-evaluacion\\-post\\-visita/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_equipoevaluador_envioformevaluacionpostvisita;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_envio-form-evaluacion-post-visita')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::envioFormEvaluacionPostVisitaAction',));
                }
                not_admin_equipoevaluador_envioformevaluacionpostvisita:

            }

            // admin_equipoevaluador_show-form-evaluacion
            if (0 === strpos($pathinfo, '/admin/equipoevaluador/show-formulario-evaluacion') && preg_match('#^/admin/equipoevaluador/show\\-formulario\\-evaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_equipoevaluador_showformevaluacion;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_show-form-evaluacion')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::showFormEvaluacionAction',));
            }
            not_admin_equipoevaluador_showformevaluacion:

            // admin_equipoevaluador_pdf-formulario-evaluacion
            if (0 === strpos($pathinfo, '/admin/equipoevaluador/pdf-formulario-evaluacion') && preg_match('#^/admin/equipoevaluador/pdf\\-formulario\\-evaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_admin_equipoevaluador_pdfformularioevaluacion;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_equipoevaluador_pdf-formulario-evaluacion')), array (  '_controller' => 'AppBundle\\Controller\\EquipoEvaluadorController::pdfFormularioEvaluacionAction',));
            }
            not_admin_equipoevaluador_pdfformularioevaluacion:

        }

        if (0 === strpos($pathinfo, '/evaluador')) {
            // evaluador_index
            if (rtrim($pathinfo, '/') === '/evaluador') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_evaluador_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'evaluador_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::indexAction',  '_route' => 'evaluador_index',);
            }
            not_evaluador_index:

            // evaluador_new
            if ($pathinfo === '/evaluador/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_evaluador_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::newAction',  '_route' => 'evaluador_new',);
            }
            not_evaluador_new:

            // evaluador_registered
            if (preg_match('#^/evaluador/(?P<id>[^/]++)/registered$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'evaluador_registered')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::registeredMessageAction',));
            }

            // evaluador_show
            if (preg_match('#^/evaluador/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_evaluador_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'evaluador_show')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::showAction',));
            }
            not_evaluador_show:

            // evaluador_pdf
            if (preg_match('#^/evaluador/(?P<id>[^/]++)/pdf$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_evaluador_pdf;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'evaluador_pdf')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::pdfAction',));
            }
            not_evaluador_pdf:

            // evaluador_list_pdf
            if ($pathinfo === '/evaluador/pdf') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_evaluador_list_pdf;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::listPdfAction',  '_route' => 'evaluador_list_pdf',);
            }
            not_evaluador_list_pdf:

            // evaluador_edit
            if (preg_match('#^/evaluador/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_evaluador_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'evaluador_edit')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::editAction',));
            }
            not_evaluador_edit:

            // evaluador_delete
            if (preg_match('#^/evaluador/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_evaluador_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'evaluador_delete')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::deleteAction',));
            }
            not_evaluador_delete:

            // evaluador_panel
            if ($pathinfo === '/evaluador/panel') {
                return array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::panelAction',  '_route' => 'evaluador_panel',);
            }

            // evaluador_inscripcion-permio-actual
            if (preg_match('#^/evaluador/(?P<id>[^/]++)/inscripcion\\-premio\\-actual$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_evaluador_inscripcionpermioactual;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'evaluador_inscripcion-permio-actual')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::inscripcionPremioActualAction',));
            }
            not_evaluador_inscripcionpermioactual:

            // app_evaluador_pruebaemail
            if (preg_match('#^/evaluador/(?P<id>[^/]++)/prueba\\-email$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_evaluador_pruebaemail')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorController::pruebaEmailAction',));
            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            if (0 === strpos($pathinfo, '/admin/evaluadorpremio')) {
                // admin_evaluadorpremio_index
                if (rtrim($pathinfo, '/') === '/admin/evaluadorpremio') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_evaluadorpremio_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_evaluadorpremio_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::indexAction',  '_route' => 'admin_evaluadorpremio_index',);
                }
                not_admin_evaluadorpremio_index:

                // admin_evaluadorpremio_show
                if (preg_match('#^/admin/evaluadorpremio/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_evaluadorpremio_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_evaluadorpremio_show')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::showAction',));
                }
                not_admin_evaluadorpremio_show:

                // admin_evaluadorpremio_pdf
                if (preg_match('#^/admin/evaluadorpremio/(?P<id>[^/]++)/pdf$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_evaluadorpremio_pdf;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_evaluadorpremio_pdf')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::pdfAction',));
                }
                not_admin_evaluadorpremio_pdf:

                // admin_evaluadorpremio_list_pdf
                if ($pathinfo === '/admin/evaluadorpremio/pdf') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_evaluadorpremio_list_pdf;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::listPdfAction',  '_route' => 'admin_evaluadorpremio_list_pdf',);
                }
                not_admin_evaluadorpremio_list_pdf:

                // admin_evaluadorpremio_edit
                if (preg_match('#^/admin/evaluadorpremio/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_evaluadorpremio_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_evaluadorpremio_edit')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::editAction',));
                }
                not_admin_evaluadorpremio_edit:

                // admin_evaluadorpremio_delete
                if (preg_match('#^/admin/evaluadorpremio/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_admin_evaluadorpremio_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_evaluadorpremio_delete')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::deleteAction',));
                }
                not_admin_evaluadorpremio_delete:

                // admin_evaluadorpremio_list_excel
                if (0 === strpos($pathinfo, '/admin/evaluadorpremio/evaluadores') && preg_match('#^/admin/evaluadorpremio/evaluadores(?:\\.(?P<_format>csv|xls|xlsx))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_evaluadorpremio_list_excel')), array (  '_format' => 'xlsx',  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::listExcelAction',));
                }

                // admin_evaluadorpremio_form-evaluacion
                if (0 === strpos($pathinfo, '/admin/evaluadorpremio/formulario-evaluacion') && preg_match('#^/admin/evaluadorpremio/formulario\\-evaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_evaluadorpremio_formevaluacion;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_evaluadorpremio_form-evaluacion')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::formEvaluacionAction',));
                }
                not_admin_evaluadorpremio_formevaluacion:

                // admin_evaluadorpremio_envio-form-evaluacion
                if (0 === strpos($pathinfo, '/admin/evaluadorpremio/envio-formulario-evaluacion') && preg_match('#^/admin/evaluadorpremio/envio\\-formulario\\-evaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_evaluadorpremio_envioformevaluacion;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_evaluadorpremio_envio-form-evaluacion')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::envioFormEvaluacionAction',));
                }
                not_admin_evaluadorpremio_envioformevaluacion:

                // admin_evaluadorpremio_show-form-evaluacion
                if (0 === strpos($pathinfo, '/admin/evaluadorpremio/show-formulario-evaluacion') && preg_match('#^/admin/evaluadorpremio/show\\-formulario\\-evaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_evaluadorpremio_showformevaluacion;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_evaluadorpremio_show-form-evaluacion')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::showFormEvaluacionAction',));
                }
                not_admin_evaluadorpremio_showformevaluacion:

                // admin_evaluadorpremio_pdf-formulario-evaluacion
                if (0 === strpos($pathinfo, '/admin/evaluadorpremio/pdf-formulario-evaluacion') && preg_match('#^/admin/evaluadorpremio/pdf\\-formulario\\-evaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_evaluadorpremio_pdfformularioevaluacion;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_evaluadorpremio_pdf-formulario-evaluacion')), array (  '_controller' => 'AppBundle\\Controller\\EvaluadorPremioController::pdfFormularioEvaluacionAction',));
                }
                not_admin_evaluadorpremio_pdfformularioevaluacion:

            }

            if (0 === strpos($pathinfo, '/admin/formularioevaluacion')) {
                // admin_formularioevaluacion_index
                if (rtrim($pathinfo, '/') === '/admin/formularioevaluacion') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_formularioevaluacion_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_formularioevaluacion_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\FormularioEvaluacionController::indexAction',  '_route' => 'admin_formularioevaluacion_index',);
                }
                not_admin_formularioevaluacion_index:

                // admin_formularioevaluacion_new
                if ($pathinfo === '/admin/formularioevaluacion/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_formularioevaluacion_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\FormularioEvaluacionController::newAction',  '_route' => 'admin_formularioevaluacion_new',);
                }
                not_admin_formularioevaluacion_new:

                // admin_formularioevaluacion_show
                if (preg_match('#^/admin/formularioevaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_formularioevaluacion_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_formularioevaluacion_show')), array (  '_controller' => 'AppBundle\\Controller\\FormularioEvaluacionController::showAction',));
                }
                not_admin_formularioevaluacion_show:

                // admin_formularioevaluacion_edit
                if (preg_match('#^/admin/formularioevaluacion/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_formularioevaluacion_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_formularioevaluacion_edit')), array (  '_controller' => 'AppBundle\\Controller\\FormularioEvaluacionController::editAction',));
                }
                not_admin_formularioevaluacion_edit:

                // admin_formularioevaluacion_delete
                if (preg_match('#^/admin/formularioevaluacion/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_admin_formularioevaluacion_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_formularioevaluacion_delete')), array (  '_controller' => 'AppBundle\\Controller\\FormularioEvaluacionController::deleteAction',));
                }
                not_admin_formularioevaluacion_delete:

            }

            if (0 === strpos($pathinfo, '/admin/idioma')) {
                // admin_idioma_index
                if (rtrim($pathinfo, '/') === '/admin/idioma') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_idioma_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_idioma_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\IdiomaController::indexAction',  '_route' => 'admin_idioma_index',);
                }
                not_admin_idioma_index:

                // admin_idioma_new
                if ($pathinfo === '/admin/idioma/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_idioma_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\IdiomaController::newAction',  '_route' => 'admin_idioma_new',);
                }
                not_admin_idioma_new:

                // admin_idioma_show
                if (preg_match('#^/admin/idioma/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_idioma_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_idioma_show')), array (  '_controller' => 'AppBundle\\Controller\\IdiomaController::showAction',));
                }
                not_admin_idioma_show:

                // admin_idioma_edit
                if (preg_match('#^/admin/idioma/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_idioma_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_idioma_edit')), array (  '_controller' => 'AppBundle\\Controller\\IdiomaController::editAction',));
                }
                not_admin_idioma_edit:

                // admin_idioma_delete
                if (preg_match('#^/admin/idioma/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_admin_idioma_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_idioma_delete')), array (  '_controller' => 'AppBundle\\Controller\\IdiomaController::deleteAction',));
                }
                not_admin_idioma_delete:

                // admin_idioma_select2_search
                if ($pathinfo === '/admin/idioma/select2/search') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_idioma_select2_search;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\IdiomaController::select2SearchAction',  '_route' => 'admin_idioma_select2_search',);
                }
                not_admin_idioma_select2_search:

            }

            if (0 === strpos($pathinfo, '/admin/localidad')) {
                // admin_localidad_index
                if (rtrim($pathinfo, '/') === '/admin/localidad') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_localidad_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_localidad_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\LocalidadController::indexAction',  '_route' => 'admin_localidad_index',);
                }
                not_admin_localidad_index:

                // admin_localidad_new
                if ($pathinfo === '/admin/localidad/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_localidad_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\LocalidadController::newAction',  '_route' => 'admin_localidad_new',);
                }
                not_admin_localidad_new:

                // admin_localidad_show
                if (preg_match('#^/admin/localidad/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_localidad_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_localidad_show')), array (  '_controller' => 'AppBundle\\Controller\\LocalidadController::showAction',));
                }
                not_admin_localidad_show:

                // admin_localidad_edit
                if (preg_match('#^/admin/localidad/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_localidad_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_localidad_edit')), array (  '_controller' => 'AppBundle\\Controller\\LocalidadController::editAction',));
                }
                not_admin_localidad_edit:

                // admin_localidad_delete
                if (preg_match('#^/admin/localidad/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_admin_localidad_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_localidad_delete')), array (  '_controller' => 'AppBundle\\Controller\\LocalidadController::deleteAction',));
                }
                not_admin_localidad_delete:

                // admin_localidad_select2_search
                if ($pathinfo === '/admin/localidad/select2/search') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_localidad_select2_search;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\LocalidadController::select2SearchAction',  '_route' => 'admin_localidad_select2_search',);
                }
                not_admin_localidad_select2_search:

            }

        }

        if (0 === strpos($pathinfo, '/organizacion')) {
            // app_organizacion_pruebaemail
            if (preg_match('#^/organizacion/(?P<id>[^/]++)/prueba\\-email$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_organizacion_pruebaemail')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionController::pruebaEmailAction',));
            }

            if (0 === strpos($pathinfo, '/organizacionp')) {
                if (0 === strpos($pathinfo, '/organizacionprivada')) {
                    // organizacionprivada_index
                    if (rtrim($pathinfo, '/') === '/organizacionprivada') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_organizacionprivada_index;
                        }

                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'organizacionprivada_index');
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPrivadaController::indexAction',  '_route' => 'organizacionprivada_index',);
                    }
                    not_organizacionprivada_index:

                    // organizacionprivada_new
                    if ($pathinfo === '/organizacionprivada/new') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_organizacionprivada_new;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPrivadaController::newAction',  '_route' => 'organizacionprivada_new',);
                    }
                    not_organizacionprivada_new:

                    // organizacionprivada_enrolled
                    if (preg_match('#^/organizacionprivada/(?P<id>[^/]++)/enrolled$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionprivada_enrolled')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPrivadaController::enrolledMessageAction',));
                    }

                    // organizacionprivada_show
                    if (preg_match('#^/organizacionprivada/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_organizacionprivada_show;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionprivada_show')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPrivadaController::showAction',));
                    }
                    not_organizacionprivada_show:

                    // organizacionprivada_edit
                    if (preg_match('#^/organizacionprivada/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_organizacionprivada_edit;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionprivada_edit')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPrivadaController::editAction',));
                    }
                    not_organizacionprivada_edit:

                    // organizacionprivada_delete
                    if (preg_match('#^/organizacionprivada/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_organizacionprivada_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionprivada_delete')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPrivadaController::deleteAction',));
                    }
                    not_organizacionprivada_delete:

                    // organizacionprivada_pdf
                    if (preg_match('#^/organizacionprivada/(?P<id>[^/]++)/pdf$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_organizacionprivada_pdf;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionprivada_pdf')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPrivadaController::pdfAction',));
                    }
                    not_organizacionprivada_pdf:

                    // organizacionprivada_list_pdf
                    if ($pathinfo === '/organizacionprivada/pdf') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_organizacionprivada_list_pdf;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPrivadaController::listPdfAction',  '_route' => 'organizacionprivada_list_pdf',);
                    }
                    not_organizacionprivada_list_pdf:

                    // organizacionprivada_list_excel
                    if (0 === strpos($pathinfo, '/organizacionprivada/organizaciones-privadas') && preg_match('#^/organizacionprivada/organizaciones\\-privadas(?:\\.(?P<_format>csv|xls|xlsx))?$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionprivada_list_excel')), array (  '_format' => 'xlsx',  '_controller' => 'AppBundle\\Controller\\OrganizacionPrivadaController::listExcelAction',));
                    }

                }

                if (0 === strpos($pathinfo, '/organizacionpublica')) {
                    // organizacionpublica_index
                    if (rtrim($pathinfo, '/') === '/organizacionpublica') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_organizacionpublica_index;
                        }

                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'organizacionpublica_index');
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPublicaController::indexAction',  '_route' => 'organizacionpublica_index',);
                    }
                    not_organizacionpublica_index:

                    // organizacionpublica_new
                    if ($pathinfo === '/organizacionpublica/new') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_organizacionpublica_new;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPublicaController::newAction',  '_route' => 'organizacionpublica_new',);
                    }
                    not_organizacionpublica_new:

                    // organizacionpublica_enrolled
                    if (preg_match('#^/organizacionpublica/(?P<id>[^/]++)/enrolled$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionpublica_enrolled')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPublicaController::enrolledMessageAction',));
                    }

                    // organizacionpublica_show
                    if (preg_match('#^/organizacionpublica/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_organizacionpublica_show;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionpublica_show')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPublicaController::showAction',));
                    }
                    not_organizacionpublica_show:

                    // organizacionpublica_pdf
                    if (preg_match('#^/organizacionpublica/(?P<id>[^/]++)/pdf$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_organizacionpublica_pdf;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionpublica_pdf')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPublicaController::pdfAction',));
                    }
                    not_organizacionpublica_pdf:

                    // organizacionpublica_list_pdf
                    if ($pathinfo === '/organizacionpublica/pdf') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_organizacionpublica_list_pdf;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPublicaController::listPdfAction',  '_route' => 'organizacionpublica_list_pdf',);
                    }
                    not_organizacionpublica_list_pdf:

                    // organizacionpublica_edit
                    if (preg_match('#^/organizacionpublica/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_organizacionpublica_edit;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionpublica_edit')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPublicaController::editAction',));
                    }
                    not_organizacionpublica_edit:

                    // organizacionpublica_delete
                    if (preg_match('#^/organizacionpublica/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_organizacionpublica_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionpublica_delete')), array (  '_controller' => 'AppBundle\\Controller\\OrganizacionPublicaController::deleteAction',));
                    }
                    not_organizacionpublica_delete:

                    // organizacionpublica_list_excel
                    if (0 === strpos($pathinfo, '/organizacionpublica/organizaciones-publicas') && preg_match('#^/organizacionpublica/organizaciones\\-publicas(?:\\.(?P<_format>csv|xls|xlsx))?$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'organizacionpublica_list_excel')), array (  '_format' => 'xlsx',  '_controller' => 'AppBundle\\Controller\\OrganizacionPublicaController::listExcelAction',));
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            if (0 === strpos($pathinfo, '/admin/pr')) {
                if (0 === strpos($pathinfo, '/admin/premio')) {
                    // admin_premio_index
                    if (rtrim($pathinfo, '/') === '/admin/premio') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_admin_premio_index;
                        }

                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'admin_premio_index');
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\PremioController::indexAction',  '_route' => 'admin_premio_index',);
                    }
                    not_admin_premio_index:

                    // admin_premio_new
                    if ($pathinfo === '/admin/premio/new') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_admin_premio_new;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\PremioController::newAction',  '_route' => 'admin_premio_new',);
                    }
                    not_admin_premio_new:

                    // admin_premio_show
                    if (preg_match('#^/admin/premio/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_premio_show;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_premio_show')), array (  '_controller' => 'AppBundle\\Controller\\PremioController::showAction',));
                    }
                    not_admin_premio_show:

                    // admin_premio_edit
                    if (preg_match('#^/admin/premio/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_admin_premio_edit;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_premio_edit')), array (  '_controller' => 'AppBundle\\Controller\\PremioController::editAction',));
                    }
                    not_admin_premio_edit:

                    // admin_premio_delete
                    if (preg_match('#^/admin/premio/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_admin_premio_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_premio_delete')), array (  '_controller' => 'AppBundle\\Controller\\PremioController::deleteAction',));
                    }
                    not_admin_premio_delete:

                }

                if (0 === strpos($pathinfo, '/admin/provincia')) {
                    // admin_provincia_index
                    if (rtrim($pathinfo, '/') === '/admin/provincia') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_admin_provincia_index;
                        }

                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'admin_provincia_index');
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\ProvinciaController::indexAction',  '_route' => 'admin_provincia_index',);
                    }
                    not_admin_provincia_index:

                    // admin_provincia_new
                    if ($pathinfo === '/admin/provincia/new') {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_admin_provincia_new;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\ProvinciaController::newAction',  '_route' => 'admin_provincia_new',);
                    }
                    not_admin_provincia_new:

                    // admin_provincia_show
                    if (preg_match('#^/admin/provincia/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_provincia_show;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_provincia_show')), array (  '_controller' => 'AppBundle\\Controller\\ProvinciaController::showAction',));
                    }
                    not_admin_provincia_show:

                    // admin_provincia_edit
                    if (preg_match('#^/admin/provincia/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                            goto not_admin_provincia_edit;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_provincia_edit')), array (  '_controller' => 'AppBundle\\Controller\\ProvinciaController::editAction',));
                    }
                    not_admin_provincia_edit:

                    // admin_provincia_delete
                    if (preg_match('#^/admin/provincia/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_admin_provincia_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_provincia_delete')), array (  '_controller' => 'AppBundle\\Controller\\ProvinciaController::deleteAction',));
                    }
                    not_admin_provincia_delete:

                }

            }

            if (0 === strpos($pathinfo, '/admin/titulouniversitario')) {
                // admin_titulouniversitario_index
                if (rtrim($pathinfo, '/') === '/admin/titulouniversitario') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_titulouniversitario_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_titulouniversitario_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\TituloUniversitarioController::indexAction',  '_route' => 'admin_titulouniversitario_index',);
                }
                not_admin_titulouniversitario_index:

                // admin_titulouniversitario_new
                if ($pathinfo === '/admin/titulouniversitario/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_titulouniversitario_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\TituloUniversitarioController::newAction',  '_route' => 'admin_titulouniversitario_new',);
                }
                not_admin_titulouniversitario_new:

                // admin_titulouniversitario_show
                if (preg_match('#^/admin/titulouniversitario/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_titulouniversitario_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_titulouniversitario_show')), array (  '_controller' => 'AppBundle\\Controller\\TituloUniversitarioController::showAction',));
                }
                not_admin_titulouniversitario_show:

                // admin_titulouniversitario_edit
                if (preg_match('#^/admin/titulouniversitario/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_admin_titulouniversitario_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_titulouniversitario_edit')), array (  '_controller' => 'AppBundle\\Controller\\TituloUniversitarioController::editAction',));
                }
                not_admin_titulouniversitario_edit:

                // admin_titulouniversitario_delete
                if (preg_match('#^/admin/titulouniversitario/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_admin_titulouniversitario_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_titulouniversitario_delete')), array (  '_controller' => 'AppBundle\\Controller\\TituloUniversitarioController::deleteAction',));
                }
                not_admin_titulouniversitario_delete:

                // admin_titulouniversitario_select2_search
                if ($pathinfo === '/admin/titulouniversitario/select2/search') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_admin_titulouniversitario_select2_search;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\TituloUniversitarioController::select2SearchAction',  '_route' => 'admin_titulouniversitario_select2_search',);
                }
                not_admin_titulouniversitario_select2_search:

            }

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_security_login;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }
                not_fos_user_security_login:

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_security_logout;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }
            not_fos_user_security_logout:

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ($pathinfo === '/profile/edit') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_profile_edit;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
            }
            not_fos_user_profile_edit:

        }

        if (0 === strpos($pathinfo, '/resetting')) {
            // fos_user_resetting_request
            if ($pathinfo === '/resetting/request') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_request;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_resetting_send_email;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_check_email;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
            }
            not_fos_user_resetting_check_email:

            // fos_user_resetting_reset
            if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_resetting_reset;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
            }
            not_fos_user_resetting_reset:

        }

        // fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
