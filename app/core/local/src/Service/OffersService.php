<?php

namespace QSoft\Service;

use Bitrix\Catalog\Product\Price;
use Bitrix\Main\Loader;
use CCatalogGroup;
use QSoft\Helper\ConsultantLoyaltyProgramHelper;
use QSoft\Helper\LoyaltyProgramHelper;

/**
 * Класс для работы с торговыми предложениями
 * @package QSoft\Service
 */
class OffersService
{
    /**
     * Пересчитывает количество бонусных баллов для торгового предложения
     * для всех уровней программы лояльности и записывает их в соответствующие типы цен
     * @param int $offerId
     * @param float $priceValue
     * @throws \Bitrix\Main\LoaderException
     */
    static public function setOfferBonusesPrices(int $offerId, float $priceValue): void
    {
        Loader::includeModule('sale');

        $consultantLoyalty = new ConsultantLoyaltyProgramHelper();
        $loyaltyLevels = $consultantLoyalty->getLoyaltyLevels();

        $prices = Price::getList([
            'filter' => [
                '=PRODUCT_ID' => $offerId,
            ],
            'limit' => count($loyaltyLevels),
        ]);

        $existingPrices = [];
        while ($price = $prices->fetch()) {
            $existingPrices[$price['CATALOG_GROUP_ID']] = $price;
        }


        $priceTypes = CCatalogGroup::GetList([], ['=NAME' => array_keys($loyaltyLevels)]);
        while ($priceType = $priceTypes->Fetch()) {
            $params = $loyaltyLevels[$priceType['NAME']]['benefits']['personal_bonuses_for_stock'];
            $bonuses = (float) intdiv($priceValue, $params['step']) * $params['size'];

            if ($existingPrices[$priceType['ID']]) {
                Price::update($existingPrices[$priceType['ID']]['ID'], [
                    'PRICE' => $bonuses,
                    'PRICE_SCALE' => $bonuses,
                ]);
            } else {
                Price::add([
                    'PRODUCT_ID' => $offerId,
                    'CATALOG_GROUP_ID' => $priceType['ID'],
                    'PRICE' => $bonuses,
                    'PRICE_SCALE' => $bonuses,
                ]);
            }
        }
    }
}