<?php

use Enginedata\Node;

class SingleLineArrayParserTest extends TestCaseParser
{
    public function testExpression()
    {
        $this->checkExpressionOnAllData([8]);
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
                $this->equalTo('WordSpacing')
            );

        $node->expects($this->exactly(3))
            ->method('addValue')
            ->withConsecutive(
                [ $this->equalTo(0.8) ],
                [ $this->equalTo(1) ],
                [ $this->equalTo(1.33) ],
            );

        $node->expects($this->once())
            ->method('parentNode');

        $this->startParsingTest(8, $node);
    }
}
