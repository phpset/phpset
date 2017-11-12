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

## Installing PHP7 & stuff
```shell
sudo -i

# Add repos
add-apt-repository ppa:ondrej/php
apt-get update

# PHP 7.1
apt-get install php7.1
```
