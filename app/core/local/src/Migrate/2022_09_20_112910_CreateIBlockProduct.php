<?php

use Bitrix\Iblock\PropertyIndex\Manager;
use QSoft\Migrate\BaseCreateIBlockMigration;

final class CreateIBlockProduct extends BaseCreateIBlockMigration
{
    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => 'catalog',
        'CODE' => 'product',
        'XML_ID' => 'product',
        'NAME' => 'Товары',
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
            'CODE' => 'COMPOSITION',
            'SMART_FILTER' => 'N',
            'ROW_COUNT' => 10,
        ],
        [
            'NAME' => 'Рекомендации по кормлению',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'FEEDING_RECOMMENDATIONS',
            'SMART_FILTER' => 'N',
        ],
        [
            'NAME' => 'Лакомство',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'TREAT',
            'LIST_TYPE' => 'C',
            'SMART_FILTER' => 'N',
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
            'CODE' => 'VIDEO',
            'SMART_FILTER' => 'N',
        ],
        [
            'NAME' => 'Вид животного',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'PET_TYPE',
            'LIST_TYPE' => 'L',
            'SMART_FILTER' => 'N',
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
            'CODE' => 'COMPLETENESS',
            'SMART_FILTER' => 'N',
        ],
        [
            'NAME' => 'Материал',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'MATERIAL',
            'SMART_FILTER' => 'N',
        ],
        [
            'NAME' => 'Возраст',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'AGE',
            'LIST_TYPE' => 'L',
            'SMART_FILTER' => 'Y',
            'DISPLAY_TYPE' => 'F',
            'DISPLAY_EXPANDED' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Для взрослых',
                    'XML_ID' => 'ADULT',
                    'SORT' => 100,
                ],
                [
                    'VALUE' => 'Для молодых',
                    'XML_ID' => 'SMALL',
                    'SORT' => 200,
                ],
                [
                    'VALUE' => 'Для всех возрастов',
                    'XML_ID' => 'ALL',
                    'SORT' => 300,
                ],
            ],
        ],
        [
            'NAME' => 'Порода',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'BREED',
            'LIST_TYPE' => 'L',
            'SMART_FILTER' => 'Y',
            'DISPLAY_TYPE' => 'F',
            'DISPLAY_EXPANDED' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Для мелких пород',
                    'XML_ID' => 'SMALL',
                    'SORT' => 100,
                ],
                [
                    'VALUE' => 'Для средних пород',
                    'XML_ID' => 'MEDIUM',
                    'SORT' => 200,
                ],
                [
                    'VALUE' => 'Для больших пород',
                    'XML_ID' => 'BIG',
                    'SORT' => 300,
                ],
                [
                    'VALUE' => 'Для всех пород',
                    'XML_ID' => 'ALL',
                    'SORT' => 400,
                ],
            ],
        ],
        [
            'NAME' => 'Назначение',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'APPOINTMENT',
            'SMART_FILTER' => 'Y',
            'DISPLAY_TYPE' => 'F',
        ],
        [
            'NAME' => 'Линейка',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'LINE',
            'SMART_FILTER' => 'Y',
            'DISPLAY_TYPE' => 'F',
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

        $index = Manager::createIndexer($this->iBlockId);
        $index->startIndex();
        $index->continueIndex();
        $index->endIndex();
    }

    private function includeCatalogModule(): void
    {
        if (!CModule::IncludeModule('catalog')) {
            throw new \RuntimeException('Не удалось подключить модуль catalog');
        }
    }
}
