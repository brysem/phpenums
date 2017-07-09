<?php

namespace Tests\App\Models;

/**
 * Basic example for a user model that may use Enum as a value model.
 */
class User
{
    protected $attributes = array();

    public function __construct($attributes = array())
    {
        $this->attributes = $attributes;
    }

    public function __get($property)
    {
        if (array_key_exists($property, $this->attributes)) {
            return $this->attributes[$property];
        }

        return null;
    }

    public function __set($property, $value)
    {
        $this->attributes[$property] = $value;
    }
}
