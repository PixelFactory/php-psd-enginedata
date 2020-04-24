<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\NodeInterface;
use Enginedata\Parsers\Parser;

class EmptyStringParser extends Parser
{
    public function expression(): string
    {
        return '/^$/i';
    }

    protected function parse(NodeInterface $node, $line, $matches)
    {
    }
}
