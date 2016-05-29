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
