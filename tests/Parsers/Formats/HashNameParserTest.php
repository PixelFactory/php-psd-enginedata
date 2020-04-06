<?php

class HashNameParserTest extends TestCaseParser {

    public function testExpression()
    {
        $this->checkExpressionOnAllData([3]);
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
                $this->equalTo('EngineDict')
            );

        $this->startParsingTest(3, $node);
    }
}