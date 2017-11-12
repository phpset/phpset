# PHPSet
Flexible Set of fast PHP packages. Instead Framework.

## Installing via composer create-project
```schell
composer create-project --prefer-dist --stability=dev phpset/phpset projectname
```
## Components (via composer)
```php

// check's old package versions
"roave/security-advisories": "dev-master",
// Fastroute router by Nikic
"phpset/fastroute-middleware": "dev-master#7288692",
// PDO helpers for Mysql & etc
"phpset/pdomodel": "dev-master#74d8c3b",
// Access to services via magic (Service Locator)
"phpset/injectable": "dev-master#691312f",
// PSR15 Middleware
"oscarotero/middleland": "0.4.*",
// Config container
"league/container": "2.4.*",
// Console tasks
"symfony/console": "3.4.x-dev",
// PSR7 Request & Response
"guzzlehttp/psr7": "1.4.*",
// Mysql migrations
"robmorgan/phinx": "0.9.*"
```

## Config files
```php
// routes.php - list of routes and controllers
['GET', '/aa', '\App\Http\Controllers\Example\InfoController::getInfo']

// commands.php - registration of console commands 
new \App\Example\InfoCommand('example:info'),

// env.php - service's config & global vars
'mysql' => [...],
'memcache' => [...],
'global_url' => 'some...',

// services.php - list of app services like memcache, mysql, redis instance and helpers
'mysql' => function ($env) {...},
'curlRequest' => new \App\Request\Curl(),    

// middleware.php - PSR15, mutual logic before and after controller
new Cors(),
new Auth(),
new Router(),
running controller and up

// models.php - database classes 1 per table
'vids' => \App\Vids\VidsModel
'users' => \App\Users\UsersModel

// phinx.php - database config for migrations
```

## Installing PHP7 & stuff
```shell
sudo -i

# Add repos
add-apt-repository ppa:ondrej/php
apt-get update

# PHP 7.1
apt-get install php7.1
```
