<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Node;
use Enginedata\Parsers\Parser;

class MultiLineArrayStartParser extends Parser {


    public function expression(): string
    {
        return '/^([A-Z0-9]+) \[$/i';
    }

    protected function parse( Node $node, $line, $matches )
    {
        $name = $matches[1];
        $node->setValue($name);
        self::$multiLineArray = 1;
    }
}