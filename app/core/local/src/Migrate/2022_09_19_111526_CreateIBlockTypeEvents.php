<?php

use QSoft\Migrate\BaseCreateIBlockTypeMigration;

final class CreateIBlockTypeEvents extends BaseCreateIBlockTypeMigration
{
    protected array $iBlockType = [
        'ID' => 'events',
        'SECTIONS' => 'N',
        'IN_RSS' => 'N',
        'SORT' => 100,
        'LANG' => [
            'ru' => [
                'NAME' => 'Мероприятия',
                'SECTION_NAME' => 'Мероприятия',
                'ELEMENT_NAME' => 'Мероприятия',
            ],
            'en' => [
                'NAME' => 'Events',
                'SECTION_NAME' => 'Events',
                'ELEMENT_NAME' => 'Events',
            ],
        ],
    ];
}
