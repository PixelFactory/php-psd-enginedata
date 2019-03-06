<?php

use PHPUnit\Framework\TestCase;

class NumberParserTest extends TestCaseParser {

    public function testExpression()
    {
        $this->checkExpressionOnAllData([7]);
    }

    /**
     * @throws ReflectionException
     */
    public function testParse()
    {
        $node = $this->getMockBuilder(\Enginedata\Node::class)->getMock();

        $node->expects($this->once())
            ->method('setValue')
            ->with(
                $this->equalTo('SpaceAfter'),
                $this->equalTo(0.5)
            );

        $this->startParsingTest(7, $node);
    }
}