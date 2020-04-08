<?php

namespace Enginedata;

use Enginedata\Parsers\Parser;

interface ParseLine
{
    public function parse(Node $node, $line): bool;
    public function getParsers(): array;
    public function getParser($name): Parser;
}
