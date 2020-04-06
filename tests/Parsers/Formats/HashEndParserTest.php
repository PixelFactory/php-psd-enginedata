<?php

class HashEndParserTest extends TestCaseParser {

    public function testExpression()
    {
        $this->checkExpressionOnAllData([2]);
    }

    /**
     * @throws ReflectionException
     */
    public function testParse()
    {
        $node = $this->getMockBuilder(\Enginedata\Node::class)->getMock();

        $node->expects($this->once())
            ->method('parentNode');

        $reflectionClass = new ReflectionClass(get_class(self::$parser));

        $staticPropertiesBefore = $reflectionClass->getStaticProperties();
        $this->assertArrayHasKey('multiLineArray', $staticPropertiesBefore);

        $this->startParsingTest(2, $node);

        $staticPropertiesAfter = $reflectionClass->getStaticProperties();
        $this->assertArrayHasKey('multiLineArray', $staticPropertiesAfter);
        $this->assertSame($staticPropertiesAfter['multiLineArray'], $staticPropertiesBefore['multiLineArray']  - 1);
    }
}