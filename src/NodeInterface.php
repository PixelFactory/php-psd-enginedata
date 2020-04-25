<?php

namespace Enginedata;

interface NodeInterface
{
    public function getNode(): array;
    public function setValue($key, $value = null);
    public function parentNode();
    public function addNode($useIndex = false);
}
