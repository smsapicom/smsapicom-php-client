# SMSAPI.com (International) PHP Client

PHP client which allows you to send SMS messages and manage your account in **SMSAPI.com**

```php
<?php

use SMSApi\Client;
use SMSApi\Api\SmsFactory;
use SMSApi\Exception\SmsapiException;

require_once 'vendor/autoload.php';

$client = new Client('login');
$client->setPasswordHash( 'your api password in md5' );

$smsapi = new SmsFactory;
$smsapi->setClient($client);

try {
	$actionSend = $smsapi->actionSend();

	$actionSend->setTo('44xxxxxxxxxxxx');
	$actionSend->setText('Hello World!!');
	$actionSend->setSender('Info');

	$response = $actionSend->execute();

	foreach ($response->getList() as $status) {
		echo $status->getNumber() . ' ' . $status->getPoints() . ' ' . $status->getStatus();
	}
} catch (SmsapiException $exception) {
	echo 'ERROR: ' . $exception->getMessage();
}
```

## Requirements

* PHP >= 5.3
* allow_url_fopen or curl extension

## Instalation

Add to `composer.json` in your project package:

```json
{
    "require": {
        "smsapi.com/php-client": "1.7.*"
    }
}
```

## License
[Apache 2.0 License](LICENSE)
