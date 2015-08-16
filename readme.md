Traitify Api PHP Library
===============

This is a helper library for the Traitify API - https://developer.traitify.com/

### Installing via Composer

The recommended way to install the Traitify library is through [Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Add the library as a dependency
php composer.phar require traitify/client dev-master
```

or alternatively, you can add it directly to your `composer.json` file.

```json
{
    "require": {
        "traitify/client": "dev-master"
    }
}
```

Then install via Composer:

```bash
composer install
```

Finally, require Composer's autoloader in your PHP script:

```php
require __DIR__.'/vendor/autoload.php';
```

### This library is best used with Traitify JS
[http://traitify.github.io/traitify-js/](http://traitify.github.io/traitify-js/)

### Secret Key Required
For instructions on obtaining a public key visit:
[https://developer.traitify.com](https://developer.traitify.com)

### Using The Traitify PHP Client Library:
#### Create an instance of the Client
```PHP
$client = new Traitify\Client([
  'host'=>'api-sandbox.traitify.com', /* Example Host */ 
  'version'=>'v1', /* Example Version */
  'secretKey'=>'34aeraw23-3a43a32-234a34as42' /* Example Secret Key */
]);
$client->createAssessment("career-deck");
```

#### Get Slides
```PHP
$client = new Traitify\Client([
  'host'=>'api-sandbox.traitify.com', /* Example Host */ 
  'version'=>'v1', /* Example Version */
  'secretKey'=>'34aeraw23-3a43a32-234a34as42' /* Example Secret Key */
]);
$client->getSlides('a45rasw3-45s3a32-234aas45'); /* Example Assessment Id */
```

#### Get Decks
```PHP
$client = new Traitify\Client([
  'host'=>'api-sandbox.traitify.com', /* Example Host */ 
  'version'=>'v1', /* Example Version */
  'secretKey'=>'34aeraw23-3a43a32-234a34as42' /* Example Secret Key */
]);
$client->getDecks();
```

#### Get Personality Types
```PHP
$client = new Traitify\Client([
  'host'=>'api-sandbox.traitify.com', /* Example Host */ 
  'version'=>'v1', /* Example Version */
  'secretKey'=>'34aeraw23-3a43a32-234a34as42' /* Example Secret Key */
]);
$client->getPersonalityTypes('a45rasw3-45s3a32-234aas45'); /* Example Assessment Id */
```

#### Get Personality Traits
```PHP
$client = new Traitify\Client([
  'host'=>'api-sandbox.traitify.com', /* Example Host */ 
  'version'=>'v1', /* Example Version */
  'secretKey'=>'34aeraw23-3a43a32-234a34as42' /* Example Secret Key */
]);
$client->getPersonalityTraits('a45rasw3-45s3a32-234aas45'); /* Example Assessment Id */
```

### Contributing 
#### Building, Testing and Bundling:
Installing PHPUnit
[https://phpunit.de/manual/current/en/installation.html](https://phpunit.de/manual/current/en/installation.html)

```Shell
$ composer install
$ phpunit tests/traitify_client.php
```
