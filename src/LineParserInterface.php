<?php

namespace Enginedata;

use Enginedata\Parsers\Parser;

interface LineParserInterface
{
    public function parse(NodeInterface $node, $line): bool;
    public function getParsers(): array;
    public function getParser($name): ?Parser;
}
