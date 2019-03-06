<?php

use PHPUnit\Framework\TestCase;

class MultiLineArrayStartParserTest extends TestCaseParser {

    public function testExpression()
    {
        $this->checkExpressionOnAllData([5]);
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
                $this->equalTo('RunArray')
            );

        $this->startParsingTest(5, $node);

        $staticProperties = (new ReflectionClass(get_class(self::$parser)))->getStaticProperties();

        $this->assertArrayHasKey('multiLineArray', $staticProperties);
        $this->assertSame($staticProperties['multiLineArray'], true);
    }
}