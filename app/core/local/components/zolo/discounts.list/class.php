<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use QSoft\Helper\DiscountsHelper;
use \Bitrix\Main\Engine\Contract\Controllerable;

class DiscountsComponent extends CBitrixComponent implements Controllerable
{
    private const DISCOUNTS_LIMIT = 6;

    public function configureActions()
    {
        return [
            'load' => [
                '-prefilters' => [
                    \Bitrix\Main\Engine\ActionFilter\Csrf::class,
                ],
            ]
        ];
    }
    
    public function loadDiscountsAction($offset = 0): array
    {
        $discounts = DiscountsHelper::getDiscounts($offset, self::DISCOUNTS_LIMIT + 1);
        $isLast = self::DISCOUNTS_LIMIT >= count($discounts);
        $discounts = $isLast ? $discounts : array_slice($discounts, 0, -1);
        return [
            'ITEMS' => $discounts,
            'OFFSET' => $offset + count($discounts),
            'LAST' => $isLast,
        ];
    }

    public function executeComponent()
    {
        $this->arResult = $this->loadDiscountsAction();
        $this::includeComponentTemplate();
    }
}
