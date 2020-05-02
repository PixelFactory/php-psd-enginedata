<?php

use Enginedata\Node;

class MultiLineArrayEndParserTest extends TestCaseParser
{
    public function testExpression()
    {
        $this->checkExpressionOnAllData([6]);
    }

    /**
     * @throws ReflectionException
     */
    public function testParse()
    {
        $node = $this->getMockBuilder(Node::class)->getMock();

        $node->expects($this->once())
            ->method('parentNode');

        $this->startParsingTest(6, $node);
    }
}
