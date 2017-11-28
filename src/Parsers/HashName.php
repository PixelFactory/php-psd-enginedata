<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class HashName extends Parser {

    public function expression()
    {
        return '/^([A-Z0-9]+)$/i';
    }

    public function parse( Node $node, $line, $matches )
    {
        $node->setValue($line);
    }
}