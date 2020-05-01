<?php

declare(strict_types=1);

namespace Enginedata;

use Exception;
use SeekableIterator;
use Enginedata\Interfaces\NodeInterface;
use Enginedata\Interfaces\LineParserInterface;

class Enginedata
{
    protected string $config = Config::class;

    protected NodeInterface $node;
    protected SeekableIterator $text;
    protected LineParserInterface $parser;

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
    public function parse(): array
    {
        for ($this->text->rewind(); $this->text->valid(); $this->text->next()) {
            $this->parseLine($this->text->current(), $this->text->key() + 1);
        }

        return $this->getNode();
    }

    /**
     * @param $line
     * @param $lineNumber
     * @throws Exception
     */
    protected function parseLine($line, $lineNumber): void
    {
        try {
            $this->parser->parse($this->node, $line);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage() . ' Line: ' . $lineNumber);
        }
    }

    public function result(): array
    {
        return $this->getNode();
    }

    public function getNode(): array
    {
        return $this->node->getNode();
    }

    public function getConfig($key)
    {
        /** @var Config $configClass */
        $configClass = $this->config;
        return $configClass::DEFAULT_CONFIG[$key];
    }
}
