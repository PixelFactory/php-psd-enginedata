<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\NodeInterface;
use Enginedata\Parsers\NumbersParser;

class SingleLineArrayParser extends NumbersParser
{
    public function expression(): string
    {
        return '/^([A-Z0-9]+) \[(.*)\]$/i';
    }

    protected function parse(NodeInterface $node, $line, $matches)
    {
        $name = $matches[1];
        $values = explode(' ', trim($matches[2]));
        $value = [];

        foreach ($values as $num) {
            $value[] = $this->convertToNumber($num);
        }

        $node->setValue($name, $value);
    }
}
