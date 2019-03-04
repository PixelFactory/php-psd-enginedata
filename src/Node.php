<?php

namespace Enginedata;

class Node{

    private $node = array();

    private $path = array();

    public function getNode()
    {
        return $this->node;
    }

    public function setValue( $name, $value = null )
    {
        $node = &$this->getLastNode();
        $node[$name] = $value;

        if( $value === null ) {
            $this->path[] = $name;
        }
    }

    public function parentNode(){
        array_pop( $this->path );
    }

    /**
     * Create new node
     * @param $useIndex
     */
    public function addNode( $useIndex = false )
    {
        if( count($this->path) === 0 ){
            // Root
            $this->node[] = array();
            $this->path[] = (string)(count($this->node) - 1);
        }else{
            //No root
            $node = &$this->getLastNode();

            if($useIndex === true){
                $node[] = array();
                $this->path[] = count($node) - 1;
            }else {
                $node = array();
            }
        }
    }

    protected function &getLastNode()
    {
        $ref = &$this->node;

        foreach ($this->path as $parent) {
            if (isset($ref) && !is_array($ref)) {
                $ref = array();
            }

            $ref = &$ref[$parent];
        }

        return $ref;
    }
}