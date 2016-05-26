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


//# -*- encoding : utf-8 -*-
//class PSD
//  class EngineData
//    # A single instruction as defined by the EngineData spec.
//    class Instruction
//      # The regex for the token, defaulted to nil. Override this.
//      def self.token; end
//
//      # Checks to see if the given text is a match for this token.
//      def self.match(text)
//        begin
//          token.match(text)
//        rescue Encoding::CompatibilityError
//          nil
//        end
//      end
//
//      # Stores a reference to the EngineData document and the current
//      # String being parsed.
//      def initialize(document, text)
//        @document = document
//        @text = text
//      end
//
//      # Returns the regex match to the current string.
//      def match
//        self.class.match @text
//      end
//
//      # Once matched, we execute the instruction and apply the changes
//      # to the parsed data.
//      def execute!; end
//
//      def method_missing(method, *args, &block)
//        if @document.respond_to?(method)
//          return @document.send(method, *args)
//        end
//
//        super
//      end
//    end
//  end
//end
