<?php

class NodeTest extends TestCase
{
    public function testGetNode()
    {
        $node = new \Enginedata\Node();
        $this->assertSame($node->getNode(), []);
    }
}
