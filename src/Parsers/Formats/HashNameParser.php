<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Node;
use Enginedata\Parsers\Parser;

class HashNameParser extends Parser
{
    public function expression(): string
    {
        return '/^([A-Z0-9]+)$/i';
    }

    protected function parse(Node $node, $line, $matches)
    {
        $node->setValue(trim($line));
    }
}
