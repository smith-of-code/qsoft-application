<?php

namespace QSoft\Service;

use Bitrix\Catalog\Product\Price;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Loader;
use CCatalogGroup;
use QSoft\Helper\ConsultantLoyaltyProgramHelper;
use QSoft\Helper\LoyaltyProgramHelper;
use RuntimeException;

/**
 * Класс для работы с торговыми предложениями
 * @package QSoft\Service
 */
class OffersService
{
    /**
     * Пересчитывает количество бонусных баллов для торгового предложения
     * для всех уровней программы лояльности и записывает их в соответствующие свойства
     * @param int $offerId
     * @param float $priceValue
     * @throws \Bitrix\Main\LoaderException
     */
    static public function setOfferBonusesPrices(int $offerId, float $priceValue): void
    {
        Loader::includeModule('sale');

        $consultantLoyalty = new ConsultantLoyaltyProgramHelper();
        $loyaltyLevels = $consultantLoyalty->getLoyaltyLevels();

        // Получим ID ИБ Торговых предложений
        $offersIbId = CIBlock::GetList([], ['CODE' => 'product_offer'])->Fetch()['ID'];

        if (! $offersIbId) {
            throw new RuntimeException('Не найден инфоблок "product_offer"');
        }

        $levelsCodes = array_keys($loyaltyLevels);
        $propsCodesLevels = [];
        $propsToSet = [];
        foreach ($levelsCodes as $code) {
            $propsCodesLevels['BONUSES_' . $code] = $code;
        }

        // Получаем свойства бонусов
        $propsDB = PropertyTable::getList([
            'order' => [],
            'select' => ['ID', 'CODE'],
            'filter' => [
                'IBLOCK_ID' => $offersIbId,
                '@CODE' => array_keys($propsCodesLevels),
            ],
        ]);

        while ($prop = $propsDB->fetch()) {
            // Вычисляем количество бонусов
            $params = $loyaltyLevels[$propsCodesLevels[$prop['CODE']]]['benefits']['personal_bonuses_for_stock'];
            $bonuses = (float) intdiv($priceValue, $params['step']) * $params['size'];

            $propsToSet[$prop['CODE']] = $bonuses;
        }
        // Записываем свойства
        CIBlockElement::SetPropertyValuesEx($offerId, $offersIbId, $propsToSet);
    }
}