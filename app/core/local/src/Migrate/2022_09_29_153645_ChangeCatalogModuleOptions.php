<?php

use QSoft\Migrate\Traits\ChangeModuleOptionsTrait;
use QSoft\Migration\Migration;

class ChangeCatalogModuleOptions extends Migration
{
    use ChangeModuleOptionsTrait;

    private string $module = 'catalog';

    private array $options = [
        'enable_processing_deprecated_events' => [
            'from' => 'N',
            'to' => 'Y',
        ],
    ];
}