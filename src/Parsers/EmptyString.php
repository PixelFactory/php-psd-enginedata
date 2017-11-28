<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class EmptyString extends Parser {

    public function expression()
    {
        return '/^$/i';
    }

    public function parse( Node $node, $line, $matches ) {}
}