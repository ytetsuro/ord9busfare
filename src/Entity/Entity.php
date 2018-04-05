<?php
namespace NagoyaPHP\Entity;

/**
 * カスタムオブジェクト
 */
abstract class Entity
{
    public function __construct(array $values = [])
    {
        $properties = array_intersect_key($values, get_object_vars($this));
        foreach ($properties as $name => $value) {
            $this->{$name} = $value;
        }
    }

    public function __get($name)
    {
        assert(property_exists($this, $name));

        return $this->{$name};
    }

    public function __isset($name)
    {
        return isset($this->{$name});
    }
}
