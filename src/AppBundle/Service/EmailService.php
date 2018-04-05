<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class EmailService
{
	private $container;

	private $tmpDir;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->tmpDir = realpath(
			$this->container->getParameter('kernel.root_dir') . '/../var/tmp'
		);
	}

	/**
	 * Renders email html from templates
	 *
	 * @param string $emailTemplate
	 * @param array  $data array of data for the template rendering
	 *
	 * @return string
	 */
	protected function renderHtml($emailTemplate, $data)
	{
		return $this->container->get('templating')->render($emailTemplate, $data);
	}

	/**
	 * Attach files to email
	 *
	 * @param \Swift_Message $message Swift_Message object
	 *
	 * @param array          $files   array of file paths
	 */
	protected function attachFiles(\Swift_Message $message, array $files)
	{
		foreach ($files as $f) {
			if (file_exists($f) && is_file($f)) {
				$message->attach(\Swift_Attachment::fromPath($f));
			}
		}
	}

	/**
	 * Generates images data to embed to email
	 * The output must be pass to the of data for the template.
	 * The name of images is to be reference in the template.
	 *
	 * @param \Swift_Message $message Swift_Message object
	 * @param array $files Associative array: ('nombre1' => '/path/to/image', 'nombre2' => '/path/to/image2')
	 *
	 * @return array
	 */
	protected function generateImagesToEmbed(\Swift_Message $message, array $files)
	{
		$output = array();
		
		foreach ($files as $k => $f) {
			if (file_exists($f) && is_file($f)) {
				$output[$k] = $message->embed(\Swift_Image::fromPath($f));
			}
		}

		return $output;
	}

	/**
	 * Send Email
	 *
	 * @param string $to            recipient's email
	 * @param string $subject       Subject of email
	 * @param string $emailTemplate Email Template
	 * @param array  $data          Data for render email template
	 * @param array  $files         Files to attach
	 */
	public function sendEmail(
		$to, $subject, $emailTemplate, array $data = array(),
		array $files = array(), array $images = array(), $callback = null
	) {
		$message = \Swift_Message::newInstance();

		$from = $this->container->getParameter('mailer_user');

		//die(var_dump($images));

		$imagesForTamplate = $this->generateImagesToEmbed($message, $images);

		//die(var_dump($imagesForTamplate));

		$data = array_merge(
			$data,
			array('from' => $from, 'to' => $to, 'subject' => $subject),
			$imagesForTamplate
		);

		$html = $this->renderHtml($emailTemplate, $data);

	    $message
	    	->setSubject($subject)
	        ->setFrom($from)
	        ->setTo($to)
	        ->setBody($html,'text/html')
	    ;

	    $this->attachFiles($message, $files);

    	return $this->container->get('mailer')->send($message);
	}

	public function createImageEmail(
		$emailTemplate, array $data = array(), array $imageOptions = array()
	) {
		$html = $this->renderHtml($emailTemplate, $data);

		$fileName = md5(uniqid()) . '.png';

		$filePath = $this->tmpDir . '/' . $fileName;

		$this->container->get('knp_snappy.image')->generateFromHtml(
			$html, $filePath, $imageOptions
		);

		return $filePath;
	}
}
