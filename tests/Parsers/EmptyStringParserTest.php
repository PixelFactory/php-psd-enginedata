<?php

use PHPUnit\Framework\TestCase;

class EmptyStringParserTest extends TestCaseParser {

    public function testExpression()
    {
        $this->checkExpressionOnAllData([1]);
    }
}