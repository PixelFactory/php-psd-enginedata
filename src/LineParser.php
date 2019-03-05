<?php

namespace Enginedata;

/**
 * Class LineParser contains 'Object Pool' all parsers
 * @package Enginedata
 */
class LineParser{

    /**
     * @var array Parsers objects
     */
    private $parsers = array();

    /**
     * Initialize parser array
     * @param \DirectoryIterator $classes
     * @return $this
     * @throws \Exception
     */
    public function initializeParsers( \DirectoryIterator $classes )
    {
        foreach ($classes as $class_file)
        {
            if($class_file->isDot()) continue;

            $class_name = $class_file->getBasename('.php');

            $full_class_name = '\\Enginedata\\Parsers\\' . $class_name;

            //$parser = new $full_class_name;

            if( is_subclass_of($full_class_name, '\\Enginedata\\Parser') )
            {
                $this->parsers[$class_name] = $full_class_name;
            }else{
                throw new \Exception('Parser "'.$full_class_name.'" not extends "Parser"');
            }
        }

        return $this;
    }

    /**
     * @param Node $node
     * @param $line
     * @return bool
     * @throws \Exception
     */
    public function parse( Node $node, $line )
    {
        foreach ( $this->getParsers() as $parser )
        {
            if( $this->getParserInstance( $parser )->startParsing( $node, $line ) ){
                return true;
            }
        }
        throw new \Exception('Parser not found.');
    }

    /**
     * @return array Classes names
     */
    public function getParsers()
    {
        return array_keys( $this->parsers );
    }

    /**
     * @param string $name parser class name
     * @return mixed parser object
     */
    public function getParser( $name )
    {
        return $this->getParserInstance( $name );
    }

    /**
     * @param $name
     * @return object|null
     */
    protected function getParserInstance( $name ){
        if( isset($this->parsers[$name]) ){

            if( is_string($this->parsers[$name]) ){
                $this->parsers[$name] = new $this->parsers[$name];
            }

            return $this->parsers[$name];
        }

        return null;
    }
}