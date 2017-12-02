<?php

namespace Enginedata;

use Enginedata\Node;

abstract class Parser{

    protected static $multiLineArray = false;


    abstract public function expression();

    abstract protected function parse( Node $node, $line, $matches );

    public function convertToNumber( $num )
    {
        $dot = strpos( $num, '.' );

        if( $dot === false ){
            // Format XX or -XX
            return (int)$num;
        }elseif( $dot === 0 ){
            // Format .XX
            return (float)('0' . $num);
        }else{
            // Format XX.XX or -XX.XX
            return (float)$num;
        }

    }

    /**
     * @param \Enginedata\Node $node
     * @param $line
     * @return bool
     */
    public function startParsing( Node $node, $line ){

        $status = @preg_match( $this->expression() , $line, $matches );

        if( $status === 1 )
        {
            $this->parse( $node, $line, $matches );
            return true;
        }else{
            return false;
        }
    }


}