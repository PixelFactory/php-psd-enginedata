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
     * @throws \Exception
     */
    private function initializeParsers( \DirectoryIterator $classes )
    {
        foreach ($classes as $class_file)
        {
            if($class_file->isDot()) continue;

            $full_class_name = 'Enginedata\\Parsers\\' . $class_file->getBasename();

            $parser = new $full_class_name;

            if( $parser instanceof Parser )
            {
                $this->parsers[$class_file->getBasename()] = $parser;
            }else{
                throw new \Exception('Parser "'.$full_class_name.'" not extends "Parser"');
            }
        }
    }

    /**
     * @param Node $node
     * @param $line
     * @return bool
     * @throws \Exception
     */
    public function parse( Node $node, $line )
    {


        foreach ( $this->parsers as $parser )
        {
            if( $parser->startParsing( $node, $line ) ){
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
        return $this->parsers[$name];
    }

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $classes = new \DirectoryIterator( __DIR__ . DIRECTORY_SEPARATOR . 'Parsers');
        $this->initializeParsers( $classes );
    }

}