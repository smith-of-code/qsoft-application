<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;

class BasketLineController extends Controller
{
    public function configureActions()
    {
        return [
            'getBasketTotals' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class
                ],
            ],
        ];
    }

    public function getBasketTotalsAction()
    {
        Loader::includeModule('sale');

        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);

        return [
            'itemsCount' => $basket->count(),
            'basketPrice' => $basket->getPrice()
        ];
    }
}