<?php

class NumbersParserTest extends TestCase
{
    /**
     * @var \Enginedata\Parsers\NumbersParser $parser
     */
    protected $parser;

    protected function setUp() : void
    {
        $this->parser = $this->getMockForAbstractClass(\Enginedata\Parsers\NumbersParser::class);
    }

    /**
     * @dataProvider numbersToConvertProvider
     * @param $num
     * @param $expected
     */
    public function testConvertToNumber($num, $expected){
            $this->assertSame($this->parser->convertToNumber($num), $expected);
    }

    public function numbersToConvertProvider(){
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