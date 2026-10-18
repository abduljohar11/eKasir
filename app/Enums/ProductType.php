<?php
namespace App\Enums;

enum ProductType: string
{
    case DIGITAL = 'digital';
    case FISIK = 'fisik';

    public static function default(): self
    {
        return self::FISIK;
    }
}
