<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\PetSeeder;

final class CreateHlBlockFaq extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'HLFaq',
        'TABLE_NAME' => 'faq',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок вопросы и ответы',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_GROUP',
            'USER_TYPE_ID' => 'enumeration',
            'MULTIPLE' => 'N',
            'XML_ID' => 'UF_GROUP',
            'MANDATORY' => 'Y',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Группа'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Группа'],
            'LIST_FILTER_LABEL' => ['ru' => 'Группа'],
        ],
        [
            'FIELD_NAME' => 'UF_QUESTION',
            'USER_TYPE_ID' => 'string',
            'MULTIPLE' => 'N',
            'XML_ID' => 'UF_QUESTION',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Вопрос'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Вопрос'],
            'LIST_FILTER_LABEL' => ['ru' => 'Вопрос'],
            'SETTINGS' => [
                'SIZE' => 49,
            ],
        ],
        [
            'FIELD_NAME' => 'UF_ANSWER',
            'USER_TYPE_ID' => 'string',
            'MULTIPLE' => 'N',
            'XML_ID' => 'UF_ANSWER',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Ответ'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Ответ'],
            'LIST_FILTER_LABEL' => ['ru' => 'Ответ'],
            'SETTINGS' => [
                'SIZE' => 50,
                'ROWS' => 10,
                'MAX_LENGTH' => 2047,
            ],
        ],
    ];

    protected array $enumValues = [
        'UF_GROUP' => [
            'n1' => [
                'XML_ID' => 'GROUP_REGISTRATION',
                'VALUE' => 'Регистрация',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'GROUP_CONSULTANTS',
                'VALUE' => 'Консультанты',
                'DEF' => 'N',
                'SORT' => 20,
            ],
            'n3' => [
                'XML_ID' => 'GROUP_PAYMENT',
                'VALUE' => 'Оплата',
                'DEF' => 'N',
                'SORT' => 30,
            ],
            'n4' => [
                'XML_ID' => 'GROUP_DELIVERY',
                'VALUE' => 'Доставка',
                'DEF' => 'N',
                'SORT' => 40,
            ],
            'n5' => [
                'XML_ID' => 'GROUP_RETURN',
                'VALUE' => 'Возврат и претензии',
                'DEF' => 'N',
                'SORT' => 50,
            ],
            'n6' => [
                'XML_ID' => 'GROUP_PERSONAL',
                'VALUE' => 'Личный кабинет',
                'DEF' => 'N',
                'SORT' => 60,
            ],
            'n7' => [
                'XML_ID' => 'GROUP_AME',
                'VALUE' => 'Продукция AmeAppetite',
                'DEF' => 'N',
                'SORT' => 70,
            ],
            'n8' => [
                'XML_ID' => 'GROUP_FOOD',
                'VALUE' => 'Питание шерстяного детеныша',
                'DEF' => 'N',
                'SORT' => 80,
            ],
            'n9' => [
                'XML_ID' => 'GROUP_HEALTH',
                'VALUE' => 'Здоровье домашнего питомца',
                'DEF' => 'N',
                'SORT' => 90,
            ],
        ]
    ];
}
