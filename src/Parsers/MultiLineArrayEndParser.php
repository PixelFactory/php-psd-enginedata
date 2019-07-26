<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class MultiLineArrayEndParser extends Parser {


    public function expression()
    {
        return '/^\]$/';
    }

    protected function parse( Node $node, $line, $matches )
    {
        $node->parentNode();
        self::$multiLineArray = 0;
    }
}