<?php
class PropertyWithData extends Instruction{
  static function token()
  {
    return '/^\/([A-Z0-9]+) (.*)$/i';
  }

    public function execute()
    {
        $match = $this->match();
        $this->document->set_property($match[1]);
        $data = $this->document->parse_tokens($match[2]);


        $node = $this->document->getNode();

        if( $node instanceof Node )
        {
            $property = $this->document->getProperty();
            return $node->$property = $data;
        }elseif( is_array($node) )
        {
            return array_push($node, $data);
        }
    }
}
