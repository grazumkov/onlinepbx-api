# PHP client for http api onlinepbx.ru
Http api documentation [onlinepbx.ru](https://api.onlinepbx.ru/#page-nav-http)

Install
---------

Download and require Autoloader.php

```php
require_once 'lib/Autoloader.php';
```

Use
---------

```php
// Create new client object
$api = new Onpbx\ApiClient(
            "yourdomain.onpbx.ru",
            "api key"
        );
        
// Get call history
$from = (new DateTime())->modify("-1 day")->format("r");
$to = (new DateTime())->format("r");
$result = $api->callHistory(array("date_from"=>$from,"date_to"=>$to));
```