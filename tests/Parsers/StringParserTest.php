<?php

class StringParserTest extends TestCaseParser {

    public function testExpression()
    {
        $this->checkExpressionOnAllData([9,10]);
        //$this->checkExpressionOnAllData(10);
    }

    /**
     * @throws ReflectionException
     */
    public function testParse()
    {

        $node = $this->getMockBuilder(\Enginedata\Node::class)->getMock();


        $node->expects($this->exactly(2))
            ->method('setValue')
            ->withConsecutive(
                [ $this->equalTo('Name'), $this->equalTo('Normal RGB') ],
                [ $this->equalTo('Name'), $this->equalTo('Wrong String?') ]
            );

        $this->startParsingTest(9,  $node);
        $this->startParsingTest(10, $node);
    }
}