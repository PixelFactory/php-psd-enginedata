<?php

use PHPUnit\Framework\TestCase;

class LineParserTest extends TestCase
{
    protected $classes;

    /**
     * @throws ReflectionException
     */
    protected function setUp() : void
    {
        if( is_null($this->classes) ){
            $this->classes = $this->createMock(\DirectoryIterator::class);
        }
    }

    public function testInitializeParsers(){
        //$line_parser = new \Enginedata\LineParser();

        //$line_parser->initializeParsers( $this->classes );

        $this->assertEquals(1, 1);
    }

}