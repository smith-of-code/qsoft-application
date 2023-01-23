<?php

namespace QSoft\Service;

use Bitrix\Catalog\Model\Price;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\PropertyIndex\Manager;
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
     * @var array ID групп пользователей (STRING_ID => ID)
     */
    private array $groups;

    /**
     * @var array|array[] Уровни ПЛ Консультантов
     */
    private array $consultantLoyaltyLevels;

    /**
     * @var array|array[] Уровни ПЛ Конечных покупателей
     */
    private array $buyerLoyaltyLevels;

    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function __construct() {

        if (! Loader::includeModule('iblock')) {
            throw new RuntimeException('Не найден модуль "iblock"');
        }
        if (! Loader::includeModule('sale')) {
            throw new RuntimeException('Не найден модуль "sale"');
        }


        $this->offersIbId = (int) \CIBlock::GetList([], ['CODE' => 'product_offer'])->Fetch()['ID'];

        if (! $this->offersIbId) {
            throw new RuntimeException('Не найден инфоблок "product_offer"');
        }

        $this->groups = UserGroupHelper::getAllUserGroups();

        $consultantLoyalty = new ConsultantLoyaltyProgramHelper();
        $buyerLoyalty = new BuyerLoyaltyProgramHelper();
        $this->consultantLoyaltyLevels = $consultantLoyalty->getLoyaltyLevels();
        $this->buyerLoyaltyLevels = $buyerLoyalty->getLoyaltyLevels();
    }

    /**
     * Пересчитывает количество бонусных баллов для торгового предложения
     * для всех уровней программы лояльности и записывает их в соответствующие свойства
     * @param int $offerId ID товара (или торгового предложения)
     * @param float $priceValue Базовая цена
     */
    public function setOfferBonuses(int $offerId, float $priceValue): void
    {
        // Получим цены с учетом скидок
        $prices = $this->getOptimalPricesToCalculations($offerId, 'consultant');

        if ($prices) {
            // Вычисляем количество бонусов
            $propsToSet = [];
            foreach (array_keys($this->consultantLoyaltyLevels) as $code) {
                $params = $this->consultantLoyaltyLevels[$code]['benefits']['personal_bonuses_for_cost'];
                $bonuses = (float) intdiv($prices[$code], $params['step']) * $params['size'];

                $propsToSet['BONUSES_' . $code] = $bonuses;
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
                Manager::updateElementIndex($this->offersIbId, $offerId);
            }
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
        $propsToSet = [];

        // Получим цены с учетом скидок
        $consultantPrices = $this->getOptimalPricesToCalculations($offerId, 'consultant');
        $buyerPrices = $this->getOptimalPricesToCalculations($offerId, 'buyer');

        if (! empty($consultantPrices) && ! empty($buyerPrices)) {
            // Проставляем цены для Консультантов
            foreach (array_keys($this->consultantLoyaltyLevels) as $levelCode) {
                $propsToSet['DISCOUNT_PRICE_' . $levelCode] = $consultantPrices[$levelCode];
            }
            // Проставляем цены для Конечных покупателей
            foreach (array_keys($this->buyerLoyaltyLevels) as $levelCode) {
                $propsToSet['DISCOUNT_PRICE_' . $levelCode] = $buyerPrices[$levelCode];
            }
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
            Manager::updateElementIndex($this->offersIbId, $offerId);
        }
    }

    /**
     * Пересчитывает бонусные баллы для всех ТП
     */
    public function updateAllOffersBonuses() {

        $limit = 100;
        $offset = 0;
        $isAllProcessed = false;

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

                    // Получим цены с учетом скидок
                    $prices = $this->getOptimalPricesToCalculations($offer['ID'], 'consultant');

                    if (! empty($prices)) {

                        // Вычисляем количество бонусов
                        $propsToSet = [];
                        foreach (array_keys($this->consultantLoyaltyLevels) as $code) {

                            $params = $this->consultantLoyaltyLevels[$code]['benefits']['personal_bonuses_for_cost'];
                            $bonuses = (float) intdiv($prices[$code], $params['step']) * $params['size'];

                            $propsToSet['BONUSES_' . $code] = $bonuses;
                        }

                        // Записываем свойства
                        \CIBlockElement::SetPropertyValuesEx($offer['ID'], $this->offersIbId, $propsToSet);
                        Manager::updateElementIndex($this->offersIbId, $offer['ID']);

                    }
                }
            }
        }

        dump('Бонусы обновлены. Обработано ' . $count . ' ТП');
    }

    /**
     * Пересчитывает акционные цены для всех ТП
     */
    public function updateAllOffersDiscountPrices() {

        $limit = 100;
        $offset = 0;
        $isAllProcessed = false;

        $levels = array_merge($this->consultantLoyaltyLevels, $this->buyerLoyaltyLevels);

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

                    // Получим цены с учетом скидок
                    $prices = array_merge(
                        $this->getOptimalPricesToCalculations($offer['ID'], 'consultant'),
                        $this->getOptimalPricesToCalculations($offer['ID'], 'buyer')
                    );

                    if (! empty($prices)) {

                        $propsToSet = [];
                        foreach (array_keys($levels) as $levelCode) {
                            $propsToSet['DISCOUNT_PRICE_' . $levelCode] = $prices[$levelCode];
                        }

                        // Записываем свойства
                        \CIBlockElement::SetPropertyValuesEx($offer['ID'], $this->offersIbId, $propsToSet);
                        Manager::updateElementIndex($this->offersIbId, $offer['ID']);

                    }
                }
            }
        }

        dump('Акционные цены обновлены. Обработано ' . $count . ' ТП');
    }

    /**
     * Возвращает цены в соответствии с уровнями программы лояльности
     * (с учетом персональных скидок и акционных скидок - персональные акции не учитываются)
     * @param int $offerId ID торгового предложения
     * @param string $groupCode STRING_ID группы пользователей
     * @return array массив вида (LEVEL_CODE => PRICE_VALUE)
     */
    public function getOptimalPricesToCalculations(int $offerId, string $groupCode): array
    {
        $prices = [];

        if ($offerId <= 0) {
            return $prices;
        }

        if (! isset($this->groups[$groupCode])) {
            return $prices;
        }

        // Получим цену с учетом скидок
        // (здесь не учитываются скидки по программе лояльности и персональные акции - только глобальная скидка на товар)
        $optimalPrices = \CCatalogProduct::GetOptimalPrice(
            $offerId,
            1,
            [$this->groups[$groupCode]],
            'N',
            [],
            's1'
        );

        if ($optimalPrices) {

            $basePrice = $optimalPrices['RESULT_PRICE']['BASE_PRICE'];
            $discountPrice = $optimalPrices['RESULT_PRICE']['DISCOUNT_PRICE'];

            // Используем соответствующие уровни ПЛ
            $levels = [];
            if ($groupCode == 'consultant') {
                $levels = $this->consultantLoyaltyLevels;
            } elseif ($groupCode == 'buyer') {
                $levels = $this->buyerLoyaltyLevels;
            }

            foreach (array_keys($levels) as $code) {
                // Если есть акционная скидка - она перекрывает персональную скидку, используем эту цену
                if ($basePrice > $discountPrice) {
                    $resultPrice = $discountPrice;
                } else { // Иначе цена пришла базовая - самостоятельно рассчитываем с учетом персональной скидки
                    $discountPercent = (int) $levels[$code]['benefits']['personal_discount'];
                    $resultPrice = ceil($basePrice * (100 - $discountPercent)) / 100;
                }

                $prices[$code] = $resultPrice;
            }
        }

        return $prices;
    }
}