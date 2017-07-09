<?php

namespace Bryse\Enums\Exceptions;

use Exception;

class UndefinedEnumValueException extends Exception
{
    /**
     * The enum value that was being accessed.
     *
     * @var int
     */
    protected $value;

    public function __construct($message = null, $value = null, $previous = null)
    {
        if (func_num_args() == 1) {
            list($message, $value) = array('Trying to access an undefined enum value (%s).', $message);
        }

        $this->message = sprintf($message, $value);
        $this->value = $value;

        parent::__construct($message, $value, $previous);
    }

    public function value()
    {
        return (int) $this->value;
    }
}
