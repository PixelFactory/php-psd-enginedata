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
    protected function getPrivateProperty($obj, $propertyName)
    {
        $reflection = $this->getReflectionObject($obj);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }

    /**
     * @param $obj
     * @param $propertyName
     * @param $propertyVal
     * @throws ReflectionException
     */
    protected function setPrivateProperty($obj, $propertyName, $propertyVal)
    {
        $reflection = $this->getReflectionObject($obj);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($obj, $propertyVal);
    }

    /**
     * @param $obj
     * @param $methodName
     * @param array $params
     * @return mixed
     * @throws ReflectionException
     */
    protected function callProtectedMethod($obj, $methodName, array $params = [])
    {
        $reflector = $this->getReflectionObject($obj);
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $params);
    }

    protected function getReflectionObject($obj)
    {
        if ($obj instanceof Reflector) {
            return $obj;
        }

        return new ReflectionObject($obj);
    }
}
