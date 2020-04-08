<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Node;
use Enginedata\Parsers\NumbersParser;

class NumberParser extends NumbersParser
{
    public function expression(): string
    {
        return '/^([A-Z0-9]+) ((-?\d+)|\.(\d+)|(-?\d+)\.(\d+))$/i';
    }

    protected function parse(Node $node, $line, $matches)
    {
        $name = $matches[1];
        $number = $this->convertToNumber($matches[2]);

        $node->setValue($name, $number);
    }
}
