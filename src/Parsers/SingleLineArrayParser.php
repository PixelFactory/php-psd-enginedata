<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class SingleLineArrayParser extends Parser {


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