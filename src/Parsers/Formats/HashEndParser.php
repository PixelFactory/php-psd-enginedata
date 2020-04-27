<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\NodeInterface;
use Enginedata\Parsers\Parser;

class HashEndParser extends Parser
{
    public function expression(): string
    {
        return '/^>>$/';
    }

    protected function parse(NodeInterface $node, $line, $match)
    {
        $node->parentNode();
    }
}
