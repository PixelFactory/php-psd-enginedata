<?php

declare(strict_types=1);

namespace Enginedata;

use Exception;
use Enginedata\Interfaces\NodeInterface;

class Node implements NodeInterface
{
    protected array $node = [];
    protected array $path = [];

    public function getNode(): array
    {
        return $this->node;
    }

    /**
     * Sets value in node
     *
     * Example:
     * ```
     * $node = [];
     *
     * $obj->setValue('key', 'value');
     *
     * $node = [
     *     'key' => 'value'
     * ];
     * ```
     *
     * @param mixed $key
     * @param mixed $value
     * @throws Exception
     */

    public function setValue($key, $value): void
    {
        $this->setNodeData($value, $key);
    }

    /**
     * Adds value in node
     *
     * Example:
     * ```
     * $node = [];
     *
     * $obj->addValue('value1');
     * $obj->addValue('value2');
     * $obj->addValue('value3');
     *
     * $node = [
     *     0 => 'value1',
     *     1 => 'value2',
     *     2 => 'value3'
     * ];
     * ```
     * @param mixed $value
     * @throws Exception
     */
    public function addValue($value): void
    {
        $this->setNodeData($value);
    }

    /**
     * Adds a new node (empty array)
     *
     * Example:
     * ```
     * $path = [];
     * $node = [
     *   'val1' => 'data1',
     * ];
     *
     * $obj->addNode('node1');
     *
     * $path = ['node1'];
     * $node = [
     *   'val1'  => 'data1',
     *   'node1' => [
     *      // Next setValue adds data in this array (use parentNode method to change path)
     *   ],
     * ];
     * ```
     *
     * @param mixed $key
     */
    public function addNode($key = null): void
    {
        $node = &$this->getNodeByPath();

        if(isset($key))
        {
            $node[$key] = [];
            $this->path[] = $key;
        }else{
            $node[] = [];
            // Set in path last value key
            $this->path[] = end(...[array_keys($node)]);
        }
    }

    /**
     * Changes path
     *
     * Example:
     * ```
     * $path = ['node1', 'node2'];
     * $node = [
     *     'node1' => [
     *         'node2' => [
     *             // Next setValue will add data in array 'node2'
     *         ]
     *     ]
     * ];
     *
     * $obj->parentNode();
     *
     * $path = ['node1'];
     * $node = [
     *     'node1' => [
     *         // Next setValue will add data in array 'node1'
     *         'node2' => [
     *         ]
     *     ]
     * ];
     * ```
     */
    public function parentNode(): void
    {
        array_pop($this->path);
    }

    /**
     * Validates data and set value in node
     *
     * @param mixed $value
     * @param mixed $key
     * @throws Exception
     */
    protected function setNodeData($value, $key = null): void
    {
        $node = &$this->getNodeByPath();
        $data = $this->validateValue($value);

        // Checks num arguments because key can be set to 'null': $obj->setValue(null, 'data');
        if (func_num_args() < 2) {
            $node[] = $data;
            return;
        }

        if (array_key_exists($key, $node)) {
            throw new Exception('Duplicate key: "' . var_export($key, true) . '"');
        }

        $node[$key] = $data;
    }

    /**
     * Blocks the addition of objects, array or other not scalar types.
     * If you need add array, create empty array using addNode
     * and add value using setValue or addValue methods
     *
     * @param $value
     * @return mixed
     * @throws Exception
     */
    protected function validateValue($value)
    {
        if (is_scalar($value)) {
            return $value;
        }

        throw new Exception('Node supported only scalar types.');
    }

    /**
     * Returns reference to node using path
     *
     * Example:
     * ```
     * $foo = [
     *     'key_1' => [
     *         'key_2' => [
     *              'key_3' => [
     *                  'data' => 'Test Data'
     *              ]
     *          ]
     *     ]
     * ];
     * $bar1 = &getNodeByPath(['key_1', 'key_2', 'key_3']);
     * $bar2 = &getNodeByPath(['key_1', 'key_2', 'key_3', 'data']);
     *
     * var_dump($bar1); // Return: [ 'data' => 'Test Data' ]
     * var_dump($bar2); // Return: 'Test Data'
     *
     * $bar2 = 'New Test Data'
     *
     * $foo = [
     *     'key_1' => [
     *         'key_2' => [
     *              'key_3' => [
     *                  'data' => 'New Test Data'
     *              ]
     *          ]
     *     ]
     * ];
     * ```
     * @return mixed
     */
    protected function &getNodeByPath()
    {
        $temp = &$this->node;

        foreach($this->path as $key) {
            $temp = &$temp[$key];
        }

        return $temp;
    }
}