<?php
class Stringg extends Instruction{
    static function token()
    {

        return "/^\(\xFE\xFF(.*)\)$/";
    }


    public function execute()
    {
        $match = $this->match()[1];
        $data = iconv('UTF-16BE', 'UTF-8', $match);

        if( $data === false )
        {
            return $match;
        }else{
            return trim($data);
        }
    }
}
