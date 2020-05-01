<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Parsers\NumbersParser;
use Enginedata\Interfaces\NodeInterface;

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

        $node->addNode($name);

        foreach ($values as $num) {
            $node->addValue($this->convertToNumber($num));
        }

        $node->parentNode();
    }
}
