<?php

namespace QSoft\Service;

use Bitrix\Catalog\Model\Price;
use Bitrix\Main\Type\DateTime;
use CCatalogGroup;
use QSoft\ORM\TransactionTable;
use RuntimeException;

class LoyaltyService
{
    private UserService $userService;
    private UserGroupsService $userGroupsService;

    public const LOYALTY_LEVELS = [
        'K1' => [
            'referral_size' => 100,
            'general_discount' => 7, // %
            'bonuses_by_personal_discount' => 2,
            'personal_bonuses_by_price' => [
                'size' => 1,
                'step' => 100,
            ],
            'group_bonuses_by_price' => [
                'size' => 1,
                'step' => 100,
            ],
        ],
        'K2' => [
            'upgrade_size' => 100,
            'referral_size' => 150,
            'general_discount' => 10, // %
            'bonuses_by_personal_discount' => 2,
            'personal_bonuses_by_price' => [
                'size' => 2,
                'step' => 100,
            ],
            'group_bonuses_by_price' => [
                'size' => 2,
                'step' => 200,
            ],
        ],
        'K3' => [
            'upgrade_size' => 300,
            'referral_size' => 200,
            'general_discount' => 12, // %
            'bonuses_by_personal_discount' => 2,
            'personal_bonuses_by_price' => [
                'size' => 3,
                'step' => 100,
            ],
            'group_bonuses_by_price' => [
                'size' => 4,
                'step' => 200,
            ],
        ],
    ];

    public function __construct()
    {
        $this->userService = new UserService;
        $this->userGroupsService = new UserGroupsService;
    }

    public function addReferralBonuses(int $userId): bool
    {
        $user = $this->userService->getActive($userId);
        if (!$user) {
            throw new RuntimeException('User not found');
        }

        if (!$this->userGroupsService->isConsultant($user['ID'])) {
            throw new RuntimeException('User is not consultant');
        }
        $amount = self::LOYALTY_LEVELS[$user['UF_LOYALTY_LEVEL']]['referral_size'];

        TransactionTable::add([
            'UF_USER_ID' => $userId,
            'UF_TYPE' => TransactionTable::TYPES['referral'],
            'UF_SOURCE' => TransactionTable::SOURCES['personal'],
            'UF_MEASURE' => TransactionTable::MEASURES['points'],
            'UF_AMOUNT' => $amount,
        ]);

        return $this->userService->update($user['ID'], [
            'UF_BONUS_POINTS' => $user['UF_BONUS_POINTS'] + $amount,
            'UF_LOYALTY_CHECK_DATE' => new DateTime,
        ]);
    }

    public function setOfferBonusesPrices(int $offerId, array $priceFields): void
    {
        $prices = Price::getList([
            'filter' => [
                '=PRODUCT_ID' => $offerId,
            ],
            'limit' => count(self::LOYALTY_LEVELS),
        ]);

        $existingPrices = [];
        while ($price = $prices->fetch()) {
            $existingPrices[$price['CATALOG_GROUP_ID']] = $price;
        }

        $priceTypes = CCatalogGroup::GetList([], ['=NAME' => array_keys(self::LOYALTY_LEVELS)]);
        while ($priceType = $priceTypes->Fetch()) {
            $params = self::LOYALTY_LEVELS[$priceType['NAME']]['personal_bonuses_by_price'];
            $bonuses = (float) intdiv($priceFields['PRICE'], $params['step']) * $params['size'];

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
                    'CURRENCY' => 'RUB', //TODO cut hardcode
                    'PRICE_SCALE' => $bonuses,
                ]);
            }
        }
    }
}