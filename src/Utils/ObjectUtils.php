<?php
namespace Schwaen\Common\Utils;

/**
 * ObjectUtils
 */
class ObjectUtils
{
    /**
     * Get all constants of the given $class or object.
     * Constant name in key, constant value in value.
     *
     * @param object|string $class
     * @return array
     */
    public static function getConstants($class)
    {
        static $constants = [];
        if (is_object($class)) {
            $class = get_class($class);
        }
        if (!isset($constants[$class])) {
            $constants[$class] = (new \ReflectionClass($class))->getConstants();
        }
        return $constants[$class];
    }
}
