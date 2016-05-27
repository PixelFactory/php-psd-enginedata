<?php
class Noop extends Instruction{
  static function token()
  {
    return '/^$/';
  }
}

// # -*- encoding : utf-8 -*-
// class PSD
//   class EngineData
//     class Instruction
//       class Noop < Instruction
//         def self.token; /^$/; end
//       end
//     end
//   end
// end
