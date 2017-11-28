<?php

namespace Enginedata;


class Text extends \ArrayIterator{

    public function __construct( $text , $flags = 0)
    {
        $text = preg_replace('/(\n\t*)>>/','$1>>>', $text);
        $text = preg_replace('/(\n\t*)<</','$1<<<', $text);
        $text = preg_replace('/(\n\t*)\]/','$1]]', $text);
        $text_array = preg_split ("/\n\t*(\/|<|>|\])/", $text);

        //Old explode method
        //$text_array = explode("\n", $text);

        parent::__construct($text_array, $flags);
    }
}