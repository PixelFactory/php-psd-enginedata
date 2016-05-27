<?php
class HashEnd extends Instruction{
  static function token()
  {
    return '/^>>$/';
  }

    public function execute()
    {
        $aa = $this->document->stack_pop();

        list($property, $node) = $aa;
        if( ! isset($node) )
            return null;

        $this->document->update_node($property, $node);

        $this->document->set_node($node);

        return true;
    }
}


// # -*- encoding : utf-8 -*-
// class PSD
//   class EngineData
//     class Instruction
//       class HashEnd < Instruction
//         def self.token; /^>>$/; end

//         def execute!
//           property, node = stack_pop
//           return if node.nil?

//           update_node property, node
//           set_node node
//         end
//       end
//     end
//   end
// end
