<?php

namespace Enginedata\Interfaces;

interface ParserInterface{
    public function expression(): string;
    public function startParsing(NodeInterface $node, string $line);
}