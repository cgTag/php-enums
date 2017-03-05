<?php
namespace cgTag\Enums\Exceptions;

class EnumException extends \Exception
{
    /**
     * @param string $value
     * @param string $caller
     * @param \Exception|null $previous
     */
    public function __construct($value, $caller, \Exception $previous = null)
    {
        parent::__construct("{$value} is not a {$caller} enum value", 0, $previous);
    }
}