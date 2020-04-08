<?php

use Enginedata\Parsers\Parser;

class TestCaseParser extends TestCase
{
    protected static Parser $parser;
    protected static array $parsers_data;

    public static function setUpBeforeClass(): void
    {
        self::$parsers_data = file(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'parsers_data');

        $class_name = '\\Enginedata\\Parsers\\Formats\\' . substr(static::class, 0, -4);
        self::$parser = new $class_name();
    }

    protected function checkExpressionOnAllData(array $correct_line_numbers)
    {
        $expression = self::$parser->expression();

        foreach (self::$parsers_data as $i => $line) {
            $status = preg_match($expression, $line, $matches);

            if (array_search($i, $correct_line_numbers) !== false) {
                $this->assertSame($status, 1);
                $this->assertSame(trim($line), $matches[0]);
            } else {
                $this->assertSame($status, 0);
            }
        }
    }

    /**
     * @param $line_number
     * @param $node
     * @throws ReflectionException
     */
    protected function startParsingTest($line_number, $node)
    {
        $line = self::$parsers_data[$line_number];

        $status = preg_match(self::$parser->expression(), $line, $matches);
        $this->assertSame($status, 1);

        $this->callProtectedMethod(self::$parser, 'parse', [$node, $line, $matches]);
    }
}
