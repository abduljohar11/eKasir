<?php
namespace App\Enums;

use Laravel\Mcp\Enums\Role;

enum StatusUser: string
{
    case ACTIVE = 'active';
    case PENDING = 'pending';
    case SUSPENDED = 'suspended';

    public static function default(): self
    {
        return self::PENDING;
    }
}
