<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class HashEndParser extends Parser {

    public function expression(): string
    {
        return '/^>>$/';
    }

    protected function parse( Node $node, $line, $match )
    {
        $node->parentNode();
        self::$multiLineArray--;
    }
}