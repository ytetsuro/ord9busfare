<?php
namespace NagoyaPHP\Enum;
use LogicException;
use ReflectionClass;

abstract class Enum
{
    private $scalar;

    protected static $instances = [];

    private function __construct($value)
    {
        $this->scalar = $value;
    }

    final public static function __callStatic($label, $args)
    {
        $class = get_called_class();
        if (! defined('static::'.$label)) {
            throw new LogicException($label. $class);
        }

        $const = constant("$class::$label");
        if ( ! isset(static::$instances[$label]) ) {
            static::$instances[$label] = new $class($const);
        }

        return static::$instances[$label];
    }

    final public static function values()
    {
        $class = get_called_class();
        $ref = new ReflectionClass($class);
        $consts = $ref->getConstants();
        $result = [];
        foreach ($consts as $const_name => $value) {
            $result[] = static::$const_name();
        }

        return $result;
    }

    final public function valueOf()
    {
        return $this->scalar;
    }

    final public function __toString()
    {
        return (string)$this->scalar;
    }
}