<?php

use QSoft\Migration\Migration;
use QSoft\Migrate\Traits\AddUserGroupsTrait;

class AddUserGroupsForLoyaltyProgram extends Migration
{
    use AddUserGroupsTrait;

    private array $groups = [
        [
            'NAME' => 'Программа лояльности - K1',
            'STRING_ID' => 'loyalty_K1',
            'ACTIVE' => 'Y',
            'C_SORT' => 400,
        ],
        [
            'NAME' => 'Программа лояльности - K2',
            'STRING_ID' => 'loyalty_K2',
            'ACTIVE' => 'Y',
            'C_SORT' => 400,
        ],
        [
            'NAME' => 'Программа лояльности - K3',
            'STRING_ID' => 'loyalty_K3',
            'ACTIVE' => 'Y',
            'C_SORT' => 400,
        ],
    ];
}