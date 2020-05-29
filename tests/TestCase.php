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
        $reflection = $this->getReflectionObject($obj);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $params);
    }

    /**
     * @param $obj
     * @param $name
     * @return mixed
     */
    protected function getConstant($obj, $name)
    {
        $reflection = $this->getReflectionObject($obj);
        return $reflection->getConstant($name);
    }

    private function getReflectionObject($obj)
    {
        if ($obj instanceof Reflector) {
            return $obj;
        }

        return new ReflectionObject($obj);
    }
}
