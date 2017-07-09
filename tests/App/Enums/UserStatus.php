<?php

namespace Tests\App\Enums;

use Bryse\Enums\Enum;

class UserStatus extends Enum
{
    const PENDING = 1;
    const ACTIVE = 2;
    const BANNED = 3;
    const MIXED = 4;

    /**
     * Returns all possible key value pairs for the enum.
     *
     * @return array
     */
    public function values()
    {
        return array(
            self::PENDING => 'Pending',
            self::ACTIVE  => 'Active',
            self::BANNED  => 'Banned',
            self::MIXED   => array('foo' => 'bar'),
        );
    }
}
