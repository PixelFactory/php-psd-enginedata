<?php

class EmptyStringParserTest extends TestCaseParser
{
    public function testExpression()
    {
        $this->checkExpressionOnAllData([1]);
    }
}
