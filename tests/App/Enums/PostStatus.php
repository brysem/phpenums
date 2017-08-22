<?php

namespace Tests\App\Enums;

use Bryse\Enums\Enum;

class PostStatus extends Enum
{
    const UNPUBLISHED = 'unpublished';
    const PUBLISHED = 'published';
    const ARCHIVED = 'archived';

    /**
     * Returns all possible key value pairs for the enum.
     *
     * @return array
     */
    public function values()
    {
        return array(
            self::UNPUBLISHED => 'Unpublished Post',
            self::PUBLISHED   => 'Published Post',
            self::ARCHIVED    => 'Archived Post',
        );
    }
}
