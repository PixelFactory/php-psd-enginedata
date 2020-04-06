<?php

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @var \Enginedata\Parsers\Parser $parser
     */
    protected $parser;

    /**
     * @throws ReflectionException
     */
    protected function setUp() : void
    {
        $this->parser = $this->getMockForAbstractClass(\Enginedata\Parsers\Parser::class);

        // Hash start regexp
        $this->parser->expects($this->any())->method('expression')->willReturn('/^<<$/');
        $this->parser->expects($this->any())->method('parse')->willReturn(true);
    }


    /**
     * @covers \Enginedata\Parser::startParsing
     * @throws ReflectionException
     */
    public function testStartParsing(){
        $node = $this->getMockBuilder(\Enginedata\Node::class)->getMock();

        /**
         * @var \Enginedata\Node $node
         */
        $this->assertSame($this->parser->startParsing($node, '<<'), true);
        $this->assertSame($this->parser->startParsing($node, 'line'), false);

    }
}