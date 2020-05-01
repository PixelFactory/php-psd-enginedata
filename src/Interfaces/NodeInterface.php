<?php

declare(strict_types=1);

namespace Enginedata\Interfaces;

interface NodeInterface
{
    public function getNode(): array;
    public function setValue($key, $value): void;
    public function addValue($value): void;
    public function addNode($key = null): void;
    public function parentNode(): void;
}
