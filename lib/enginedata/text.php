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

// # -*- encoding : utf-8 -*-
// class PSD
//   class EngineData
//     # Sanitizes and helps with access to the document text.
//     class Text
//       # The current document split by newlines into an array.
//       attr_reader   :text

//       # The current line number in the document.
//       attr_accessor :line

//       # Stores the document as a newline-split array and initializes
//       # the current line to 0.
//       def initialize(text)
//         @text = text.split("\n")
//         @line = 0
//       end

//       # Returns the current line stripped of any tabs and padding.
//       def current
//         return nil if at_end?
//         @text[@line].gsub(/\t/, "").strip
//       end

//       # Are we at the end of the document?
//       def at_end?
//         @text[@line].nil?
//       end

//       # Moves the line pointer to the next line and returns it.
//       def next!
//         @line += 1
//         current
//       end

//       # Peeks at the next line in the document without moving the
//       # line pointer.
//       def next
//         @text[@line + 1]
//       end

//       # Returns the number of lines in the document.
//       def length
//         @text.length
//       end
//       alias :size :length
//     end
//   end
// end
