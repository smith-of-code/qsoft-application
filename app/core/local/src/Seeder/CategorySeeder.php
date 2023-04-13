<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use RuntimeException;

class CategorySeeder implements Seederable
{
    const CHILDREN_CATEGORIES = [
        [
            'CODE' => 'dry_food_for_',
            'NAME' => 'Сухие корма',
            'SORT' => '100',
        ],
        [
            'CODE' => 'wet_food_for_',
            'NAME' => 'Влажные корма',
            'SORT' => '200',
        ],
        [
            'CODE' => 'treats_for_',
            'NAME' => 'Лакомства',
            'SORT' => '300',
        ],
        [
            'CODE' => 'accessories_for_',
            'NAME' => 'Аксессуары',
            'SORT' => '400',
            'CHILDREN' => [
                [
                    'CODE' => 'toys_for_',
                    'NAME' => 'Игрушки',
                    'SORT' => '100',
                ],
                [
                    'CODE' => 'houses_and_beds_for_',
                    'NAME' => 'Домики и лежанки',
                    'SORT' => '200',
                ],
                [
                    'CODE' => 'walks_for_',
                    'NAME' => 'Для прогулок',
                    'SORT' => '300',
                ],
                [
                    'CODE' => 'feeding_for_',
                    'NAME' => 'Для кормления',
                    'SORT' => '400',
                ],
                [
                    'CODE' => 'smart_products_for_',
                    'NAME' => 'Умные товары',
                    'SORT' => '500',
                ],
            ],
        ],
        [
            // NOTE: Будет изменено кодом
            'CODE' => 'small_',
            'NAME' => 'Появился ',
            'SORT' => '500',
        ],
    ];

    const CATEGORIES = [
        [
            'CODE' => 'cats',
            'NAME' => 'Для кошек',
            'SORT' => '500',
        ],
        [
            'CODE' => 'dogs',
            'NAME' => 'Для собак',
            'SORT' => '400',
        ],
    ];

    public static function seed(?string $blockName = null): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось загрузить модуль iblock');
        }

        // FIXME: Переделать на рекурсию
        $startArray = self::CATEGORIES;
        $finalArray = [];
        array_walk($startArray, static function ($item) use (&$finalArray) {
            $children = array_map(static function ($child) use ($item) {
                $child = self::fixCategory($child, $item['CODE']);

                if (isset($child['CHILDREN'])) {
                    $child['CHILDREN'] = array_map(static function ($grandChild) use ($child, $item) {
                        return self::fixCategory($grandChild, $item['CODE']);
                    }, $child['CHILDREN']);
                }

                return $child;
            }, self::CHILDREN_CATEGORIES);

            $finalArray[] = array_merge($item, ['CHILDREN' => $children]);
        });

        dd($finalArray);

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $productIblockId = \CIBlock::GetList([], ['CODE' => 'product'])->Fetch()['ID'];

        if (!Loader::includeModule('fileman')) {
            throw new RuntimeException('Не удалось загрузить модуль fileman');
        }

        self::createCategory($productIblockId, $finalArray);

        $connection->commitTransaction();
    }

    private static function fixCategory(array $category, string $parentCategory): array
    {
        if ($parentCategory === 'cats') {
            if ($category['CODE'] === 'small_') {
                $category['CODE'] = 'small_cats';
                $category['NAME'] .= 'котенок';
            } else {
                $category['CODE'] .= 'cats';
            }
        } else if ($parentCategory === 'dogs') {
            if ($category['CODE'] === 'small_') {
                $category['CODE'] = 'small_dogs';
                $category['NAME'] .= 'щенок';
            } else {
                $category['CODE'] .= 'dogs';
            }
        }

        return $category;
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
