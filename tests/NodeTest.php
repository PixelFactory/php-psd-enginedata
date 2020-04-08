<?php

class NodeTest extends TestCase
{
    public function testGetNode()
    {
        $node = new \Enginedata\Node();
        $this->assertSame($node->getNode(), []);
    }

    public function testSetValue()
    {
        $node = new \Enginedata\Node();

        $node->setValue('name_1');
        $this->assertSame($node->getNode(), ['name_1' => null]);

        $node->setValue('name_2');
        $this->assertSame($node->getNode(), ['name_1' => ['name_2' => null]]);

        $node->setValue('name_3', 'val_1');
        $node->setValue('name_4', 'val_2');

        $this->assertSame($node->getNode(), ['name_1' => ['name_2' => [
            'name_3' => 'val_1',
            'name_4' => 'val_2'
        ]]]);
    }

    public function testParentNode()
    {
        $node = new \Enginedata\Node();

        $node->setValue('name_1');
        $node->setValue('name_2', 'val_1');
        $node->parentNode();
        $node->setValue('name_3', 'val_2');

        $this->assertSame($node->getNode(), [
            'name_1' => ['name_2' => 'val_1'],
            'name_3' => 'val_2'
        ]);
    }
}
