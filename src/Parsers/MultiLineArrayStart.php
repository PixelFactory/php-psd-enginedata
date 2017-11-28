<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class MultiLineArrayStart extends Parser {


    public function expression()
    {
        return '/^([A-Z0-9]+) \[$/i';
    }

    public function parse( Node $node, $line, $matches )
    {
        $name = $matches[1];
        $node->setValue($name);
        self::$multiLineArray = true;
    }
}