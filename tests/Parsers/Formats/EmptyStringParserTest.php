<?php

class EmptyStringParserTest extends TestCaseParser
{
    public function testExpression()
    {
        $this->checkExpressionOnAllData([1]);
    }

    /**
     * @throws ReflectionException
     */
    public function testParse()
    {
        $node = $this->getMockBuilder(\Enginedata\Node::class)->getMock();
        $this->startParsingTest(1, $node);
    }
}
