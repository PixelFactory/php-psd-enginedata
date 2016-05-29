<?php
class MultiLineArrayEnd extends Instruction{
    static function token()
    {
    return '/^\]$/';
    }

    public function execute()
    {
        list($property, $node) = $this->document->stack_pop();
        $this->document->update_node($property, $node);
        return $this->document->set_node( $node );
    }
}
