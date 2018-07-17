# PHPSet
Flexible Set of fast PHP packages. Instead Framework.

## Quick start
```schell
composer create-project --prefer-dist --stability=dev phpset/phpset projectname
composer install --no-dev


php -S localhost:8000 -t public_api
# open in browser http://localhost:8000
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
