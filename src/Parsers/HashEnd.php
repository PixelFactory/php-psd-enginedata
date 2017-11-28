<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class HashEnd extends Parser {

    public function expression()
    {
        return '/^>>$/';
    }

    public function parse( Node $node, $line, $match )
    {
        $node->parentNode();
    }
}