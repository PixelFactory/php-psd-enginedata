<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Node;
use Enginedata\Parsers\Parser;

class EmptyStringParser extends Parser
{
    public function expression(): string
    {
        return '/^$/i';
    }

    protected function parse(Node $node, $line, $matches)
    {
    }
}
