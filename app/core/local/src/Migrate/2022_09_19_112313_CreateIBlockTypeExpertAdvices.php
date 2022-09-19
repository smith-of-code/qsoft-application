<?php

use QSoft\Migrate\BaseCreateIBlockTypeMigration;

final class CreateIBlockTypeExpertAdvices extends BaseCreateIBlockTypeMigration
{
    protected array $iBlockType = [
        'ID' => 'expert_advices',
        'SECTIONS' => 'N',
        'IN_RSS' => 'N',
        'SORT' => 100,
        'LANG' => [
            'ru' => [
                'NAME' => 'Советы эксперта',
                'SECTION_NAME' => 'Советы эксперта',
                'ELEMENT_NAME' => 'Советы эксперта',
            ],
            'en' => [
                'NAME' => 'Expert Advices',
                'SECTION_NAME' => 'Expert Advices',
                'ELEMENT_NAME' => 'Expert Advices',
            ],
        ],
    ];
}
