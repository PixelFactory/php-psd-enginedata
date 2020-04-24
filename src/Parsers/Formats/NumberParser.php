<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\NodeInterface;
use Enginedata\Parsers\NumbersParser;

class NumberParser extends NumbersParser
{
    public function expression(): string
    {
        return '/^([A-Z0-9]+) ((-?\d+)|\.(\d+)|(-?\d+)\.(\d+))$/i';
    }

    protected function parse(NodeInterface $node, $line, $matches)
    {
        $name = $matches[1];
        $number = $this->convertToNumber($matches[2]);

        $node->setValue($name, $number);
    }
}
