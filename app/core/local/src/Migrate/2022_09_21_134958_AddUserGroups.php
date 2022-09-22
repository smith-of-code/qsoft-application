<?php

use QSoft\Migration\Migration;
use QSoft\Migrate\Traits\AddUserGroupsTrait;

class AddUserGroups extends Migration
{
    use AddUserGroupsTrait;

    private array $groups = [
        [
            'NAME' => 'Консультант',
            'STRING_ID' => 'consultant',
            'ACTIVE' => 'Y',
            'C_SORT' => 400,
        ],
        [
            'NAME' => 'Покупатель',
            'STRING_ID' => 'buyer',
            'ACTIVE' => 'Y',
            'C_SORT' => 400,
        ],
    ];
}