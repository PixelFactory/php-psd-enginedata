<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class Number extends Parser {


    public function expression()
    {
        return '/^([A-Z0-9]+) ((-?\d+)|\.(\d+)|(-?\d+)\.(\d+))$/i';
    }

    public function parse( Node $node, $line, $matches )
    {
        $name = $matches[1];
        $number = $this->convertToInt( $matches[2] );

        $node->setValue( $name, $number );
    }
}