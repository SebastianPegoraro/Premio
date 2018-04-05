<?php

namespace AppBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Vich\UploaderBundle\Event\Event;
use AppBundle\Entity\Evaluador;

class UploadedFileListener
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

    public function onPostUpload(Event $event)
    {
        $object = $event->getObject();
        
        $this->handleEvaluadorPostUpload($object);
    }

    protected function handleEvaluadorPostUpload($object)
    {
    	if ($object instanceof Evaluador) {
    		$fileAbsolutePath = $this->getUploadFilePath($object, 'imageFile');
    		$this->resizeImageFile($fileAbsolutePath);
    	}
    }

    private function getUploadFilePath($object, $fieldName)
    {
    	$webDir = $this->container->get('kernel')->getRootDir() . '/../web';
    	$UploadHelper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
    	return $webDir . $UploadHelper->asset($object, $fieldName);
    }

    /**
     * Rezises image
     * El cambio de tamaño se hace de la siguiente manera
     * si el ancho es mayor o igual al alto entonces redimensiona al ancho
     * en caso contrario al alto.
     *
     * @param Institucion $entity Institucion
     * @param int         $size   Ancho
     *
     * @return void
     */
    private function resizeImageFile($fileAbsolutePath, $size = 640)
    {
    	if (is_file($fileAbsolutePath) && file_exists($fileAbsolutePath) && $this->isImageFile($fileAbsolutePath)) {
            list($iWidth, $iHeight, $type, $attr) = getimagesize($fileAbsolutePath);

            if ($iWidth >= $iHeight) {
                if ($iWidth > $size) {
                    $this->container
                        ->get('image.handling')
                        ->open($fileAbsolutePath)
                        ->cropResize($size)
                        ->save($fileAbsolutePath);
                }
            } else {
                if ($iHeight > $size) {
                    $this->container
                        ->get('image.handling')
                        ->open($fileAbsolutePath)
                        ->cropResize(null, $size)
                        ->save($fileAbsolutePath);
                }
            }
    	}
    }

    private function isImageFile($fileAbsolutePath)
    {
        return getimagesize($fileAbsolutePath) ? true : false;
    }
}