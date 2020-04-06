<?php

namespace Enginedata;

use Exception;
use SeekableIterator;

class Enginedata{

    protected Node $node;
    protected ParseLine $parser;
    protected SeekableIterator $text;

    public static function load( $file )
    {
        $text = file_get_contents( $file );
        return new self( $text );
    }


    public function __construct( $text, SeekableIterator $textObject = null, ParseLine $parserObject = null )
    {
        $this->text = $textObject ?? new (static::getConfig('text'))($text);
        $this->parser = $parserObject ?? new (static::getConfig('lineParser'))();
        $this->node = new Node();
    }

    /**
     * @throws Exception
     */
    public function parse()
    {
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

    public static function getConfig($key): array
    {
        return Config::DEFAULT_CONFIG[$key];
    }
}
