<?php

use Enginedata\Node;

class BooleanParserTest extends TestCaseParser
{
    public function testExpression()
    {
        $this->checkExpressionOnAllData([0]);
    }

    /**
     * @throws ReflectionException
     */
    public function testParse()
    {
        $node = $this->getMockBuilder(Node::class)->getMock();

        $node->expects($this->once())
            ->method('setValue')
            ->with(
                $this->equalTo('AutoHyphenate'),
                $this->isTrue()
            );

        $this->startParsingTest(0, $node);
    }
}
