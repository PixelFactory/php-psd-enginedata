<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class HashStartParser extends Parser {


    public function expression()
    {
        return '/^<<$/';
    }

    protected function parse( Node $node, $line, $matches )
    {
        $node->addNode(self::$multiLineArray === 1);
        self::$multiLineArray++;
    }
}