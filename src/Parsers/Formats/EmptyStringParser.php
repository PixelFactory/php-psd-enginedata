<?php

declare(strict_types=1);

namespace Enginedata\Parsers\Formats;

use Enginedata\Parsers\Parser;
use Enginedata\Interfaces\NodeInterface;

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
