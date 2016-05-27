<?php
class Number extends Instruction{
    static function token()
    {
        return '/^(-?\d+)$/';
    }

    public function execute()
    {
        return (int)($this->match()[1]);
    }
}

// # -*- encoding : utf-8 -*-
// class PSD
//   class EngineData
//     class Instruction
//       class Number < Instruction
//         def self.token; /^(-?\d+)$/; end

//         def execute!
//           match[1].to_i
//         end
//       end
//     end
//   end
// end
