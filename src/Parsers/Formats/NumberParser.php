<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Parsers\NumbersParser;
use Enginedata\Interfaces\NodeInterface;

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
