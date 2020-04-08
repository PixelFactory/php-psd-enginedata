<?php

namespace Enginedata\Parsers;

use Enginedata\Node;

abstract class Parser
{
    protected static int $multiLineArray = 0;

    abstract public function expression(): string;
    abstract protected function parse(Node $node, $line, $matches);


    /**
     * @param Node $node
     * @param $line
     * @return bool
     */
    public function startParsing(Node $node, $line)
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
