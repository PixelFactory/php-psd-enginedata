<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class Boolean extends Parser {

    public function expression()
    {
        return '/^\t*([A-Z0-9]+) (true|false)$/i';
    }

    public function parse(Node $node, $line, $matches )
    {
        $name = $matches[1];
        $value = $matches[2] === 'true'? TRUE : FALSE;

        $node->setValue( $name, $value );
    }
}