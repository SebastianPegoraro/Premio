<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\Filters\Bootstrap3DateFilterType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        if ($user){
            $sc = $this->get( 'security.authorization_checker' );

            if ($sc->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('adminpremio_index');
            }

            if ($sc->isGranted('ROLE_EVALUADOR') && $user->getEvaluador()) {
                return $this->redirectToRoute('evaluador_panel');
            }
        }
        // replace this example code with whatever you need
        $premioActual = $this->get('app.service.premio')->getPremioActual();
        return $this->render(
            'default/index.html.twig',
            array('premioActual' => $premioActual, )
        );
    }

    /**
     * @Route("/test", name="test")
     * @Method({ "GET", "POST" })
     */
    public function testAction(Request $request)
    {
        $premioActual = $this->get('app.service.premio')
            ->verificarSiExistePremioActual();

        $em = $this->getDoctrine()->getManager();

        $em->getRepository('AppBundle:EvaluadorPremio')->getObjects($premioActual);
    }

    /**
     * @Route("/test2", name="test_2")
     * @Method({ "GET", "POST" })
     */
    public function test2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $em->getRepository('AppBundle:OrganizacionPrivada')->getObjects();
    }
}
