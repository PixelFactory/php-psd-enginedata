<?php

namespace Enginedata\Interfaces;

interface LineParserInterface
{
    public function parse(NodeInterface $node, string $line): bool;
    public function getParsers(): array;
    public function getParser(string $name): ?ParserInterface;
}
