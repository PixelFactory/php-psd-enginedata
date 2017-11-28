<?php

require "vendor/autoload.php";

use Enginedata\Enginedata;

$x = Enginedata::load('files/enginedata');

$w = $x->parse();

echo '<pre>';
var_dump($w);