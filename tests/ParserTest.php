<?php

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @var \Enginedata\Parser $parser
     */
    protected $parser;

    /**
     * @throws ReflectionException
     */
    protected function setUp() : void
    {
        $this->parser = $this->getMockForAbstractClass(\Enginedata\Parser::class);

        // Hash start regexp
        $this->parser->expects($this->any())->method('expression')->willReturn('/^<<$/');
        $this->parser->expects($this->any())->method('parse')->willReturn(true);
    }


    /**
     * @covers \Enginedata\Parser::startParsing
     * @throws ReflectionException
     */
    public function testStartParsing(){
        $node = $this->getMockBuilder(\Enginedata\Node::class)->getMock();

        /**
         * @var \Enginedata\Node $node
         */
        $this->assertSame($this->parser->startParsing($node, '<<'), true);
        $this->assertSame($this->parser->startParsing($node, 'line'), false);

    }

    /**
     * @covers \Enginedata\Parser::convertToNumber
     */
    public function testConvertToNumber(){
        foreach ($this->numbersToConvert() as $numberEqualData) {
            $this->assertSame($this->parser->convertToNumber($numberEqualData[0]), $numberEqualData[1]);
        }
    }

    public function numbersToConvert(){
        return [
            [ '0000',  0.0 ],
            [ '-0000', 0.0 ],
            [ '10',   10.0 ],
            [ '-10', -10.0 ],
            [ '.0000', 0.0 ],
            [ '.10',  0.10 ],
            [ '00.00', 0.0 ],
            [ '0.1',   0.1 ],
            [ '-0.1', -0.1 ],
        ];
    }
}