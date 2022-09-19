<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use RuntimeException;

class CategorySeeder implements Seederable
{
    const CHILDREN_CATEGORIES = [
        [
            'CODE' => 'dry_food',
            'NAME' => 'Сухие корма',
        ],
        [
            'CODE' => 'wet_food',
            'NAME' => 'Влажные корма',
        ],
        [
            'CODE' => 'treats',
            'NAME' => 'Лакомства',
        ],
        [
            'CODE' => 'accessories',
            'NAME' => 'Аксессуары',
            'CHILDREN' => [
                [
                    'CODE' => 'toys',
                    'NAME' => 'Игрушки',
                ],
                [
                    'CODE' => 'houses_and_beds',
                    'NAME' => 'Домики и лежанки',
                ],
                [
                    'CODE' => 'for_walks',
                    'NAME' => 'Для прогулок',
                ],
                [
                    'CODE' => 'for_feeding',
                    'NAME' => 'Для кормления',
                ],
                [
                    'CODE' => 'smart_products',
                    'NAME' => 'Умные товары',
                ],
            ],
        ],
        [
            // NOTE: Будет изменено кодом
            'CODE' => 'small_',
            'NAME' => 'Появились ',
        ],
    ];

    const CATEGORIES = [
        [
            'CODE' => 'for_cats',
            'NAME' => 'Для кошек',
        ],
        [
            'CODE' => 'for_dogs',
            'NAME' => 'Для собак',
        ],
    ];

    public static function seed(?string $blockName = null): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось загрузить модуль iblock');
        }

        $startArray = self::CATEGORIES;
        $finalArray = [];
        array_walk($startArray, static function ($item) use (&$finalArray) {
            $children = array_map(static function ($child) use ($item) {
                if ($item['CODE'] === 'for_cats' && $child['CODE'] === 'small_') {
                    $child['CODE'] = 'small_cats';
                    $child['NAME'] .= 'котята';
                } else if ($item['CODE'] === 'for_dogs' && $child['CODE'] === 'small_') {
                    $child['CODE'] = 'small_dogs';
                    $child['NAME'] .= 'щенки';
                }

                return $child;
            }, self::CHILDREN_CATEGORIES);

            $finalArray[] = array_merge($item, ['CHILDREN' => $children]);
        });

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $foodIblockId = \CIBlock::GetList([], ['CODE' => 'food'])->Fetch()['ID'];
        $accessoryIblockId = \CIBlock::GetList([], ['CODE' => 'accessory'])->Fetch()['ID'];

        if (!Loader::includeModule('fileman')) {
            throw new RuntimeException('Не удалось загрузить модуль fileman');
        }

        self::createCategory($foodIblockId, $finalArray);
        self::createCategory($accessoryIblockId, $finalArray);

        $connection->commitTransaction();
    }

    private static function createCategory(int $iblockId, array $categories, int $parentId = 0): void
    {
        if (!is_array_assoc($categories)) {
            foreach ($categories as $category) {
                self::createCategory($iblockId, $category, $parentId);
            }

            return;
        }

        $category = array_merge($categories, [
            'IBLOCK_ID' => $iblockId,
            'IBLOCK_SECTION_ID' => $parentId,
        ]);

        if (!$parentId) {
            unset($category['IBLOCK_SECTION_ID']);
        }

        $section = new \CIBlockSection();
        $sectionId = $section->Add($category);
        if (isset($categories['CHILDREN'])) {
            self::createCategory($iblockId, $categories['CHILDREN'], $sectionId);
        }
    }
}
