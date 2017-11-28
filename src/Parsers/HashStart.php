<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class HashStart extends Parser {


    public function expression()
    {
        return '/^<<$/';
    }

    public function parse( Node $node, $line, $matches )
    {
        $node->addNode(self::$multiLineArray);
    }
}