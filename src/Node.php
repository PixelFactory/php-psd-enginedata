<?php

namespace Enginedata;

class Node implements NodeInterface
{

    private array $node = [];
    private array $path = [];

    public function getNode(): array
    {
        return $this->node;
    }

    public function setValue($name, $value = null)
    {
        $node = &$this->getLastNode();
        $node[$name] = $value;

        if ($value === null) {
            $this->path[] = $name;
        }
    }

    public function parentNode()
    {
        array_pop($this->path);
    }

    /**
     * Create new node
     * @param $useIndex
     */
    public function addNode($useIndex = false)
    {
        if (count($this->path) === 0) {
            // Root
            $this->node[] = [];
            $this->path[] = (string)(count($this->node) - 1);
        } else {
            //No root
            $node = &$this->getLastNode();

            if ($useIndex === true) {
                $node[] = [];
                $this->path[] = count($node) - 1;
            } else {
                $node = [];
            }
        }
    }

    protected function &getLastNode()
    {
        $ref = &$this->node;

        foreach ($this->path as $parent) {
            if (isset($ref) && !is_array($ref)) {
                $ref = [];
            }

            $ref = &$ref[$parent];
        }

        return $ref;
    }
}
