<?php
namespace App\Helpers;

enum ProjectStatus : int
{
    const PENDING = 0;
    const PROCESSING = 1;
    const SHIPPED = 2;
    const COMPLETE = 3;

    public static function getDisplayValues(): array
    {
        return [
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::SHIPPED => 'Shipped',
            self::COMPLETE => 'Complete',
        ];
    }
}