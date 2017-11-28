<?php

class Text
  {
    private $text;
    private $line;

    public function __construct( $text )
    {
      $this->text = explode("\n", $text);
      $this->line = 0;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getLine()
    {
        return $this->line;
    }

    public function setLine( $line )
    {
        $this->line = $line;
    }

    public function current()
    {
        if( ! $this->at_end() )
            return null;

        $text = $this->text[ $this->line ];
        $textWithoutTabs = str_replace("\t", '', $text);
        return trim($textWithoutTabs);
    }
    public function at_end()
    {
        if( isset($this->text[ $this->line ]) )
            return TRUE;
        else
            return FALSE;
    }

    public function next()
    {
        $this->line += 1;
        return $this->current();
    }

    public function getNext()
    {
        return $this->text[ $this->line + 1 ];
    }


    public function length()
    {
        return count( $this->text );
    }

    public function size()
    {
        $this->length();
    }
}

