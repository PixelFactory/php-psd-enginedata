<?php

class HashStartParserTest extends TestCaseParser
{
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

        $reflectionClass = new ReflectionClass(get_class(self::$parser));

        $staticPropertiesBefore = $reflectionClass->getStaticProperties();
        $this->assertArrayHasKey('multiLineArray', $staticPropertiesBefore);

        $this->startParsingTest(4, $node);

        $staticPropertiesAfter = $reflectionClass->getStaticProperties();
        $this->assertArrayHasKey('multiLineArray', $staticPropertiesAfter);
        $this->assertSame($staticPropertiesAfter['multiLineArray'], $staticPropertiesBefore['multiLineArray']  + 1);
    }
}
