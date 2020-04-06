<?php

use PHPUnit\Framework\TestCase;

class TestCaseParser extends TestCase{


    /**
     * @var \Enginedata\Parsers\Parser
     */
    protected static $parser;
    protected static $parsers_data;

    public static function setUpBeforeClass() : void
    {
        self::$parsers_data = file(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'parsers_data');

        $class_name = '\\Enginedata\\Parsers\\Formats\\' . substr(static::class, 0, -4 );
        self::$parser = new $class_name;
    }

    protected function checkExpressionOnAllData( array $correct_line_numbers ){
        $expression = self::$parser->expression();

        foreach( self::$parsers_data as $i => $line ){
            $status = preg_match( $expression , $line, $matches);

            if( array_search($i, $correct_line_numbers) !== false ){
                $this->assertSame($status, 1);
                $this->assertSame(trim($line), $matches[0]);
            }else{
                $this->assertSame($status, 0);
            }
        }
    }

    /**
     * @param $class_name
     * @param $method_name
     * @param array $params
     * @return mixed
     * @throws ReflectionException
     */
    protected function callProtectedMethod( $class_name, $method_name, array $params = [] ){
        $object = new $class_name;
        $reflector = new ReflectionClass( $class_name );
        $method = $reflector->getMethod( $method_name );
        $method->setAccessible( true );

        return $method->invokeArgs( $object, $params );
    }

    /**
     * @param $line_number
     * @param $node
     * @throws ReflectionException
     */
    protected function startParsingTest( $line_number, $node ){
        $line = self::$parsers_data[$line_number];

        $status = preg_match(  self::$parser->expression() , $line, $matches );
        $this->assertSame($status, 1);

        $this->callProtectedMethod(get_class(self::$parser), 'parse', [$node, $line, $matches]);
    }
}