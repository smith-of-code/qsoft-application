<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use QSoft\Helper\DiscountsHelper;
use \Bitrix\Main\Engine\Contract\Controllerable;

class DiscountsComponent extends CBitrixComponent implements Controllerable
{
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
        $discounts = DiscountsHelper::getDiscounts($offset);
        return [
            'ITEMS' => $discounts,
            'OFFSET' => $offset + count($discounts)
        ];
    }

    public function executeComponent()
    {
        $this->arResult = $this->loadDiscountsAction();
        $this::includeComponentTemplate();
    }
}
