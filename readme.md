Traitify Api PHP Library
===============
To Install Use Composer:
[https://getcomposer.org/doc/00-intro.md#globally](https://getcomposer.org/doc/00-intro.md#globally)

### This library is best used with Traitify JS
[http://traitify.github.io/traitify-js/](http://traitify.github.io/traitify-js/)

### Private Key Required
For instructions on obtaining a public key visit:
[https://developer.traitify.com](https://developer.traitify.com)

### Using The Traitify PHP Client Library:
#### Create an instance of the Client
```PHP
$client = new Traitify\Client([
  'host'=>'api-sandbox.traitify.com', /* Example Host */ 
  'version'=>'v1', /* Example Version */
  'privateKey'=>'34aeraw23-3a43a32-234a34as42' /* Example Private Key */
]);
$client->createAssessment("career-deck");
```

#### Get Slides
```PHP
$client = new Traitify\Client([
  'host'=>'api-sandbox.traitify.com', /* Example Host */ 
  'version'=>'v1', /* Example Version */
  'privateKey'=>'34aeraw23-3a43a32-234a34as42' /* Example Private Key */
]);
$client->getSlides('a45rasw3-45s3a32-234aas45'); /* Example Assessment Id */
```

### Contributing 
#### Building, Testing and Bundling:
Installing PHPUnit
[https://phpunit.de/manual/current/en/installation.html](https://phpunit.de/manual/current/en/installation.html)

```Shell
$ composer install
$ phpunit tests/traitify_client.ph
```
