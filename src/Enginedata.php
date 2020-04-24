<?php

namespace Enginedata;

use Exception;
use SeekableIterator;

class Enginedata
{
    protected NodeInterface $node;
    protected LineParserInterface $parser;
    protected SeekableIterator $text;

    public static function load($file)
    {
        $text = file_get_contents($file);
        return new self($text);
    }


    public function __construct(
        $text,
        NodeInterface $nodeObject = null,
        SeekableIterator $textObject = null,
        LineParserInterface $parserObject = null
    ) {
        if (!isset($nodeObject)) {
            $nodeClass = $this->getConfig('node');
            $nodeObject = new $nodeClass();
        }

        if (!isset($textObject)) {
            $textClass = $this->getConfig('text');
            $textObject = new $textClass($text);
        }

        if (!isset($parserObject)) {
            $parsers = $this->getConfig('parsers');
            $lineParserClass = $this->getConfig('lineParser');
            $parserObject = new $lineParserClass($parsers);
        }

        $this->node = $nodeObject;
        $this->text = $textObject;
        $this->parser = $parserObject;
    }

    /**
     * @throws Exception
     */
    public function parse()
    {
        for ($this->text->rewind(); $this->text->valid(); $this->text->next()) {
            $line = $this->text->current();
            try {
                $this->parser->parse($this->node, $line);
            } catch (Exception $ex) {
                throw new Exception($ex->getMessage() . ' Line: ' . ($this->text->key() + 1));
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

    public function getConfig($key): array
    {
        return Config::DEFAULT_CONFIG[$key];
    }
}
