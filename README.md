# PHP client for http api onlinepbx.ru
Http api documentation [onlinepbx.ru](https://api.onlinepbx.ru/#page-nav-http)

Install
---------

### Manual
Download zip archive and require Autoloader.php
```php
require_once 'lib/Autoloader.php';
```
### Composer ([guide](https://packagist.org/))
Add require item to your project composer.json:
```json
"xtratio/onlinepbx-api": "~1.0"
```
or command line:
```sh
composer require xtratio/onlinepbx-api
```

Use
---------

```php
// Create new client object
$api = new xtratio\Onpbx\ApiClient(
            "yourdomain.onpbx.ru",
            "api key"
        );
        
// Get call history
$from = (new DateTime())->modify("-1 day")->format("r");
$to = (new DateTime())->format("r");
$result = $api->callHistory(array("date_from"=>$from,"date_to"=>$to));
```