<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Sale;
use Bitrix\Currency\CurrencyManager;
use Bitrix\Main\Localization\Loc;

Loader::includeModule('sale');

class UpdateBasket extends \CBitrixComponent implements Controllerable
{
    private $basket;
    private $currency;
    private $requestParams;

    public function __construct($component)
    {
        parent::__construct($component);

        $this->basket = Sale\Basket::loadItemsForFUser(CSaleBasket::GetBasketUserID(), SITE_ID);
        $this->currency = CurrencyManager::getBaseCurrency();
    }

    public function configureActions()
    {
        return [];
    }

    public function onPrepareComponentParams($arParams)
    {
        $this->requestParams = [
            'quantity' => floatval($this->request->getPost("quantity") ?: $this->request->get("quantity")),
            'id' => intval($this->request->getPost("id") ?: $this->request->get("id")),
            'products' => $this->request->getPost('products') ?: $this->request->get('products'),
            'update_item_records' => $this->request->getPost('update_item_records') ?: $this->request->get('update_item_records'),
        ];
    }

    public function executeComponent()
    {
        if ($this->requestParams['update_basket'] == 'Y') {
            if ($this->requestParams['quantity'] > 0) {
                $this->updateBasket($this->requestParams['id'], $this->requestParams['quantity']);
            } else {
                $this->deleteBasketItem($this->requestParams['id']);
            }
        } elseif ($this->requestParams['update_item_records'] == 'Y') {
            $this->updateItemRecords($this->requestParams['id'], $this->requestParams['properties']);
        } elseif ($this->requestParams['small_update_basket'] == 'Y') {
            $this->smallUpdateBasket($this->requestParams['id'], $this->requestParams['quantity']);
        } elseif ($this->requestParams['add_wishlist_basket'] == 'Y' && !empty($this->requestParams['wishlist_id'])) {
            $this->addWishlistBasket($this->requestParams['wishlist_id']);
        }

        $this->getResult();

        return json_encode($this->arResult);
    }

    private function deleteBasketItem($productId)
    {
        if ($basketItem = $this->getExistBasketItem($productId)) {
            $deleteResult = $basketItem->delete();
            if (!$deleteResult->isSuccess()) {
                // TODO log error

            } else {
                $result = $this->basket->save();
                if (!$result->isSuccess()) {
                    // TODO log error
                }
            }
        } else {
            // TODO log error
        }
    }

    private function smallUpdateBasket($id, $quantity)
    {
        $skuData = $this->getSkuData($id);

        if (
            $id > 0
            && $basketItem = $this->basket->getItemById($id)
        ) { // && !$this->isAlc($id)
            if ($basketItem->getQuantity() != $quantity) {
                $basketItem->setField('QUANTITY', $quantity);
            }
        }

        $this->basket->save();
    }

    private function getSkuData($skuId): array
    {
        if (empty($skuId) || $skuId <= 0) {
            return [];
        }

        $result = CIBlockElement::GetList(
            false,
            [
                'IBLOCK_ID' => IBLOCK_CATALOG_SKU_IM,
                '=ID' => $skuId,
            ],
            false,
            false,
            [
                'ID',
                'NAME',
                'PROPERTY_MARKET',
                'PROPERTY_CML2_LINK.PROPERTY_' . BasketItemHelper::ALCO_ITEM_PROPERTY_CODE,
            ]
        )->Fetch();

        return $result ?: [];

    }

    private function updateBasket($id, $quantity, $addOnly = false)
    {
        $skuData = $this->getSkuData($id);

        if ($id <= 0) {
            // TODO log error

            return;
        }

        if ($basketItem = $this->getExistBasketItem($id)) {
            $props = $basketItem->getPropertyCollection()->getPropertyValues();
            if (isset($props[Qsoft\Classes\BasketAvailableQuantity::AVAILABLE_QUANTITY_PROP])) {
                $availableQuantityValue = $props[Qsoft\Classes\BasketAvailableQuantity::AVAILABLE_QUANTITY_PROP]['VALUE'];
                ProductProvider::setParams([
                    'CHECK_QUANTITY' => 'N',
                ]);
                if ($quantity > $availableQuantityValue) {
                    $quantity = $availableQuantityValue;
                }
            }
            if (!$addOnly) {
                $resultAdd = $basketItem->setField('QUANTITY', $quantity);
                if (!$resultAdd->isSuccess()) {
                    // TODO log error
                }
            }
        } else {
            $basketItem = $this->basket->createItem('catalog', $id);
            $xml_id = ProductHelper::getProductPropsByOfferID($id, ['XML_ID'])['XML_ID'];

            $resultCreate = $basketItem->setFields([
                'QUANTITY' => $quantity,
                'CURRENCY' => $this->currency,
                'LID' => $this->getSiteId(),
                'PRODUCT_PROVIDER_CLASS' => 'Qsoft\Catalog\Provider\ProductProvider',
                'PRODUCT_XML_ID' => $xml_id
            ]);

            if (!$resultCreate->isSuccess()) {
                // TODO log error
            }
        }

        $result = $this->basket->save();
        if (!$result->isSuccess()) {
            // TODO log error
        }

        ProductProvider::clearParams();
    }

    private function updateItemRecords($id, $properties)
    {
        foreach ($this->basket->getBasketItems() as $item) {
            if ($item->getProductId() == $id) {
                $basketPropertyCollection = $item->getPropertyCollection();

                $arrProperties = $this->prepareRecordsProps($basketPropertyCollection, $properties);
                $recordsToAdd = $this->getRecordsToAdd($arrProperties);

                $basketPropertyCollection->setProperty($recordsToAdd);

                $basketPropertyCollection->save();
            }
        }
    }

    private function prepareRecordsProps($basketPropertyCollection, $properties)
    {
        $arrProperties = json_decode($properties);
        $arrProperties = array_map(function ($record) {
            return htmlspecialcharsEx($record);
        }, $arrProperties);

        $propertiesCount = count($arrProperties);
        foreach ($basketPropertyCollection as $property) {
            if (explode('_', $property->getField('CODE')[1]) >= $propertiesCount || empty($properties)) {
                $property->delete();
            }
        }

        return $arrProperties;
    }

    private function getRecordsToAdd($arrProperties)
    {
        $recordsToAdd = [];

        foreach ($arrProperties as $propId => $property) {
            $newProperty = [
                'NAME' => Loc::getMessage("CAKE_RECORD"),
                'CODE' => 'RECORD_' . $propId,
                'VALUE' => $property,
                'SORT' => 100
            ];
            $recordsToAdd[] = $newProperty;
        }

        return $recordsToAdd;
    }

    public function getResult()
    {
        $this->arResult = [];

        foreach ($this->basket as $basketItem) {
            array_set($this->arResult, $basketItem->getField('ID'), [
                'BASKET_ID' => $basketItem->getField('ID'),
                'PRODUCT_ID' => $basketItem->getField('PRODUCT_ID'),
                'NAME' => $basketItem->getField('NAME'),
                'QUANTITY' => $basketItem->getField('QUANTITY'),
            ]);
        }
    }

    private function getExistBasketItem($productId)
    {
        foreach ($this->basket as $itemObj) {
            if ($itemObj->getField('PRODUCT_ID') === (string)$productId) {
                return $itemObj;
            }
        }
        return null;
    }
}
