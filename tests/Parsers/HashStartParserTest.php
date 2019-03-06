<?php

use PHPUnit\Framework\TestCase;

class HashStartParserTest extends TestCaseParser {

    public function testExpression()
    {
        $this->checkExpressionOnAllData([4]);
    }

    /**
     * @throws ReflectionException
     */
    public function testParse()
    {
        $node = $this->getMockBuilder(\Enginedata\Node::class)->getMock();

        $node->expects($this->once())
            ->method('addNode')
            ->with(
                $this->isFalse()
            );

        $this->startParsingTest(4, $node);
    }
}