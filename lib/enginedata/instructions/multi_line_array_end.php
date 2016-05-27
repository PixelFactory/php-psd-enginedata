<?php
class MultiLineArrayEnd extends Instruction{
    static function token()
    {
    return '/^\]$/';
    }

    public function execute()
    {
        list($property, $node) = $this->document->stack_pop();
        $this->document->update_node($property, $node);
        return $this->document->set_node( $node );
    }
}
//
//# -*- encoding : utf-8 -*-
//class PSD
//  class EngineData
//    class Instruction
//      class MultiLineArrayEnd < Instruction
//        def self.token; /^\]$/; end
//
//        def execute!
//          property, node = stack_pop
//          update_node(property, node)
//          set_node node
//        end
//      end
//    end
//  end
//end
