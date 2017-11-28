<?php

namespace Enginedata\Parsers;

use Enginedata\Node;
use Enginedata\Parser;

class String extends Parser {

    public function expression()
    {
        return '/^([A-Z0-9]+) \(\xFE\xFF(.*)/i';
    }

    public function parse( Node $node, $line, $matches )
    {
        $name = $matches[1];

        // Delete last bracket
        $string_u16 = substr($matches[2], 0 , -1);
        // Convert sting
        $string_u8 = iconv('UTF-16BE', 'UTF-8', $string_u16);

        if( $string_u8 === false )
        {
            $str = $string_u16;
        }else{
            $str = trim($string_u8);
        }

        $node->setValue($name, $str);
    }
}