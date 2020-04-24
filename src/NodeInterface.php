<?php

namespace Enginedata;

interface NodeInterface
{
    public function getNode(): array;
    public function setValue($name, $value = null);
    public function parentNode();
    public function addNode($useIndex = false);
}
