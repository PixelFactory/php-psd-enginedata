<?php

use Enginedata\Node;

class HashNameParserTest extends TestCaseParser
{
    public function testExpression()
    {
        $this->checkExpressionOnAllData([3]);
    }

    /**
     * @throws ReflectionException
     */
    public function testParse()
    {
        $node = $this->getMockBuilder(Node::class)->getMock();

        $reflectionClass = new ReflectionClass(get_class(self::$parser));

        $this->startParsingTest(3, $node);

        $this->assertSame($reflectionClass->getStaticProperties()['hashName'], 'EngineDict');
    }
}
