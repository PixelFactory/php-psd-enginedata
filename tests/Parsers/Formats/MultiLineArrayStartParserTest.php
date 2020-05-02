<?php

use Enginedata\Node;

class MultiLineArrayStartParserTest extends TestCaseParser
{
    public function testExpression()
    {
        $this->checkExpressionOnAllData([5]);
    }

    /**
     * @throws ReflectionException
     */
    public function testParse()
    {
        $node = $this->getMockBuilder(Node::class)->getMock();

        $node->expects($this->once())
            ->method('addNode')
            ->with(
                $this->equalTo('RunArray')
            );

        $this->startParsingTest(5, $node);
    }
}
