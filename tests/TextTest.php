<?php

use PHPUnit\Framework\TestCase;
use Enginedata\Text;

class TextTest extends TestCase
{
    /**
     * @covers \Enginedata\Text::__construct
     */
    public function testTextToArray(){

        $text_data = [
            '<<',
            'TestData',
            '<<',
            'Values [ 0.0 ]',
            '>>',
            '>>',
        ];

        $text = new Text("<<\n\t/TestData\n\t<<\n\t\t/Values [ 0.0 ]\n\t>>\n>>");

        for( $text->rewind(); $text->valid(); $text->next() ) {
            $this->assertEquals($text->current(),$text_data[$text->key()]);
        }

    }

    /**
     * @param $text
     * @covers \Enginedata\Text::__construct
     * @dataProvider resourcesTextData
     */
    public function testResourcesTextToArray($text){
        $this->assertInstanceOf(\ArrayIterator::class, new Text($text));
    }

    public function resourcesTextData(){
        $resources_dir = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;

        $textData = [
            [
                file_get_contents($resources_dir . 'data0'),
                file_get_contents($resources_dir . 'data1'),
                file_get_contents($resources_dir . 'data2')
            ]
        ];

        foreach( $textData as $text ){
            yield $text;
        }
    }
}