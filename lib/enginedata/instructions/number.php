<?php
class Number extends Instruction{
    static function token()
    {
        return '/^(-?\d+)$/';
    }

    public function execute()
    {
        return (int)($this->match()[1]);
    }
}
