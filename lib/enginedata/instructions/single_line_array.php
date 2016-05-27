<?php
class SingleLineArray extends Instruction{
    static function token()
    {
    return '/^\[(.*)\]$/';
    }

    public function execute()
    {
        $items = explode(" ", trim($this->match()[1]) );
        $data = array();

        foreach ($items as $val)
        {
            $data[] = $this->document->parse_tokens($val);
        }

        return $data;
    }
}
//
//# -*- encoding : utf-8 -*-
//class PSD
//  class EngineData
//    class Instruction
//      class SingleLineArray < Instruction
//        def self.token; /^\[(.*)\]$/; end
//
//        def execute!
//          items = match[1].strip.split(" ")
//          data = []
//
//          items.each do |item|
//            data << parse_tokens(item)
//          end
//
//          return data
//        end
//      end
//    end
//  end
//end
