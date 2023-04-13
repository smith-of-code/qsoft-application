<?php

use QSoft\Migrate\Traits\ChangeModuleOptionsTrait;
use QSoft\Migration\Migration;

class ChangeMainModuleOptions extends Migration
{
    use ChangeModuleOptionsTrait;

    private string $module = 'main';

    private array $options = [
        'new_user_phone_auth' => [
            'from' => 'Y',
            'to' => 'N',
        ],
        'new_user_phone_required' => [
            'from' => 'Y',
            'to' => 'N',
        ],
    ];
}