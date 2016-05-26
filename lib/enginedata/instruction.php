<?php

class Instruction
{
    protected $document;
    protected $text;

    public static function token(){}

    public static function classMatch( $text )
    {
        $status = @preg_match(static::token() , $text, $matches);

        if($status === FALSE OR $status === 0)
            return null;
        else
            return $matches;
    }
    public function __construct( EngineData $document, $text )
    {
        $this->document = $document;
        $this->text = $text;
    }

    public function match()
    {
        return self::classMatch( $this->text );
    }
    public function execute(){}

    public function __call($method, $args)
    {
        if(method_exists($this->document, $method) === TRUE)
        {
            call_user_func_array(array($this->document, $method), $args);
        }else{
            // Super
            call_user_func_array('parent::'.__METHOD__.'()', array_unshift($args) );
        }
    }
}

