<?php

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

/**
 * @var array $arResult
 * @var array $arParams
 * @var array $templateData
 */

$productIdsString = implode('|', array_column($arResult['OFFERS'], 'ID'));
$basketFilter = [
    'FUSER_ID' => CSaleBasket::GetBasketUserID(),
    'LID' => SITE_ID,
    'PRODUCT_ID' => $productIdsString,
];
$basketIterator = CSaleBasket::GetList([], $basketFilter, false, false, ['*']);

$basketInfo = [];
while($basket = $basketIterator->Fetch()) {
    $basketInfo[] = $basket;
}
$this->arResult['BASKET'] = $basketInfo;
