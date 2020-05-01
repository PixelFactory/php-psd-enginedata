<?php

declare(strict_types=1);

namespace Enginedata\Parsers\Formats;

use Enginedata\Parsers\Parser;
use Enginedata\Interfaces\NodeInterface;

class HashNameParser extends Parser
{
    public function expression(): string
    {
        return '/^([A-Z0-9]+)$/i';
    }

    protected function parse(NodeInterface $node, $line, $matches)
    {
        static::$hashName = trim($line);
    }
}
