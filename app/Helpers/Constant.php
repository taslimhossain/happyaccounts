<?php

namespace App\Helpers;

class Constant
{
    public const PROJECT_STATUS = [
        'not_started' => 1,
        'canceled'    => 2,
        'finished'    => 3,
        'in_progress' => 4,
        'on_hold'     => 5
    ];
    
    public static function getProjectStatus(): array
    {
        return [
            self::PROJECT_STATUS['not_started'] => 'Not Started',
            self::PROJECT_STATUS['canceled']    => 'Canceled',
            self::PROJECT_STATUS['finished']    => 'Finished',
            self::PROJECT_STATUS['in_progress'] => 'In Progress',
            self::PROJECT_STATUS['on_hold']     => 'On hold'
        ];
    }

    public const ROW_STATUS = [
        'active'    => 1,
        'in_active' => 0
    ];
    
    public static function getRowStatus(): array
    {
        return [
            self::ROW_STATUS['active']    => 'Active',
            self::ROW_STATUS['in_active'] => 'In Active'
        ];
    }

}