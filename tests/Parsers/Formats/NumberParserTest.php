<?php

use Enginedata\Node;

class NumberParserTest extends TestCaseParser
{
    public function testExpression()
    {
        $this->checkExpressionOnAllData([7]);
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
                $this->equalTo('SpaceAfter'),
                $this->equalTo(0.5)
            );

        $this->startParsingTest(7, $node);
    }
}
