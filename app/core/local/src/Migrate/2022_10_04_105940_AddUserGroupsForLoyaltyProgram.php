<?php

use QSoft\Migration\Migration;
use QSoft\Migrate\Traits\AddUserGroupsTrait;

class AddUserGroupsForLoyaltyProgram extends Migration
{
    use AddUserGroupsTrait;

    private array $groups = [
        [
            'NAME' => 'Консультант - 1',
            'STRING_ID' => 'consultant_1',
            'ACTIVE' => 'Y',
            'C_SORT' => 400,
        ],
        [
            'NAME' => 'Консультант - 2',
            'STRING_ID' => 'consultant_2',
            'ACTIVE' => 'Y',
            'C_SORT' => 400,
        ],
        [
            'NAME' => 'Консультант - 3',
            'STRING_ID' => 'consultant_3',
            'ACTIVE' => 'Y',
            'C_SORT' => 400,
        ],
    ];
}