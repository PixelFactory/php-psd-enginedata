<?php

declare(strict_types=1);

namespace Enginedata\Parsers\Formats;

use Enginedata\Parsers\Parser;
use Enginedata\Interfaces\NodeInterface;

class StringParser extends Parser
{
    public function expression(): string
    {
        return '/^([A-Z0-9]+) \(\xFE\xFF(.*)/i';
    }

    protected function parse(NodeInterface $node, $line, $matches)
    {
        $name = $matches[1];

        // Delete last bracket
        $string_u16 = substr($matches[2], 0, -1);
        // Convert sting
        $string_u8 = @iconv('UTF-16BE', 'UTF-8', $string_u16);

        if ($string_u8 === false) {
            $str = $string_u16;
        } else {
            $str = trim($string_u8);
        }

        $node->setValue($name, $str);
    }
}
