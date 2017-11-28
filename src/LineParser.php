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
     *
     * @throws \Exception
     */
    private function initializeParsers()
    {
        $dir = __DIR__.DIRECTORY_SEPARATOR.'Parsers'.DIRECTORY_SEPARATOR;
        $classes = scandir($dir);

        foreach ($classes as $class_file)
        {
            if( $class_file != '..' && $class_file != '.' )
            {
                $class_name =  pathinfo( $class_file,  PATHINFO_FILENAME );

                $full_class_name = 'Enginedata\\Parsers\\' . $class_name;

                $parser = new $full_class_name;

                if( $parser instanceof Parser )
                {
                    $this->parsers[$class_name] = $parser;
                }else{
                    unset($parser);
                    throw new \Exception('Parser "'.$full_class_name.'" not extends "Parser"');
                }
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
     * @param $name parser class name
     * @return mixed parser object
     */
    public function getParser( $name )
    {
        return $this->parsers[$name];
    }

    public function __construct()
    {
        $this->initializeParsers();
    }

}