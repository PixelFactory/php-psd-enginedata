<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\NodeInterface;
use Enginedata\Parsers\Parser;

class MultiLineArrayEndParser extends Parser
{
    public function expression(): string
    {
        return '/^\]$/';
    }

    protected function parse(NodeInterface $node, $line, $matches)
    {
        $node->parentNode();
    }
}
