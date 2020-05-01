<?php

namespace Enginedata\Parsers;

use Enginedata\Interfaces\NodeInterface;
use Enginedata\Interfaces\ParserInterface;

abstract class Parser implements ParserInterface
{
    protected static ?string $hashName = null;

    abstract protected function parse(NodeInterface $node, $line, array $matches);
    /**
     * @param NodeInterface $node
     * @param $line
     * @return bool
     */
    public function startParsing(NodeInterface $node, string $line)
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
