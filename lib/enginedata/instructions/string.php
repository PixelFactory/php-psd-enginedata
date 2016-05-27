<?php
class Stringg extends Instruction{
    static function token()
    {

        return "/^\(\xFE\xFF(.*)\)$/";
    }


    public function execute()
    {
        $match = $this->match()[1];
        $data = iconv('UTF-16BE', 'UTF-8', $match);

        if( $data === false )
        {
            return $match;
        }else{
            return trim($data);
        }
    }
}
//
//# -*- encoding : utf-8 -*-
//class PSD
//  class EngineData
//    class Instruction
//      class String < Instruction
//        def self.token; Regexp.new('^\(\xFE\xFF(.*)\)$'.force_encoding('binary')); end
//
//        def execute!
//          data = self.class.tkoen.match(
//            @text.force_encoding('binary')
//          )[1]
//
//          begin
//            data
//              .force_encoding('UTF-16BE')
//              .encode('UTF-8', 'UTF-16BE', universal_newline: true)
//              .strip
//          rescue
//            data
//          end
//        end
//      end
//    end
//  end
//end
