<?php

namespace Bryse\Enums;

use InvalidArgumentException;
use Bryse\Enums\Exceptions\UndefinedEnumValueException;

/**
 * A simple enum value model, providing an interface to
 * handle its data with helpful methods.
 */
abstract class Enum implements EnumContract
{
    /**
     * The current value of the enum.
     *
     * @var int
     */
    protected $enumValue;

    public function __construct($enumValue = null)
    {
        if ($enumValue) {
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
        if (! is_numeric($enumValue)) {
            throw new InvalidArgumentException();
        }

        if (! $this->has($enumValue)) {
            throw new UndefinedEnumValueException($enumValue);
        }

        $this->enumValue = (int) $enumValue;

        return (string) $this;
    }

    /**
     * Returns the current enum value.
     *
     * @return int
     */
    public function value()
    {
        return (int) $this->enumValue;
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
     * @return bool
     */
    public function is($value)
    {
        return $this->enumValue == $value;
    }

    public function __toString()
    {
        if (is_array($representation = $this->get($this->enumValue))) {
            $representation = json_encode($representation);
        }

        return $representation;
    }
}
