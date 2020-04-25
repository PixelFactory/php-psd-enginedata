<?php

use Enginedata\Node;
use Enginedata\LineParser;
use Enginedata\Parsers\Parser;
use Enginedata\Parsers\Formats\BooleanParser;
use Enginedata\Parsers\Formats\EmptyStringParser;

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

    /**
     * @throws Exception
     */
    public function testParse()
    {
        $node = $this->createMock(Node::class);

        $line_parser = $this->getMockBuilder(LineParser::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getParsers', 'getParser'])
            ->getMock();

        $parser = $this->getMockBuilder(Parser::class)
            ->onlyMethods(['startParsing'])
            ->getMockForAbstractClass();

        $parser->expects($this->once())
            ->method('startParsing')
            ->will($this->returnValue(true));

        $line_parser->expects($this->once())
            ->method('getParsers')
            ->will($this->returnValue([Parser::class => $parser]));

        $line_parser->expects($this->once())
            ->method('getParser')
            ->will($this->returnArgument(0));

        /** @var LineParser $line_parser */
        $line_parser->parse($node, 'Test Line');
    }

    /**
     * @throws Exception
     */
    public function testParseException()
    {
        $node = $this->createMock(Node::class);
        $line_parser = $this->getMockBuilder(LineParser::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getParsers'])
            ->getMock();

        $this->expectException(Exception::class);
        /** @var LineParser $line_parser */
        $line_parser->parse($node, 'Test Line');
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

    /**
     * @dataProvider realParserListProvider
     * @param $name
     * @param $parser
     * @param $expected
     * @throws ReflectionException
     */
    public function testGetParserInstance($name, $parser, $expected)
    {
        $line_parser = new LineParser([ $name => $parser ]);

        $this->assertNull($this->callProtectedMethod($line_parser, 'getParserInstance', ['SimpleParser']));

        $this->assertInstanceOf(
            $expected,
            $this->callProtectedMethod($line_parser, 'getParserInstance', [$name])
        );
    }

    public function realParserListProvider()
    {
        $parsers = [
            BooleanParser::class => BooleanParser::class,
            EmptyStringParser::class => EmptyStringParser::class
        ];

        foreach ($parsers as $name => $parser) {
            yield [ $name, $parser, $parser ];
        }
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
