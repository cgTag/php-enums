<?php
namespace cgTag\Enums;

use cgTag\Enums\Exceptions\EnumException;
use cgTag\Exceptions\NotImplementedException;

/**
 * Use this GemsEnum as a base class to declare enumerations.
 */
abstract class Enum
{
    /**
     * @param mixed $value
     * @return bool
     */
    final public static function isValid($value): bool
    {
        if (is_array($value) || is_object($value)) {
            return false;
        }
        return in_array($value, static::toArray(), true);
    }

    /**
     * @return array
     */
    final public static function toArray(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /**
     * @return array
     */
    final public static function toOptions(): array
    {
        return array_flip(static::toArray());
    }

    /**
     * @param $value
     * @return string|null
     */
    public static function toString($value): string
    {
        foreach (static::toArray() as $name => $constant) {
            if ($constant === $value) {
                return $name;
            }
        }
        return null;
    }

    /**
     * Throws an exception if the value is not part of the enum constants.
     *
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    final public static function validate($value)
    {
        if (static::isValid($value)) {
            return $value;
        }
        throw new EnumException($value, get_called_class());
    }

    /**
     * Constructor
     */
    final private function __construct()
    {
        throw new NotImplementedException();
    }

    /**
     * @throws \Exception
     */
    final private function __clone()
    {
        throw new NotImplementedException();
    }
}
