<?php

namespace Enginedata\Parsers;

abstract class NumbersParser extends Parser
{
    public function convertToNumber( string $num ): float
    {
        $dot = strpos( $num, '.' );

        if( $dot === false ){
            // Format XX or -XX
            return (float)$num;
        }elseif( $dot === 0 ){
            // Format .XX
            return (float)('0' . $num);
        }else{
            // Format XX.XX or -XX.XX
            return (float)$num;
        }

    }
}