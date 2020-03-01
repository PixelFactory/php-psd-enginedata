<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class HashNameParser extends Parser {

    public function expression(): string
    {
        return '/^([A-Z0-9]+)$/i';
    }

    protected function parse( Node $node, $line, $matches )
    {
        $node->setValue(trim($line));
    }
}