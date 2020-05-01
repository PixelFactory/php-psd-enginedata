<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Parsers\Parser;
use Enginedata\Interfaces\NodeInterface;

class HashStartParser extends Parser
{
    public function expression(): string
    {
        return '/^<<$/';
    }

    protected function parse(NodeInterface $node, $line, $matches)
    {
        $node->addNode(static::$hashName);
        static::$hashName = null;
    }
}
