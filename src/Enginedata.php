<?php

namespace Enginedata;

class Enginedata{

    private $text;

    private $node;

    public static function load( $file )
    {
        $text = file_get_contents( $file );
        return new self( $text );
    }


    public function __construct( $text )
    {
        $this->text = new Text( $text );
        $this->node = new Node();
    }

    public function parse()
    {
        $parser = new LineParser();

        for( $this->text->rewind(); $this->text->valid(); $this->text->next() )
        {
            $line = $this->text->current();
            try {
                $parser->parse($this->node, $line);

            }catch (\Exception $ex){
                throw new \Exception($ex->getMessage() . ' Line: ' . ($this->text->key() + 1) );
            }
        }

        return $this->node->getNode();
    }

    /**
     * @return Node
     */
    public function getNode()
    {
        return $this->node;
    }
}
