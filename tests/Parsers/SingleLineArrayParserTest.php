<?php

use PHPUnit\Framework\TestCase;

class SingleLineArrayParserTest extends TestCaseParser {

    public function testExpression()
    {
        $this->checkExpressionOnAllData([8]);
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
                $this->equalTo('WordSpacing'),
                $this->equalTo([0.8, 1, 1.33])
            );

        $this->startParsingTest(8, $node);
    }
}