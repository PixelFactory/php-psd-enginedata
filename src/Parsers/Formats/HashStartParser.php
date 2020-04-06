<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Node;
use Enginedata\Parsers\Parser;

class HashStartParser extends Parser {


    public function expression(): string
    {
        return '/^<<$/';
    }

    protected function parse( Node $node, $line, $matches )
    {
        $node->addNode(self::$multiLineArray === 1);
        self::$multiLineArray++;
    }
}