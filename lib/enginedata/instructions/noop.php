<?php
class Noop extends Instruction{
  static function token()
  {
    return '/^$/';
  }
}
