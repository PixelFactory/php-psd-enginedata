<?php
class MultiLineArrayStart extends Instruction{
    static function token()
    {
    return '/^\/(\w+) \[$/';
    }

    public function execute()
    {
        $this->document->stack_push( $this->match()[1] );
        $this->document->set_node( array() );
        return $this->document->set_property();
    }
}
//
//# -*- encoding : utf-8 -*-
//class PSD
//  class EngineData
//    class Instruction
//      class MultiLineArrayStart < Instruction
//        def self.token; /^\/(\w+) \[$/; end
//
//        def execute!
//          stack_push match[1]
//          set_node []
//          set_property
//        end
//      end
//    end
//  end
//end
