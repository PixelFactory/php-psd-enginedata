<?php

namespace Enginedata;


abstract class Parser{

    protected static int $multiLineArray = 0;

    abstract public function expression(): string;

    abstract protected function parse( Node $node, $line, $matches );

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

    /**
     * @param Node $node
     * @param $line
     * @return bool
     */
    public function startParsing( Node $node, $line )
    {
        $status = preg_match( $this->expression() , $line, $matches );

        if( $status === 1 )
        {
            $this->parse( $node, $line, $matches );
            return true;
        }else{
            return false;
        }
    }
}