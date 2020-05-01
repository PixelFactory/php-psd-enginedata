<?php

declare(strict_types=1);

namespace Enginedata;

class Config
{
    public const DEFAULT_CONFIG = [
        'node' => Node::class,
        'text' => Text::class,
        'lineParser' => LineParser::class,
        'parsers' => [
            Parsers\Formats\BooleanParser::class,
            Parsers\Formats\EmptyStringParser::class,
            Parsers\Formats\HashEndParser::class,
            Parsers\Formats\HashNameParser::class,
            Parsers\Formats\HashStartParser::class,
            Parsers\Formats\MultiLineArrayEndParser::class,
            Parsers\Formats\MultiLineArrayStartParser::class,
            Parsers\Formats\NumberParser::class,
            Parsers\Formats\SingleLineArrayParser::class,
            Parsers\Formats\StringParser::class,
        ],
    ];
}
