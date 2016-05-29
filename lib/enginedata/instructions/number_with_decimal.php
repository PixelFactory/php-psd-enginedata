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
