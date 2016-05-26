<?php

require_once 'lib/enginedata.php';


$parser = EngineData::load('files/TEST2');

$parser->parse();

$data = $parser->getNode();


echo '<pre>';
var_dump($data);
echo '</pre>';

