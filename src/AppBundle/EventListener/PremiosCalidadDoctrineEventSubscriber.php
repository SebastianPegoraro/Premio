<?php

namespace AppBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Evaluador;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\CriterioEvaluacion;
use AppBundle\Entity\FormularioEvaluacion;
use AppBundle\Entity\EvaluadorPremio;
use AppBundle\Entity\EquipoEvaluador;
use AppBundle\Entity\Organizacion;

class PremiosCalidadDoctrineEventSubscriber implements EventSubscriber
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

    public function getSubscribedEvents()
    {
        return array(
            'preUpdate',
            'postUpdate',
        );
    }

    public function preUpdate(PreUpdateEventArgs $event) {
        $this->handleEvaluadorPremioPreUpdate($event);
    }

    public function postUpdate(LifecycleEventArgs $event)
    {
        $this->handleEvaluadorPostUpdate($event);
        $this->handleUsuarioPostUpdate($event);
        $this->handleEvaluadorPremioPostUpdate($event);
        $this->handleOrganizacionPostUpdate($event);
        $this->handleFormularioEvaluacionPostUpdate($event);
    }

    //Pre Update methods////////////////////////////////////////////////////////
    protected function handleEvaluadorPremioPreUpdate(PreUpdateEventArgs $event)
    {
        $entity = $event->getObject();

        if ($entity instanceof EvaluadorPremio) {
            if ($event->hasChangedField('estado')) {
                //si se pasa al estado activo, emitir un error.
                //solo puede pasar a este estado si 
                if ($event->getNewValue('estado') == EvaluadorPremio::ESTADO_ACTIVO) {
                    $exceptionMsg = sprintf(
                        'Solo se puede cambiar un evaluador al estado "%s", asignandole un equipo evaluador.',
                        EvaluadorPremio::ESTADO_ACTIVO
                    );
                    throw new \Exception($exceptionMsg);    
                }

                if ($event->getOldValue('estado') == EvaluadorPremio::ESTADO_ACTIVO) {
                    $entity->setEquipo(null);
                    $entity->setEsJefeDeEquipo(false);
                }
            }

            if ($event->hasChangedField('equipo')) {
                if ($event->getOldValue('equipo') instanceof EquipoEvaluador) {
                    $entity->setEsJefeDeEquipo(false);
                }
            }
        }
    }
    ////////////////////////////////////////////////////////////////////////////

    //PostUpdate Methods////////////////////////////////////////////////////////
    protected function handleEvaluadorPostUpdate(LifecycleEventArgs $event)
    {
    	$entity = $event->getObject();

    	if ($entity instanceof Evaluador) {
	    	$this->container->get('app.service.evaluador')
	    		->actualizarEmailDeUsuario($entity);
    	}
    }

    protected function handleUsuarioPostUpdate(LifecycleEventArgs $event)
    {
    	$entity = $event->getObject();

    	if ($entity instanceof Usuario) {
    		//Si se cambia el email de usuario tambien debo
    		//asignarle este email al evaluador si es que posee evaluador.
    		$evaluador = $entity->getEvaluador();

    		if ($evaluador) {
    			$evaluador->getContactoParticular()->setEmail($entity->getEmail());
    			$em = $event->getObjectManager();
    			$em->persist($evaluador);
    			$em->flush();
    		}
    	}
    }

    protected function handleEvaluadorPremioPostUpdate(LifecycleEventArgs $event)
    {
        $entity = $event->getObject();

        if ($entity instanceof EvaluadorPremio) {
            $em = $event->getObjectManager();
            $changeset = $em->getUnitOfWork()->getEntityChangeSet($entity);

            if (array_key_exists('equipo', $changeset)) {
                $oldValue = $changeset['equipo'][0];
                $newValue = $changeset['equipo'][1];

                $dqlStr = 'UPDATE AppBundle:EvaluadorPremio ep SET ep.estado = :estado WHERE ep.id = :id'; 

                //Si el evaluador cambia equipo y pasa al estado ACTIVO
                if ($newValue instanceof EquipoEvaluador) {
                    $query = $em->createQuery($dqlStr);
                    $query->setParameters(
                        array('estado' => EvaluadorPremio::ESTADO_ACTIVO, 'id' => $entity->getId())
                    );
                    $query->getResult();
                }

                //Si el evaluador tenía equipo y se lo saca debe pasar al estado APROBADO
                if ($oldValue instanceof EquipoEvaluador and !$newValue) {
                    $query = $em->createQuery($dqlStr);
                    $query->setParameters(
                        array('estado' => EvaluadorPremio::ESTADO_APROBADO, 'id' => $entity->getId())
                    );
                    $query->getResult();
                } 
            }
        }
    }

    protected function handleOrganizacionPostUpdate(LifecycleEventArgs $event)
    {
        $entity = $event->getObject();

        if ($entity instanceof Organizacion) {
            $em = $event->getObjectManager();
            $changeset = $em->getUnitOfWork()->getEntityChangeSet($entity);

            if (array_key_exists('estado', $changeset)) {
                $oldValue = $changeset['estado'][0];
                $newValue = $changeset['estado'][1];
                if ($oldValue == Organizacion::ESTADO_ACTIVO) {
                    $equipo = $entity->getEquipo();
                    if ($equipo) {
                        $query = $em->createQuery(
                            'UPDATE AppBundle:EvaluadorPremio ep SET ep.estado = :estado WHERE ep.equipo = :equipo'
                        );
                        $query->setParameters(
                            array('estado' => EvaluadorPremio::ESTADO_APROBADO, 'equipo' => $equipo)
                        );
                        $query->getResult();

                        $query = $em->createQuery(
                            'DELETE AppBundle:EquipoEvaluador ee WHERE ee.organizacion = :organizacion'
                        );
                        $query->setParameters(array('organizacion' => $entity));
                        $query->getResult();
                    }
                }
            }
        }
    }

    protected function handleFormularioEvaluacionPostUpdate(LifecycleEventArgs $event)
    {
        $entity = $event->getObject();

        if ($entity instanceof FormularioEvaluacion) {
            $this->updateCriteriosPuntajeMaximo($event);
        }
    }

    ////////////////////////////////////////////////////////////////////////////

    //Custom methods
    protected function calcularPuntaje($entity, $em)
    {
        $parent = $entity->getParent();

        if ($parent) {
            $parent->setPuntajeMaximo($this->getPuntajeMax($parent));
            $em->persist($parent);
            $em->flush();
        }
    }

    protected function getPuntajeMax(CriterioEvaluacion $entity)
    {
        $suma = 0;

        foreach ($entity->getChildren() as $c){
            $suma = $suma + $c->getPuntajeMaximo();
        }
        return $suma;
    }

    protected function updateCriteriosPuntajeMaximo(LifecycleEventArgs $event)
    {
        $entity = $event->getObject();
        $em = $event->getObjectManager();

        $criteriosWithChildren = $entity->getCriteriosEvaluacion()->filter(
            function($c) {
                return $c->getChildren()->count() > 0;
            }
        );

        //die(var_dump(count($criteriosWithChildren)));
        foreach ($criteriosWithChildren as $cwc) {
            $pm = 0;
            foreach ($cwc->getChildren() as $c) {
                $pm += $c->getPuntajeMaximo();
            }
            $cwc->setPuntajeMaximo($pm);
            $em->persist($cwc);
            $em->flush($cwc, false);
        }
    }
}