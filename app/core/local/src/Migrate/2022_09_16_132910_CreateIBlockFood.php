<?php

use QSoft\Migrate\BaseCreateIBlockMigration;

final class CreateIBlockFood extends BaseCreateIBlockMigration
{
    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => 'catalog',
        'CODE' => 'food',
        'XML_ID' => 'food',
        'NAME' => 'Корма',
        'ACTIVE' => 'Y',
        'SORT' => 500,
        'VERSION' => 2,
        'RIGHTS_MODE' => 'S',
        'GROUP_ID' => [
            2 => 'R',
            6 => 'W',
            8 => '',
            5 => '',
            9 => 'W',
            10 => '',
            7 => '',
            1 => 'X',
        ],
        'FIELDS' => [
            'IBLOCK_SECTION' => [
                'IS_REQUIRED' => 'N',
                'DEFAULT_VALUE' => [
                    'KEEP_IBLOCK_SECTION_ID' => 'N',
                ],
            ],
            'ACTIVE' => [
                'IS_REQUIRED' => 'Y',
                'DEFAULT_VALUE' => 'Y',
            ],
            'SORT' => [
                'IS_REQUIRED' => 'Y',
            ],
            'PREVIEW_TEXT' => [
                'IS_REQUIRED' => 'Y',
            ],
            'DETAIL_TEXT_TYPE_ALLOW_CHANGE' => [
                'DEFAULT_VALUE' => 'Y',
            ],
            'DETAIL_PICTURE' => [
                'IS_REQUIRED' => 'Y',
            ],
            'DETAIL_TEXT' => [
                'IS_REQUIRED' => 'Y',
            ],
        ],
    ];

    protected array $iBlockPropertyInfo = [
        [
            'NAME' => 'Состав',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'composition',
            'ROW_COUNT' => 10,
        ],
        [
            'NAME' => 'Рекомендации по кормлению',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'feeding_recommendations',
        ],
        [
            'NAME' => 'Лакомство',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'is_treat',
            'LIST_TYPE' => 'C',
            'SMART_FILTER' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Да',
                    'DEF' => 'N',
                    'SORT' => 500,
                    'XML_ID' => 'yes',
                ],
            ],
        ],
        [
            'NAME' => 'Видео',
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'video',
            'CODE' => 'video',
        ],
        [
            'NAME' => 'Вид животного',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'pet_type',
            'MULTIPLE' => 'Y',
            'LIST_TYPE' => 'C',
            'SMART_FILTER' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Собака',
                    'XML_ID' => 'DOG',
                ],
                [
                    'VALUE' => 'Кошка',
                    'XML_ID' => 'CAT',
                ],
            ],
        ],
        [
            'NAME' => 'Комплектность',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'completeness',
        ],
        [
            'NAME' => 'Материал',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'material',
        ],
        [
            'NAME' => 'Предназначение',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'purpose',
        ],
        [
            'NAME' => 'Возраст',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'age',
            'MULTIPLE' => 'Y',
            'LIST_TYPE' => 'C',
            'SMART_FILTER' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Для взрослых',
                    'XML_ID' => 'ADULT',
                ],
                [
                    'VALUE' => 'Для молодых',
                    'XML_ID' => 'ADULT',
                ],
                [
                    'VALUE' => 'Для всех возрастов',
                    'XML_ID' => 'ALL',
                ],
            ],
        ],
        [
            'NAME' => 'Порода',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'breed',
            'MULTIPLE' => 'Y',
            'LIST_TYPE' => 'C',
            'SMART_FILTER' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Для мелких пород',
                    'XML_ID' => 'SMALL',
                ],
                [
                    'VALUE' => 'Для средних пород',
                    'XML_ID' => 'MEDIUM',
                ],
                [
                    'VALUE' => 'Для больших пород',
                    'XML_ID' => 'BIG',
                ],
                [
                    'VALUE' => 'Для всех пород',
                    'XML_ID' => 'ALL',
                ],
            ],
        ],
        [
            'NAME' => 'Назначение',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'appointment',
        ],
        [
            'NAME' => 'Линейка',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'line',
            'SMART_FILTER' => 'Y',
            'LIST_TYPE' => 'L',
        ],
    ];


    protected function afterUp(): void
    {
        $this->includeCatalogModule();

        $catalog = new CCatalog();
        if (!$catalog->Add(['IBLOCK_ID' => $this->iBlockId])) {
            throw new \RuntimeException('Ошибка при создании каталога');
        }

        $properties = CIBlockProperty::GetList([], ['IBLOCK_ID' => $this->iBlockId]);
        while ($property = $properties->Fetch()) {
            CIBlockSectionPropertyLink::Add(0, $property['ID'], [
                'IBLOCK_ID' => $this->iBlockId,
                'SMART_FILTER' => 'Y',
            ]);
        }
    }

    private function includeCatalogModule(): void
    {
        if (!CModule::IncludeModule('catalog')) {
            throw new \RuntimeException('Не удалось подключить модуль catalog');
        }
    }
}
