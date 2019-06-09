# PSD EngineData [![SymfonyInsight](https://insight.symfony.com/projects/492a4fae-b5a6-4091-bac3-1123ed7c9f87/small.svg)](https://insight.symfony.com/projects/492a4fae-b5a6-4091-bac3-1123ed7c9f87)
[![Build Status](https://travis-ci.com/LoginovIlya/php-psd-enginedata.svg?branch=master)](https://travis-ci.com/LoginovIlya/php-psd-enginedata)
![Coveralls github](https://img.shields.io/coveralls/github/LoginovIlya/php-psd-enginedata.svg)

Parser [enginedata](https://github.com/layervault/psd-enginedata) on php

## Installation
Add this line to your application's composer.json in require block:
```
"loginovilya/php-psd-enginedata": "^2.0"
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
