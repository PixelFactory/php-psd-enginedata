<?php
class NumberWithDecimal extends Instruction{
  static function token()
  {
    return '/^(-?\d*)\.(\d+)$/';
  }

    public function execute()
    {
        return (float)($this->match()[1] . '.' . $this->match()[2]);
    }
}

// # -*- encoding : utf-8 -*-
// class PSD
//   class EngineData
//     class Instruction
//       class NumberWithDecimal < Instruction
//         def self.token; /^(-?\d*)\.(\d+)$/; end

//         def execute!
//           "#{match[1]}.#{match[2]}".to_f
//         end
//       end
//     end
//   end
// end
