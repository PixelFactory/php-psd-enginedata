<?php

use PHPUnit\Framework\TestCase as Test;

class TestCase extends Test
{
    /**
     * @param $obj
     * @param $propertyName
     * @return mixed
     * @throws ReflectionException
     */
    public function getPrivateProperty($obj, $propertyName)
    {
        $reflection = new ReflectionObject($obj);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }

    /**
     * @param $obj
     * @param $propertyName
     * @throws ReflectionException
     */
    public function setPrivateProperty($obj, $propertyName, $propertyVal)
    {
        $reflection = new ReflectionObject($obj);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($obj, $propertyVal);
    }

    /**
     * @param $obj
     * @param $method_name
     * @param array $params
     * @return mixed
     * @throws ReflectionException
     */
    protected function callProtectedMethod($obj, $method_name, array $params = [])
    {
        $reflector = new ReflectionObject($obj);
        $method = $reflector->getMethod($method_name);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $params);
    }
}
