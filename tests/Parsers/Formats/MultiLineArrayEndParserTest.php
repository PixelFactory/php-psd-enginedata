<?php

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
        $node = $this->getMockBuilder(\Enginedata\Node::class)->getMock();

        $node->expects($this->once())
            ->method('parentNode');

        $this->startParsingTest(6, $node);
    }
}
