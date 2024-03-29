<?php

namespace Bryse\Enums;

use JsonSerializable;
use InvalidArgumentException;
use Bryse\Enums\Exceptions\UndefinedEnumValueException;

/**
 * A simple enum value model, providing an interface to
 * handle its data with helpful methods.
 */
abstract class Enum implements EnumContract, JsonSerializable
{
    /**
     * The current value of the enum.
     *
     * @var int
     */
    protected $enumValue;

    public function __construct($enumValue = null)
    {
        if (! is_null($enumValue)) {
            $this->set($enumValue);
        }
    }

    /**
     * Returns all possible key value pairs for the enum.
     *
     * @return array
     */
    public static function all()
    {
        $instance = new static();

        return $instance->values();
    }

    /**
     * Returns all available keys on the enum.
     *
     * @return array
     */
    public static function keys()
    {
        $instance = new static();

        return array_keys($instance->values());
    }

    /**
     * Returns the text equivalent for a specific enum value.
     *
     * @throws UndefinedEnumValueException
     *
     * @return string
     */
    public function get($enumValue)
    {
        if (! $this->has($enumValue)) {
            throw new UndefinedEnumValueException($enumValue);
        }

        $values = $this->values();

        return $values[$enumValue];
    }

    /**
     * Sets the enum value to a pre-defined value.
     *
     * @throws InvalidArgumentException
     * @throws UndefinedEnumValueException
     *
     * @return string
     */
    public function set($enumValue)
    {
        if (! $this->has($enumValue)) {
            throw new UndefinedEnumValueException($enumValue);
        }

        $this->enumValue = $enumValue;

        return $this->__toString();
    }

    /**
     * Returns the current enum value.
     *
     * @return int
     */
    public function value()
    {
        return $this->enumValue;
    }

    /**
     * Checks whether a specific value is a valid for the enum.
     *
     * @return bool
     */
    public function has($value)
    {
        return array_key_exists($value, $this->values());
    }

    /**
     * Performs a truth comparison against the current enum value.
     *
     * @param string|array $value
     *
     * @return bool
     */
    public function is($value)
    {
        $value = is_array($value) ? $value : array($value);

        return in_array($this->enumValue, $value);
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->value();
    }

    public function __toString()
    {
        if (is_array($representation = $this->get($this->enumValue))) {
            $representation = json_encode($representation);
        }

        return $representation;
    }
}
