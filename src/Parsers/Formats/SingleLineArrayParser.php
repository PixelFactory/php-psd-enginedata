<?php

namespace Enginedata\Parsers\Formats;

use Enginedata\Node;
use Enginedata\Parsers\NumbersParser;

class SingleLineArrayParser extends NumbersParser {


    public function expression(): string
    {
        return '/^([A-Z0-9]+) \[(.*)\]$/i';
    }

    protected function parse( Node $node, $line, $matches )
    {
        $name = $matches[1];
        $values = explode(' ', trim( $matches[2] ) );
        $value = [];

        foreach( $values as $num )
        {
            $value[] = $this->convertToNumber($num);
        }

        $node->setValue($name, $value);
    }
}