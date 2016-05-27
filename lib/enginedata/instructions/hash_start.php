<?php
class HashStart extends Instruction{
  static function token()
  {
    return '/^<<$/';
  }

    public function execute()
    {
        $this->document->stack_push();
        $this->document->reset_node();
        return $this->document->set_property();
    }
}

// # -*- encoding : utf-8 -*-
// class PSD
//   class EngineData
//     class Instruction
//       class HashStart < Instruction
//         def self.token; /^<<$/; end

//         def execute!
//           stack_push
//           reset_node
//           set_property
//         end
//       end
//     end
//   end
// end
