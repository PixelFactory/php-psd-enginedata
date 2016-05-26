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


//# -*- encoding : utf-8 -*-
//class PSD
//  class EngineData
//    # A collection of helper methods that are used to manipulate the internal
//    # data structure while parsing.
//    module DocumentHelpers
//      # Pushes a property and node onto the parsing stack.
//      def stack_push(property = nil, node = nil)
//        node = @node if node.nil?
//        property = @property if property.nil?
//
//        @node_stack.push node
//        @property_stack.push property
//      end
//
//      # Pops a property and node from the parsing stack
//      def stack_pop
//        return @property_stack.pop, @node_stack.pop
//      end
//
//      # Sets the current active node
//      def set_node(node)
//        @node = node
//      end
//
//      # Creates a new node
//      def reset_node
//        @node = Node.new
//      end
//
//      # Sets the current active property
//      def set_property(property = nil)
//        @property = property
//      end
//
//      # Updates a node with a given property and child node.
//      def update_node(property, node)
//        if node.is_a?(PSD::EngineData::Node)
//          node[property] = @node
//        elsif node.is_a?(Array)
//          node.push @node
//        end
//      end
//    end
//  end
//end
