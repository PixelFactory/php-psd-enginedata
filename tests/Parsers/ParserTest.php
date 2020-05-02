<?php

use Enginedata\Node;
use Enginedata\Parsers\Parser;
use Enginedata\Interfaces\NodeInterface;

class ParserTest extends TestCase
{
    protected Parser $parser;

    protected function setUp(): void
    {
        $this->parser = $this->getMockForAbstractClass(Parser::class);

        // Hash start regexp
        $this->parser->expects($this->any())->method('expression')->willReturn('/^<<$/');
        $this->parser->expects($this->any())->method('parse')->willReturn(true);
    }

    public function testStartParsing()
    {
        /** @var NodeInterface $node */
        $node = $this->getMockBuilder(Node::class)->getMock();

        $this->assertSame($this->parser->startParsing($node, '<<'), true);
        $this->assertSame($this->parser->startParsing($node, 'line'), false);
    }
}
