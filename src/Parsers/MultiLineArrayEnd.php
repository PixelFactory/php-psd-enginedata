<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class MultiLineArrayEnd extends Parser {


    public function expression()
    {
        return '/^\]$/';
    }

    public function parse( Node $node, $line, $matches )
    {
        $node->parentNode();
        self::$multiLineArray = false;
    }
}