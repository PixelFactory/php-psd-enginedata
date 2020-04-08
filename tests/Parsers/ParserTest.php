<?php

use Enginedata\Parsers\Parser;

class ParserTest extends TestCase
{
    /**
     * @var Parser $parser
     */
    protected $parser;

    protected function setUp(): void
    {
        $this->parser = $this->getMockForAbstractClass(Parser::class);

        // Hash start regexp
        $this->parser->expects($this->any())->method('expression')->willReturn('/^<<$/');
        $this->parser->expects($this->any())->method('parse')->willReturn(true);
    }


    /**
     * @covers \Enginedata\Parsers\Parser::startParsing
     * @throws ReflectionException
     */
    public function testStartParsing()
    {
        $node = $this->getMockBuilder(\Enginedata\Node::class)->getMock();

        /**
         * @var \Enginedata\Node $node
         */
        $this->assertSame($this->parser->startParsing($node, '<<'), true);
        $this->assertSame($this->parser->startParsing($node, 'line'), false);
    }
}
