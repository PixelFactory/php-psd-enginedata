<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Parsers\Parser;
use Enginedata\Interfaces\NodeInterface;

class MultiLineArrayStartParser extends Parser
{
    public function expression(): string
    {
        return '/^([A-Z0-9]+) \[$/i';
    }

    protected function parse(NodeInterface $node, $line, $matches)
    {
        $name = $matches[1];

        $node->addNode($name);
    }
}
