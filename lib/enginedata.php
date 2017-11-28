<?php

require_once 'enginedata/document_helpers.php';
require_once 'enginedata/errors.php';
require_once 'enginedata/instruction.php';
require_once 'enginedata/node.php';
require_once 'enginedata/text.php';

// Load instructions
require_once 'enginedata/instructions/boolean.php';
require_once 'enginedata/instructions/hash_end.php';
require_once 'enginedata/instructions/hash_start.php';
require_once 'enginedata/instructions/multi_line_array_end.php';
require_once 'enginedata/instructions/multi_line_array_start.php';
require_once 'enginedata/instructions/noop.php';
require_once 'enginedata/instructions/number.php';
require_once 'enginedata/instructions/number_with_decimal.php';
require_once 'enginedata/instructions/property.php';
require_once 'enginedata/instructions/property_with_data.php';
require_once 'enginedata/instructions/single_line_array.php';
require_once 'enginedata/instructions/string.php';


class EngineData
{
    use DocumentHelpers;

    private $text;
    private $parsed;

    private $INSTRUCTIONS = array(
        'HashStart',
        'HashEnd',
        'SingleLineArray',
        'MultiLineArrayStart',
        'MultiLineArrayEnd',
        'Property',
        'PropertyWithData',
        'Stringg',
        'NumberWithDecimal',
        'Number',
        'Boolean',
        'Noop'
    );




    public static function load( $file )
    {
        $text = file_get_contents( $file );
        return new self( $text );
    }

    public function __construct( $text )
    {
        $this->text = new Text( $text );

        $this->property_stack = array();
        $this->node_stack = array();

        $this->property = 'root';
        $this->node = null;

        $this->parsed = false;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getPropertyStack(){ return $this->property_stack; }
    public function getNodeStack(){     return $this->node_stack;     }
    public function getProperty(){      return $this->property;       }
    public function getNode(){          return $this->node;           }
    public function getNodeToId($id){ return $this->node[$id]; }

    public function setPropertyStack($property_stack){  $this->property_stack = $property_stack; }
    public function setNodeStack($node_stack){          $this->node_stack = $node_stack;         }
    public function setProperty($property){             $this->property = $property;             }
    public function setNode($node){                     $this->node = $node;                     }

    // Has the document been parsed yet?
    public function parsed()
    {
        return $this->parsed;
    }

    public function parse()
    {

        if( $this->parsed() === true ) {
            return null;
        }

        while( true )
        {
            $line = $this->text->current();

            if($line === null)
            {
                $this->parsed = true;
                return null;
            }

            $this->parse_tokens( $line );
            $this->text->next();
        }
    }

    public function parse_tokens( $text )
    {
        foreach ($this->INSTRUCTIONS as $inst)
        {
            $match = $inst::classMatch( $text );

            if( isset($match) )
            {
                $obj = new $inst($this, $text);
                return $obj->execute();
            }
        }

        $match = $text . $this->text->getNext();

        if( $match )
        {
            echo '<br>Line = '.($this->text->getLine() + 1);
            $text .= $this->text->next();
            $obj = new Stringg($this, $text);
            return $obj->execute();
        }


        throw new TokenNotFound('Text = '.htmlspecialchars($text).', Line = '.( $this->text->getLine() + 1 ));
    }
}

