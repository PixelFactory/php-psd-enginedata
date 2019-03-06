<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class NumberParser extends Parser {


    public function expression()
    {
        return '/^([A-Z0-9]+) ((-?\d+)|\.(\d+)|(-?\d+)\.(\d+))$/i';
    }

    protected function parse( Node $node, $line, $matches )
    {
        $name = $matches[1];
        $number = $this->convertToNumber( $matches[2] );

        $node->setValue( $name, $number );
    }
}