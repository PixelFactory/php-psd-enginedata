<?php

declare(strict_types=1);

namespace Enginedata\Parsers\Formats;

use Enginedata\Parsers\Parser;
use Enginedata\Interfaces\NodeInterface;

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
