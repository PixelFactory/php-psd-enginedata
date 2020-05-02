<?php

use Enginedata\Node;

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
        $node = $this->getMockBuilder(Node::class)->getMock();
        $value = 'Test Value';

        $node->expects($this->once())
            ->method('addNode')
            ->with(
                $this->equalTo($value)
            );

        $reflectionClass = new ReflectionClass(get_class(self::$parser));
        $this->setPrivateProperty($reflectionClass, 'hashName', $value);

        $this->startParsingTest(4, $node);

        $this->assertSame($reflectionClass->getStaticProperties()['hashName'], null);
    }
}
