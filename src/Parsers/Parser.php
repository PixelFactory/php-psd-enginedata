<?php

namespace Enginedata\Parsers;

use Enginedata\NodeInterface;

abstract class Parser
{
    protected static int $multiLineArray = 0;

    abstract public function expression(): string;
    abstract protected function parse(NodeInterface $node, $line, $matches);


    /**
     * @param NodeInterface $node
     * @param $line
     * @return bool
     */
    public function startParsing(NodeInterface $node, $line)
    {
        $status = preg_match($this->expression(), $line, $matches);

        if ($status === 1) {
            $this->parse($node, $line, $matches);
            return true;
        } else {
            return false;
        }
    }
}
