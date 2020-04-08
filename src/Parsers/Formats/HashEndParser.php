<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Node;
use Enginedata\Parsers\Parser;

class HashEndParser extends Parser
{
    public function expression(): string
    {
        return '/^>>$/';
    }

    protected function parse(Node $node, $line, $match)
    {
        $node->parentNode();
        self::$multiLineArray--;
    }
}
