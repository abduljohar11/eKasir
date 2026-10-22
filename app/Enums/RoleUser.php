<?php
namespace App\Enums;

enum RoleUser: string
{
    case KASIR = 'kasir';
    case ADMIN = 'admin';

    public static function default(): self
    {
        return self::KASIR;
    }
}
