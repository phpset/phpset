# PHPSet
Flexible Set of fast PHP packages. Instead Framework.

## Quick start
```schell
composer create-project --prefer-dist --stability=dev phpset/phpset projectname
composer install --no-dev

# run php server + open in browser
open http://localhost:8000 && php -S localhost:8000 -t public_api 
```

## Whats inside? (composer.json)
```json
// check deprecated libs
"roave/security-advisories": "dev-master#2149b00"

// HTTP and routing
"guzzlehttp/psr7": "1.4.*"
"nikic/fast-route": "^1.3"
"oscarotero/middleland": "1.0"

// HTTP HTML templates
"twig/twig": "^2.9",

// Console tasks
"symfony/console": "^4.2",

// work with Mysql Database
"phpset/pdomodel": "dev-master#74d8c3b",
"robmorgan/phinx": "0.9.*", // migrations

// Connect with services like Mysql
"phpset/injectable": "dev-master#691312f",
```
Also public_api/index.php that composes all






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
