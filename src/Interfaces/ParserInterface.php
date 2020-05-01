<?php

declare(strict_types=1);

namespace Enginedata\Interfaces;

interface ParserInterface{
    public function expression(): string;
    public function startParsing(NodeInterface $node, string $line);
}