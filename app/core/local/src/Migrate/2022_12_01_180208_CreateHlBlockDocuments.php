<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockDocuments extends BaseCreateHighloadMigration
{
    protected ?string $seeder = null;

    protected array $blockInfo = [
        'NAME' => 'HlDocuments',
        'TABLE_NAME' => 'documents',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок документов',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_NAME',
            'SORT' => 100,
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'Название'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Название'],
            'LIST_FILTER_LABEL' => ['ru' => 'Название'],
        ],
        [
            'FIELD_NAME' => 'UF_DOCUMENT',
            'USER_TYPE_ID' => 'file',
            'XML_ID' => 'UF_DOCUMENT',
            'SORT' => 100,
            'MULTIPLE' => 'Y',
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'Документ(ы)'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Документ(ы)'],
            'LIST_FILTER_LABEL' => ['ru' => 'Документ(ы)'],
        ],
    ];

    protected array $enumValues = [
        'UF_NAME' => [
            'n1' => [
                'XML_ID' => 'CERT',
                'VALUE' => 'Сертификаты, подтверждающие качество нашей продукции',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'MARKET_PLAN',
                'VALUE' => 'Маркетинговый план',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n3' => [
                'XML_ID' => 'CONSULTANTS_LIST',
                'VALUE' => 'Список наших консультантов',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n4' => [
                'XML_ID' => 'GENERAL_RULES',
                'VALUE' => 'Общие условия и правила',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n5' => [
                'XML_ID' => 'RULES_AND_CONDITIONS_FOR_CLIENTS',
                'VALUE' => 'Правила и условия для клиентов',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n6' => [
                'XML_ID' => 'RULES_AND_CONDITIONS_FOR_SELF_EMPLOYED',
                'VALUE' => 'Правила и условия для самозанятых',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n7' => [
                'XML_ID' => 'RULES_AND_CONDITIONS_FOR_IP',
                'VALUE' => 'Правила и условия для ИП',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n8' => [
                'XML_ID' => 'RULES_AND_CONDITIONS_FOR_LTC',
                'VALUE' => 'Правила и условия для ООО',
                'DEF' => 'N',
                'SORT' => 10,
            ],
        ],
    ];
}