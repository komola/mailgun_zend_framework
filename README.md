# Zend Framework Mail transport drop in replacement for Mailgun
This is an easy way to send emails from within your Zend Framework application
using the Mailgun API.

It registers Mailgun as the default transport. All you have to do in your code
is to change the application config and add the Mailgun files to your libraries
folder.

Make these additions to your application.ini file:

    ; ------------------------------------------------------------------------------
    ; Mailgun configuration
    ; ------------------------------------------------------------------------------
    
    autoloadernamespaces[] = "Mailgun_"
    pluginPaths.Mailgun_Application_Resource = "Mailgun/Application/Resource"
    resources.mailgun.key = "" ; Add your API key here
    resources.mailgun.domain = "" ; Add the domain you would like to send
		messages over here

It will register a resource plugin that sets Mailgun as your default transport
for all emails.


## Todo

* Allow attachments
* Check if UTF-8 support is completely functional
* Allow to add additional config parameters that are available on
	http://documentation.mailgun.net/api-sending.html#api-sending-messages
