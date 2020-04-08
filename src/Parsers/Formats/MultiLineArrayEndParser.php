<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Node;
use Enginedata\Parsers\Parser;

class MultiLineArrayEndParser extends Parser
{
    public function expression(): string
    {
        return '/^\]$/';
    }

    protected function parse(Node $node, $line, $matches)
    {
        $node->parentNode();
        self::$multiLineArray = 0;
    }
}
