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
