<?php
class SingleLineArray extends Instruction{
    static function token()
    {
    return '/^\[(.*)\]$/';
    }

    public function execute()
    {
        $items = explode(" ", trim($this->match()[1]) );
        $data = array();

        foreach ($items as $val)
        {
            $data[] = $this->document->parse_tokens($val);
        }

        return $data;
    }
}
