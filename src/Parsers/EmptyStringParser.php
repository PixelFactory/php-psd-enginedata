<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class EmptyStringParser extends Parser {

    public function expression()
    {
        return '/^$/i';
    }

    protected function parse( Node $node, $line, $matches ) {}
}