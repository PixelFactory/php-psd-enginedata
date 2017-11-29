# PSD EngineData

Parser [enginedata](https://github.com/layervault/psd-enginedata) on php

## Installation
Add this line to your application's composer.json in require block:
```
"loginovilya/php-psd-enginedata": "^1.0"
```
And then execute:
```
$ composer install
```
Or install it yourself as:
```
$ composer require loginovilya/php-psd-enginedata
```
## Usage
```php
<?php

require "vendor/autoload.php";

use Enginedata\Enginedata;

$parser = Enginedata::load('filename');

$data = $parser->parse();

var_dump($data);
```