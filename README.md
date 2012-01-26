# Zend_Framework mail transport drop-in replacement for Mailgun
This is an easy way to send emails from within your Zend Framework application
over the Mailgun API.

All you have to do is get the repo and add the Mailgun folder to your project.

Also make sure to add these lines to your application.ini settings:

    ; ------------------------------------------------------------------------------
    ; Mailgun configuration
    ; ------------------------------------------------------------------------------
    
    autoloadernamespaces[] = "Mailgun_"
    pluginPaths.Mailgun_Application_Resource = "Mailgun/Application/Resource"
    resources.mailgun.key = "" ; Add your API key here
    resources.mailgun.domain = "" ; Add the domain you would like to send
		messages over here


## Todo

* Allow attachments
* Check if UTF-8 support is completely functional
* Allow to add additional config parameters that are available on
	http://documentation.mailgun.net/api-sending.html#api-sending-messages
