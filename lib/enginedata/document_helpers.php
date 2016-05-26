<?php

trait DocumentHelpers{

  private $node;
  private $property;
  private $node_stack;
  private $property_stack;

    public function stack_push( $property = null, $node = null )
    {
        if( ! isset($node) )
        {
            $node = $this->node;
        }

        if( ! isset($property) )
        {
            $property = $this->property;
        }

        array_push($this->node_stack, $node);
        array_push($this->property_stack, $property);
    }
    public function stack_pop()
    {
        $return = array();

        $return[] = array_pop($this->property_stack);
        $return[] = array_pop($this->node_stack);

        return $return;
    }
    public function set_node( $node )
    {
        return $this->node = $node;
    }
    public function reset_node()
    {
        return $this->node = new Node();
    }
    public function set_property( $property = null )
    {
        return $this->property = $property;
    }
    public function update_node( $property, &$node )
    {
        if( $node instanceof Node )
        {
            $node->$property = $this->node;
        }elseif( is_array($node) )
        {
            array_push($node, $this->node);
        }
    }
}
