<?php

class Mailgun_Application_Resource_Mailgun
	extends \Zend_Application_Resource_ResourceAbstract
{
	public function init()
	{
		$options = $this->getOptions();
		$transport = new Mailgun_Mail_Transport_Mailgun($options);

		Zend_Mail::setDefaultTransport($transport);
	}
}
