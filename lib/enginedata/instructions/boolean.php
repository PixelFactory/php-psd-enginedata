<?php
class Boolean extends Instruction{
    public static function token()
    {
        return '/^(true|false)$/';
    }

    public function execute()
    {
        return $this->match()[1] === 'true'? TRUE : FALSE;
    }
}
