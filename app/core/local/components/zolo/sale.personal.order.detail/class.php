<?php

use	Bitrix\Main\Loader;
use	Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Order;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketBase;
use Bitrix\Main\UserTable;

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('iblock')) {
    ShowError(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
    return;
}

class CatalogElementComponent extends CBitrixComponent
{
    const STATUSES = [
        'OD' => [
            'NAME' => 'Доставлен',
            'COLOR' => '#2D8859',
        ],
        'OP' => [
            'NAME' => 'Размещен',
            'COLOR' => '#3887B5',
        ],
        'OC' => [
            'NAME' => 'Отменен',
            'COLOR' => '#D82F49',
        ],
    ];

    private bool $isError = false;
    /**
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams): array
    {
        $arParams = parent::onPrepareComponentParams($arParams);

        if (!isset($arParams['ORDER_ID']) || !trim((string) $arParams['ORDER_ID'])) {
            $this->isError = true;
            ShowError(Loc::getMessage('PARAMETER_ORDER_ID_IS_EMPTY'));
        }

        return $arParams;
    }

    public function executeComponent()
    {
        try {
            if ($this->isError) {
                return;
            }

            if ($this->startResultCache()) {
                $order = Order::load($this->arParams['ORDER_ID']);
                if (!$order) {
                    throw new RuntimeException(Loc::getMessage('ORDER_NOT_FOUND'));
                }

                $user = UserTable::getById($order->getUserId())->fetch();

                $basketItems = Basket::loadItemsForOrder($order);

                $offerInfos = $this->getProductOfferInfos($basketItems);

                $this->arResult = $this->transformData($order, $basketItems, $user, $offerInfos);

                $this->setResultCacheKeys([]);
                $this->includeComponentTemplate();
            }
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }

    private function getProductOfferInfos(BasketBase $basketItems): array
    {
        $productIds = [];
        foreach ($basketItems as $basketItem) {
            $productIds[] = $basketItem->getProductID();
        }

        $properties = [];
        CIBlockElement::GetPropertyValuesArray($properties, IBLOCK_PRODUCT_OFFER, ['ID' => current($productIds)]);
        $select = array_merge($this->getPropertyKeys($properties), [
            'ID',
            'NAME',
            'CODE',
            'DETAIL_PAGE_URL',
            'PREVIEW_PICTURE',
            'DETAIL_PICTURE',
            'DETAIL_TEXT',
            'DETAIL_TEXT_TYPE',
            'PREVIEW_TEXT',
            'PREVIEW_TEXT_TYPE',
        ]);

        $offerIterator = CIBlockElement::GetList([], [
            'ID' => $productIds,
        ], false, false, $select);
        $offers = [];
        $fileIds = [];
        while($offer = $offerIterator->Fetch()) {
            $offers[] = $offer;
            if ($offer['PREVIEW_PICTURE']) {
                $fileIds[] = $offer['PREVIEW_PICTURE'];
            }
        }
        unset($offer);

        $files = [];
        if (!empty($fileIds)) {
            $fileIterator = CFile::GetList([], [
                'ID' => $fileIds,
            ]);
            while ($file = $fileIterator->Fetch()) {
                $file['SRC'] = CFile::GetFileSRC($file);
                $files[$file['ID']] = $file;
            }
        }

        return [
            'FILES' => $files,
            'OFFERS' => $offers,
        ];
    }

    private function getPropertyKeys(array $properties): array
    {
        return array_map(static function ($item) {
            return "PROPERTY_{$item}";
        }, array_keys(current($properties)));
    }

    private function transformData(Order $order, BasketBase $basket, array $user, array $offerInfos): array
    {
        // TODO: баллы
        $result = [
            'ID' => $order->getId(),
            'CREATED_AT' => $order->getDateInsert()->format('d.m.Y'),
            'CREATED_BY' => $this->formUserName($user),
            'STATUS_NAME' => self::STATUSES[$order->getField('STATUS_ID')]['NAME'] ?? 'Ошибка со стороны сайта',
            'STATUS_COLOR' => self::STATUSES[$order->getField('STATUS_ID')]['COLOR'] ?? self::STATUSES['OC']['COLOR'],
            'IS_PAID' => $order->isPaid(),
            'TOTAL_PRICE' => $order->getPrice(),
            'VOUCHER_USED' => (bool) $order->getField(['PAY_VOUCHER_NUM']),
            'ITEMS' => [],
        ];

        // TODO: Баллы
        foreach ($basket->getBasketItems() as $basketItem) {
            $currentOffer = current(array_filter(
                $offerInfos['OFFERS'],
                static function (array $item) use ($basketItem) {
                    return (int) $item['ID'] === $basketItem->getProductID();
                })
            );

            $result['ITEMS'][] = [
                'QUANTITY' => $basketItem->getQuantity(),
                'PRICE' => $basketItem->getPrice(),
                'NAME' => $basketItem->getField('NAME'),
                'PICTURE' => $offerInfos['FILES'][$currentOffer['PREVIEW_PICTURE']] ?? null,
                'ARTICLE' => $currentOffer['PROPERTY_ARTICLE_VALUE'] ?? null,
            ];
        }

        return $result;
    }

    private function formUserName(array $user): string
    {
        $userName = '';
        if (isset($user['LAST_NAME']) && $user['LAST_NAME']) {
            $userName .= $user['LAST_NAME'];

            if (isset($user['NAME']) && $user['NAME']) {
                $userName .= ' ' . substr($user['NAME'], 0, 1) . '.';
            }

            if (isset($user['SECOND_NAME']) && $user['SECOND_NAME']) {
                $userName .= ' ' . substr($user['SECOND_NAME'], 0, 1) . '.';
            }
        } else {
            $userName = $user['EMAIL'] ?? $user['LOGIN'];
        }

        return $userName;
    }
}
