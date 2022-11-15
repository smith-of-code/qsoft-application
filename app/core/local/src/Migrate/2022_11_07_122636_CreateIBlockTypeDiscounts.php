<?php

use Bitrix\Main\DB\Connection;
use QSoft\Migrate\BaseCreateIBlockTypeMigration;

final class CreateIBlockTypeDiscounts extends BaseCreateIBlockTypeMigration
{
    protected array $iBlockType = [
        'ID' => 'discounts',
        'SECTIONS' => 'N',
        'IN_RSS' => 'N',
        'SORT' => 100,
        'LANG' => [
            'ru' => [
                'NAME' => 'Акции',
                'SECTION_NAME' => 'Акции',
                'ELEMENT_NAME' => 'Акции',
            ],
            'en' => [
                'NAME' => 'Discounts',
                'SECTION_NAME' => 'Discounts',
                'ELEMENT_NAME' => 'Discounts',
            ],
        ],
    ];
}
