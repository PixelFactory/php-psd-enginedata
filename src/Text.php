<?php

namespace Enginedata;

use ArrayIterator;

class Text extends ArrayIterator
{

    public function __construct($text, $flags = 0)
    {
        $text = preg_replace('/(\n\t*)>>/', '$1>>>', $text);
        $text = preg_replace('/(\n\t*)<</', '$1<<<', $text);
        $text = preg_replace('/(\n\t*)\]/', '$1]]', $text);
        $text_array = preg_split("/\n\t*(\/|<|>|\])/", $text);

        parent::__construct($text_array, $flags);
    }
}
