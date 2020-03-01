<?php

namespace Enginedata;

use Exception;
use DirectoryIterator;

class Enginedata{

    protected Text $text;
    protected Node $node;
    protected LineParser $parser;

    public static function load( $file )
    {
        $text = file_get_contents( $file );
        return new self( $text );
    }


    public function __construct( $text )
    {
        $this->text = new Text( $text );
        $this->parser = new LineParser();
        $this->node = new Node();
    }

    /**
     * @throws Exception
     */
    public function parse()
    {
        $parsers = $this->getParsers();
        $this->parser->initializeParsers($parsers);

        for( $this->text->rewind(); $this->text->valid(); $this->text->next() )
        {
            $line = $this->text->current();
            try {
                $this->parser->parse($this->node, $line);
            }catch (Exception $ex){
                throw new Exception($ex->getMessage() . ' Line: ' . ($this->text->key() + 1) );
            }
        }

        return $this->getNode();
    }

    public function result()
    {
        return $this->getNode();
    }

    public function getNode()
    {
        return $this->node->getNode();
    }

    protected function getParsers(): DirectoryIterator
    {
        return new DirectoryIterator( __DIR__ . DIRECTORY_SEPARATOR . 'Parsers');
    }
}
