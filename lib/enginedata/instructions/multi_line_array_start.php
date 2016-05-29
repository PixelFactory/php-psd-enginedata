<?php
class MultiLineArrayStart extends Instruction{
    static function token()
    {
    return '/^\/(\w+) \[$/';
    }

    public function execute()
    {
        $this->document->stack_push( $this->match()[1] );
        $this->document->set_node( array() );
        return $this->document->set_property();
    }
}
