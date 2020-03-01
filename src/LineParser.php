<?php

namespace Enginedata;

use Exception;

/**
 * Class LineParser contains 'Object Pool' all parsers
 * @package Enginedata
 */
class LineParser{

    /**
     * @var array Parsers objects
     */
    protected array $parsers = [];

    /**
     * Initialize parser array
     * @param \DirectoryIterator $parsers
     * @throws Exception
     */
    public function initializeParsers( \DirectoryIterator $parsers )
    {
        foreach ($parsers as $parser)
        {
            if($parser->isDot()) continue;

            $class_name = $parser->getBasename('.php');

            $full_class_name = '\\Enginedata\\Parsers\\' . $class_name;

            //$parser = new $full_class_name;

            if( is_subclass_of($full_class_name, '\\Enginedata\\Parser') )
            {
                $this->parsers[$class_name] = $full_class_name;
            }else{
                throw new Exception('Parser "'.$full_class_name.'" not extends "Parser"');
            }
        }
    }

    /**
     * @param Node $node
     * @param $line
     * @return bool
     * @throws Exception
     */
    public function parse( Node $node, $line )
    {
        foreach ( $this->getParsers() as $parser )
        {
            if( $this->getParserInstance( $parser )->startParsing( $node, $line ) ){
                return true;
            }
        }

        throw new Exception('Parser not found.');
    }

    /**
     * @return array Classes names
     */
    public function getParsers(): array
    {
        return array_keys( $this->parsers );
    }

    /**
     * @param string $name Parser class name
     * @return Parser
     */
    public function getParser( $name ): Parser
    {
        return $this->getParserInstance( $name );
    }

    /**
     * @param $name
     * @return Parser|null
     */
    protected function getParserInstance( $name ): Parser
    {
        if(!isset($this->parsers[$name]) ) {
            return null;
        }

        if( is_string($this->parsers[$name]) ){
            $this->parsers[$name] = new $this->parsers[$name];
        }

        return $this->parsers[$name];
    }
}