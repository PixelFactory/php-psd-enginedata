<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\NodeInterface;
use Enginedata\Parsers\Parser;

class HashNameParser extends Parser
{
    public function expression(): string
    {
        return '/^([A-Z0-9]+)$/i';
    }

    protected function parse(NodeInterface $node, $line, $matches)
    {
        $node->setValue(trim($line));
    }
}
