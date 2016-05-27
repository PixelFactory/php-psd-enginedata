<?php
class Property extends Instruction{
  static function token()
  {
    return '/^\/([A-Z0-9]+)$/i';
  }

    public function execute()
    {
        return $this->document->set_property($this->match()[1]);
    }
}

// # -*- encoding : utf-8 -*-
// class PSD
//   class EngineData
//     class Instruction
//       class Property < Instruction
//         def self.token; /^\/([A-Z0-9]+)$/i; end

//         def execute!
//           set_property match[1]
//         end
//       end
//     end
//   end
// end
