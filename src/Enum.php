<?php
namespace cgTag\Enums;

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
        return in_array($value, static::toArray());
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
        $className = get_called_class();
        //throw new InvalidOperationException("[{$value}] is not a [{$className}] enum");
        throw new \Exception("[{$value}] is not a [{$className}] enum");
    }

    /**
     * Constructor
     */
    final private function __construct()
    {
        //throw new GemsNotImplementedException();
        throw new \Exception('not implemented');
    }

    /**
     * @throws \Exception
     */
    final private function __clone()
    {
        //throw new GemsNotImplementedException();
        throw new \Exception('not implemented');
    }
}
