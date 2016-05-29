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
