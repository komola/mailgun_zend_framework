<?php

class Mailgun_Mail_Transport_Mailgun extends Zend_Mail_Transport_Abstract
{
	protected $_options = array();

	public function __construct($options = array())
	{
		$this->_options = $options;
	}

	public function _sendMail()
	{
		$headers = $this->_mail->getHeaders();

		$mailgunHeaders = array();

		$headersToAdd = array("To", "Cc", "Bcc", "From", "Reply-To");

		foreach($headersToAdd as $currentHeader)
		{
			if(array_key_exists($currentHeader, $headers))
			{
				foreach($headers[$currentHeader] as $key => $value)
				{
					if(empty($key) || $key != "append")
					{
						$mailgunHeaders[$currentHeader][] = $value;
					}
				}

				reset($headers[$currentHeader]);
			}
			else
			{
				$mailgunHeaders[$currentHeader] = array();
			}
		}

		$postData = array(
			"from" => implode(",", $mailgunHeaders['From']),
			"to" => implode(",", $mailgunHeaders['To']),
			"cc" => implode(",", $mailgunHeaders['Cc']),
			"bcc" => implode(",", $mailgunHeaders['Bcc']),
			"subject" => $this->_mail->getSubject(),
		);

		if ($this->_mail->getBodyText()) {
			$part = $this->_mail->getBodyText();
			$part->encoding = false;
			$postData['text'] = $part->getContent();            
		}

		if ($this->_mail->getBodyHtml()) {
			$part = $this->_mail->getBodyHtml();
			$part->encoding = false;
			$postData['html'] = $part->getContent();
		}

		$url = "https://api.mailgun.net/v2/" . $this->_options['domain'] ."/messages";
		$client = new Zend_Http_Client();
		$client->setUri($url);
		$client->setMethod(Zend_Http_Client::POST);
		$client->setAuth("api", $this->_options['key']);

		foreach($postData as $key => $value)
		{
			if(empty($value)) 
			{
				continue;
			}

			$client->setParameterPost($key, $value);
		}

		$response = $client->request();

		Zend_Debug::dump($response->getStatus());
		Zend_Debug::dump($response);
	}
}
