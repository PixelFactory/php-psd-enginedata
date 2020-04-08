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
}
