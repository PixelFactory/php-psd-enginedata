<?php

use Enginedata\LineParser;

class LineParserTest extends TestCase
{
    /**
     * @dataProvider parsersListProvider
     * @param $parsers
     * @param $expected
     * @throws ReflectionException
     */
    public function testInitializeParsers($parsers, $expected)
    {
        $line_parser = new LineParser($parsers);
        $this->assertEquals($this->getPrivateProperty($line_parser, 'parsers'), $expected);
    }

    public function testParse()
    {
        $this->assertEquals(1, 1);
    }

    /**
     * @dataProvider parsersListProvider
     * @param $parsers
     * @param $expected
     */
    public function testGetParsers($parsers, $expected)
    {
        $line_parser = new LineParser($parsers);
        $this->assertEquals($line_parser->getParsers(), array_keys($expected));
    }

    public function testGetParser()
    {
        $data = 'Data String';

        $line_parser = $this->getMockBuilder(LineParser::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getParserInstance'])
            ->getMock();

        $line_parser->expects($this->once())
            ->method('getParserInstance')
            ->with($this->equalTo($data));

        /** @var LineParser $line_parser */
        $line_parser->getParser($data);
    }

    public function testGetParserInstance()
    {
        $this->assertEquals(1, 1);
    }

    public function parsersListProvider()
    {
        $parsers = [
            [],
            [
                'parser_name' => 'parser',
            ],
            [
                'parser_name_1' => 'parser_1',
                'parser_name_2' => 'parser_2',
                'parser_name_3' => 'parser_3',
            ],
        ];

        foreach ($parsers as $parser) {
            yield [ $parser, $parser ];
        }
    }
}
