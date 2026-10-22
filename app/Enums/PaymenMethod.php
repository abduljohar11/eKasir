<?php
namespace App\Enums;

enum PaymenMethod: string
{
    case CASH = 'cash';
    case DEBIT = 'debit';
    case QRIS = 'qiris';

    public static function default(): self
    {
        return self::CASH;
    }
}
