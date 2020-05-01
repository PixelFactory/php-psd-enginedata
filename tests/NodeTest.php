<?php

use Enginedata\Node;

class NodeTest extends TestCase
{
    public function testGetNode()
    {
        $node = new Node();
        $this->assertSame($node->getNode(), []);
    }

    /**
     * @throws Exception
     */
    public function testSetValue()
    {
        $key = 'Test Key';
        $value = 'Test Value';

        $node = $this->getMockBuilder(Node::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['setNodeData'])
            ->getMock();

        $node->expects($this->once())
            ->method('setNodeData')
            ->with(
                $this->equalTo($value),
                $this->equalTo($key)
            );

        /** @var Node $node */
        $node->setValue($key, $value);
    }

    /**
     * @throws Exception
     */
    public function testAddValue()
    {
        $value = 'Test Value';

        $node = $this->getMockBuilder(Node::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['setNodeData'])
            ->getMock();

        $node->expects($this->once())
            ->method('setNodeData')
            ->with(
                $this->equalTo($value)
            );

        /** @var Node $node */
        $node->addValue($value);
    }

    /**
     * @throws ReflectionException
     */
    public function testAddNode()
    {
        $node = new Node();
        $node->addNode();

        $this->assertEquals($this->getPrivateProperty($node, 'path'), ['0']);
        $this->assertEquals($this->getPrivateProperty($node, 'node'), [[]]);
    }

    /**
     * @throws ReflectionException
     */
    public function testAddNodeWithKey()
    {
        $key = 'Test Key';

        $node = new Node();
        $node->addNode($key);

        $this->assertEquals($this->getPrivateProperty($node, 'path'), [$key]);
        $this->assertEquals($this->getPrivateProperty($node, 'node'), [$key => []]);
    }

    /**
     * @throws ReflectionException
     */
    public function testAddNodeByPath()
    {
        $key = 'Test Key';
        $path = ['node1', 'node2'];
        $nodeBefore = [
            'node1' => [
                'node2' => [
                ],
            ],
        ];

        $nodeAfter = $nodeBefore;
        $nodeAfter['node1']['node2'][$key] = [];

        $node = new Node();
        $this->setPrivateProperty($node, 'path', $path);
        $this->setPrivateProperty($node, 'node', $nodeBefore);

        $node->addNode($key);

        $this->assertEquals($this->getPrivateProperty($node, 'path'), array_merge($path, [$key]));
        $this->assertEquals($this->getPrivateProperty($node, 'node'), $nodeAfter);
    }

    /**
     * @throws ReflectionException
     */
    public function testParentNode()
    {
        $pathBefore =  ['node1', 'node2'];
        $pathAfter = ['node1'];

        $node = new Node();
        $this->setPrivateProperty($node, 'path', $pathBefore);

        $node->parentNode();
        $this->assertEquals($this->getPrivateProperty($node, 'path'), $pathAfter);
    }

    /**
     * @throws ReflectionException
     */
    public function testSetNodeData()
    {
        $value = 'Test Value';
        $node = new Node();

        $this->callProtectedMethod($node, 'setNodeData', [$value]);
        $this->assertEquals($this->getPrivateProperty($node, 'node'), [$value]);
    }

    /**
     * @throws ReflectionException
     */
    public function testSetNodeDataWithKey()
    {
        $key = 'Test Key';
        $value = 'Test Value';
        $node = new Node();

        $this->callProtectedMethod($node, 'setNodeData', [$value, $key]);
        $this->assertEquals($this->getPrivateProperty($node, 'node'), [ $key => $value ]);
    }

    /**
     * @throws ReflectionException
     */
    public function testSetNodeDataException()
    {
        $key = 'Test Key';
        $value = 'Test Value';
        $node = new Node();

        $this->setPrivateProperty($node, 'node', [ $key => $value ]);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Duplicate key: "\'Test Key\'"');

        $this->callProtectedMethod($node, 'setNodeData', [$value, $key]);
    }

    /**
     * @throws ReflectionException
     */
    public function testValidateValue()
    {
        $value = 'Test Value';
        $node = new Node();

        $this->assertEquals($this->callProtectedMethod($node, 'validateValue', [$value]), $value);
    }

    /**
     * @throws ReflectionException
     */
    public function testValidateValueException()
    {

        $node = new Node();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Node supported only scalar types.');

        $this->callProtectedMethod($node, 'validateValue', [new stdClass()]);
    }
}
