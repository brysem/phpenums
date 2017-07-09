<?php

namespace Bryse\Enums;

use Bryse\Enums\Exceptions\UndefinedEnumValueException;

/**
 * Provides a simple enum value model with an
 * interface to handle its data with helpful methods.
 */
interface EnumContract
{
    /**
     * Returns all possible key value pairs for the enum.
     *
     * @return array
     */
    public static function all();

    /**
     * Returns all possible key value pairs for the enum.
     *
     * @return array
     */
    public function values();

    /**
     * Returns the text equivalent for a specific enum value.
     *
     * @throws UndefinedEnumValueException
     *
     * @return string
     */
    public function get($enumValue);

    /**
     * Sets the enum value to a pre-defined value.
     *
     * @throws UndefinedEnumValueException
     *
     * @return int
     */
    public function set($enumValue);

    /**
     * Returns the current enum value.
     *
     * @return int
     */
    public function value();

    /**
     * Checks whether a specific value is a valid for the enum.
     *
     * @return bool
     */
    public function has($value);

    /**
     * Performs a truth comparison against the current enum value.
     *
     * @return bool
     */
    public function is($value);
}
