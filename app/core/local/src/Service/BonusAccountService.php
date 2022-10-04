<?php

namespace QSoft\Service;

use Bitrix\Main\Type\DateTime;
use QSoft\Entity\User;
use QSoft\ORM\TransactionTable;
use RuntimeException;

/**
 * Класс для работы с бонусным счетом пользователя
 * @package QSoft\Service
 */
class BonusAccountService
{
    /**
     * @var User Пользователь
     */
    public User $user;

    /**
     * BonusAccountService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Начисляет баллы Консультанту за приглашение пользователя в рамках реферальной системы
     * @throws RuntimeException
     * @return bool
     */
    public function addReferralBonuses(): bool
    {
        // Для отключенного аккаунта добавление баллов невозможно
        if (! $this->user->isActive()) {
            throw new RuntimeException('User not found');
        }

        // Начисление баллов доступно только для Консультанта
        if (! $this->user->isConsultant()) {
            throw new RuntimeException('User is not consultant');
        }

        // Получаем количество баллов для начисления
        $loyaltyParams = $this->user->loyaltyService->getLoyaltyLevelInfo();
        $amount = $loyaltyParams['referral_size'];

        TransactionTable::add([
            'UF_USER_ID' => $this->user->id,
            'UF_TYPE' => TransactionTable::TYPES['referral'],
            'UF_SOURCE' => TransactionTable::SOURCES['personal'],
            'UF_MEASURE' => TransactionTable::MEASURES['points'],
            'UF_AMOUNT' => $amount,
        ]);

        return $this->user->update([
            'UF_BONUS_POINTS' => $this->user->bonus_points + $amount,
            'UF_LOYALTY_CHECK_DATE' => new DateTime,
        ]);
    }

    /**
     * @throws LoaderException
     * @throws ArgumentException
     * @throws ObjectNotFoundException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    static public function setOfferBonusesPrices(int $offerId, float $priceValue): void
    {
        Loader::includeModule('sale');

        $prices = Price::getList([
            'filter' => [
                '=PRODUCT_ID' => $offerId,
            ],
            'limit' => LoyaltyService::getAmountOfLevels(),
        ]);

        $existingPrices = [];
        while ($price = $prices->fetch()) {
            $existingPrices[$price['CATALOG_GROUP_ID']] = $price;
        }

        $loyaltyLevels = LoyaltyService::getLoyaltyLevels();
        $priceTypes = CCatalogGroup::GetList([], ['=NAME' => array_keys($loyaltyLevels)]);
        while ($priceType = $priceTypes->Fetch()) {
            $params = $loyaltyLevels[$priceType['NAME']]['personal_bonuses_by_price'];
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