<?php

namespace QSoft\Service;

use Bitrix\Catalog\Model\Price;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Loader;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
use QSoft\Helper\ConsultantLoyaltyProgramHelper;
use QSoft\Helper\UserGroupHelper;
use RuntimeException;

/**
 * Класс для работы с торговыми предложениями
 * @package QSoft\Service
 */
class OffersService
{
    /**
     * @var int ID ИБ Торговых предложений
     */
    private int $offersIbId;

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function __construct() {

        if (! Loader::includeModule('iblock')) {
            throw new RuntimeException('Не найден модуль "iblock"');
        }
        
        $this->offersIbId = (int) \CIBlock::GetList([], ['CODE' => 'product_offer'])->Fetch()['ID'];

        if (! Loader::includeModule('sale')) {
            throw new RuntimeException('Не найден модуль "sale"');
        }
        if (! $this->offersIbId) {
            throw new RuntimeException('Не найден инфоблок "product_offer"');
        }
    }

    /**
     * Пересчитывает количество бонусных баллов для торгового предложения
     * для всех уровней программы лояльности и записывает их в соответствующие свойства
     * @param int $offerId ID товара (или торгового предложения)
     * @param float $priceValue Базовая цена
     */
    public function setOfferBonuses(int $offerId, float $priceValue): void
    {
        $consultantLoyalty = new ConsultantLoyaltyProgramHelper();
        $loyaltyLevels = $consultantLoyalty->getLoyaltyLevels();

        $levelsCodes = array_keys($loyaltyLevels);

        // Получим ID группы Консультантов
        $groups = UserGroupHelper::getAllUserGroups();

        // Получим цену с учетом скидок
        $prices = \CCatalogProduct::GetOptimalPrice(
            $offerId,
            1,
            [$groups['consultant']],
            'N',
            [],
            's1'
        );

        if ($prices) {
            if (isset($prices['DISCOUNT_PRICE']) && $priceValue > (float) $prices['DISCOUNT_PRICE']) {
                $priceValue = $prices['DISCOUNT_PRICE'];
            }

            // Вычисляем количество бонусов
            $propsToSet = [];
            foreach ($levelsCodes as $code) {
                $params = $loyaltyLevels[$code]['benefits']['personal_bonuses_for_stock'];
                $bonuses = (float) intdiv($priceValue, $params['step']) * $params['size'];

                $propsToSet['BONUSES_' . $code] = $bonuses;
            }

            // Записываем свойства
            \CIBlockElement::SetPropertyValuesEx($offerId, $this->offersIbId, $propsToSet);
        }
    }

    /**
     * Пересчитывает цены торговых предложений с учетом персональных скидок по программе лояльности
     * для Консультантов и Конечных покупателей и записывает в соответствующие свойства
     * @param int $offerId ID товара (или торгового предложения)
     * @param float $priceValue Базовая цена
     */
    public function setOfferDiscountPrices(int $offerId, float $priceValue) {

        // Получаем коды свойств с ценами по уровням программы лояльности
        $levels = [];
        $propsToSet = [];
        $consultantLoyalty = new ConsultantLoyaltyProgramHelper();
        $buyerLoyalty = new BuyerLoyaltyProgramHelper();
        $levels = array_merge($levels, $consultantLoyalty->getLoyaltyLevels(), $buyerLoyalty->getLoyaltyLevels());

        foreach (array_keys($levels) as $levelCode) {
            // Вычисляем акционную цену
            $discountPercent = (int) $levels[$levelCode]['benefits']['personal_discount'];
            $discountPrice = ceil($priceValue * (100 - $discountPercent)) / 100;

            $propsToSet['DISCOUNT_PRICE_' . $levelCode] = $discountPrice;
        }

        // Проверяем существование ТП
        $offer = \CIBlockElement::GetList(
            ['ID' => 'DESC'],
            ['IBLOCK_ID' => $this->offersIbId, 'ID' => $offerId],
            false,
            false,
            ['ID']
        )->Fetch();
        
        if ($offer) {
            // Записываем свойства
            \CIBlockElement::SetPropertyValuesEx($offerId, $this->offersIbId, $propsToSet);
        }
    }

    /**
     * Пересчитывает бонусные баллы для всех ТП
     */
    public function updateAllOffersBonuses() {

        $limit = 100;
        $offset = 0;
        $isAllProcessed = false;

        $consultantLoyalty = new ConsultantLoyaltyProgramHelper();
        $loyaltyLevels = $consultantLoyalty->getLoyaltyLevels();

        $levelsCodes = array_keys($loyaltyLevels);

        // Получим ID группы Консультантов
        $groups = UserGroupHelper::getAllUserGroups();

        $count = 0;

        while (! $isAllProcessed) {

            // Получаем торговые предложения
            $offers = \Bitrix\Iblock\ElementTable::getList([
                'select' => ['ID'],
                'filter' => ['=IBLOCK_ID' => $this->offersIbId],
                'cache' => ['ttl' => 86400],
                'limit' => $limit,
                'offset' => $offset,
            ])->fetchAll();

            if (empty($offers)) {
                $isAllProcessed = true;
            } else {

                $offset += $limit;

                foreach ($offers as $offer) {

                    $count += 1;

                    // Получим цену с учетом скидок
                    $prices = \CCatalogProduct::GetOptimalPrice(
                        $offer['ID'],
                        1,
                        [$groups['consultant']],
                        'N',
                        [],
                        's1'
                    );

                    if ($prices) {

                        // Вычисляем количество бонусов
                        $propsToSet = [];
                        foreach ($levelsCodes as $code) {
                            $params = $loyaltyLevels[$code]['benefits']['personal_bonuses_for_stock'];
                            $bonuses = (float) intdiv($prices['DISCOUNT_PRICE'], $params['step']) * $params['size'];

                            $propsToSet['BONUSES_' . $code] = $bonuses;
                        }

                        // Записываем свойства
                        \CIBlockElement::SetPropertyValuesEx($offer['ID'], $this->offersIbId, $propsToSet);

                    }
                }
            }
        }

        //dump('Обработано ' . $count . ' ТП');
    }

    /**
     * Пересчитывает бонусные баллы для всех ТП
     */
    public function updateAllOffersDiscountPrices() {

        $limit = 100;
        $offset = 0;
        $isAllProcessed = false;

        // Получаем коды свойств с ценами по уровням программы лояльности
        $levels = [];
        $consultantLoyalty = new ConsultantLoyaltyProgramHelper();
        $buyerLoyalty = new BuyerLoyaltyProgramHelper();
        $levels = array_merge($levels, $consultantLoyalty->getLoyaltyLevels(), $buyerLoyalty->getLoyaltyLevels());
        $levelsCodes = array_keys($levels);

        $basePrice = \CCatalogGroup::GetList([], ['=NAME' => 'BASE'], false, false, ['ID'])->Fetch();

        $count = 0;

        while (! $isAllProcessed) {

            // Получаем торговые предложения
            $offers = \Bitrix\Iblock\ElementTable::getList([
                'select' => ['ID'],
                'filter' => ['=IBLOCK_ID' => $this->offersIbId],
                'cache' => ['ttl' => 86400],
                'limit' => $limit,
                'offset' => $offset,
            ])->fetchAll();

            if (empty($offers)) {
                $isAllProcessed = true;
            } else {

                $offset += $limit;

                foreach ($offers as $offer) {

                    $count += 1;

                    // Получим цену
                    $price = Price::getList([
                        'filter' => [
                            '=PRODUCT_ID' => $offer['ID'],
                            'CATALOG_GROUP_ID' => $basePrice['ID'],
                        ]
                    ])->fetch();

                    if ($price) {

                        $propsToSet = [];
                        foreach ($levelsCodes as $levelCode) {
                            // Вычисляем акционную цену
                            $discountPercent = (int) $levels[$levelCode]['benefits']['personal_discount'];
                            $discountPrice = ceil($price['PRICE'] * (100 - $discountPercent)) / 100;

                            $propsToSet['DISCOUNT_PRICE_' . $levelCode] = $discountPrice;
                        }

                        // Записываем свойства
                        \CIBlockElement::SetPropertyValuesEx($offer['ID'], $this->offersIbId, $propsToSet);

                    }
                }
            }
        }

        //dump('Обработано ' . $count . ' ТП');
    }
}