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
        'in_active' => 2
    ];
    
    public static function getRowStatus(): array
    {
        return [
            self::ROW_STATUS['active']    => 'Active',
            self::ROW_STATUS['in_active'] => 'In Active'
        ];
    }


    public const PROJECT_TRANSACTIONS = [
        'tranaction'         => 0,
        'pay_to_vendor'      => 1,
        'return_from_vendor' => 2,
        'get_from_client'    => 3,
        'return_to_client'   => 4,
    ];
    
    public static function getProjectTransactions(): array
    {
        return [
            self::PROJECT_TRANSACTIONS['tranaction']            => 'Simple tranaction',
            self::PROJECT_TRANSACTIONS['pay_to_vendor']         => 'Pay to vendor',
            self::PROJECT_TRANSACTIONS['return_from_vendor']    => 'Get return from vendor',
            self::PROJECT_TRANSACTIONS['get_from_client']       => 'Get payment from client',
            self::PROJECT_TRANSACTIONS['return_to_client']      => 'Pay return to client',
        ];
    }

    public const TRANSACTIONS = [
        'tranaction'             => 0,
        'pay_to_vendor'          => 1,
        'return_from_vendor'     => 2,
        'get_from_client'        => 3,
        'return_to_client'       => 4,
        'found_transfer'         => 5,
        'cash_withdrawal'        => 6,
        'bank_deposit'           => 7,
        'pay_salary'             => 8,
        'office_expenses'        => 9,
        'project_other_expenses' => 10,
    ];
    
    public static function getTransactions(): array
    {
        return [
            self::TRANSACTIONS['tranaction']             => 'Simple tranaction',
            self::TRANSACTIONS['pay_to_vendor']          => 'Pay to vendor',
            self::TRANSACTIONS['return_from_vendor']     => 'Get return from vendor',
            self::TRANSACTIONS['get_from_client']        => 'Get payment from client',
            self::TRANSACTIONS['return_to_client']       => 'Pay return to client',
            self::TRANSACTIONS['found_transfer']         => 'Found Transfer',
            self::TRANSACTIONS['cash_withdrawal']        => 'Cash withdrawal',
            self::TRANSACTIONS['bank_deposit']           => 'Bank deposit',
            self::TRANSACTIONS['pay_salary']             => 'Pay salary',
            self::TRANSACTIONS['office_expenses']        => 'Office Expenses',
            self::TRANSACTIONS['project_other_expenses'] => 'Project other expenses'
        ];
    }

}