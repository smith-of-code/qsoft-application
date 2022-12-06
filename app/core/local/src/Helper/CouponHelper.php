<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\Basket\Storage;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\BasketPropertyItem;
use Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Internals\DiscountCouponTable;
use Bitrix\Sale\Internals\DiscountTable;
use Bitrix\Sale\Internals\OrderCouponsTable;
use Bitrix\Sale\Order;
use Bitrix\Sale\Delivery\Services\Manager as DeliveryServicesManager;
use Bitrix\Sale\OrderTable;
use Bitrix\Sale\PaySystem\Manager as PaySystemManager;
use Bitrix\Sale\PropertyValue;
use CFile;
use QSoft\Entity\User;
use QSoft\ORM\BeneficiariesTable;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\DiscountsHelperTable;
use QSoft\ORM\NotificationTable;
use QSoft\ORM\TransactionTable;
use QSoft\Service\ProductService;

class CouponHelper
{
    const MAX_PERSONAL_PROMOTIONS = 6;

    public function getUserCoupons(int $userId): array
    {
        $now = new DateTime;
        $coupons = DiscountCouponTable::getList([
            'filter' => [
                '=USER_ID' => $userId,
                '=ACTIVE' => true,
                '=DISCOUNT.ACTIVE' => true,
                [
                    'LOGIC' => 'OR',
                    ['<ACTIVE_FROM' => $now],
                    ['=ACTIVE_FROM' => null],
                ],
                [
                    'LOGIC' => 'OR',
                    ['>ACTIVE_TO' => $now],
                    ['=ACTIVE_TO' => null],
                ],
            ],
            'limit' => self::MAX_PERSONAL_PROMOTIONS,
            'select' => [
                'ID',
                'COUPON',
                'ACTIVE_TO',
                'NAME' => 'DISCOUNT.NAME',
                'LINK' => 'ADVANCE.UF_LINK',
                'IMAGE' => 'ADVANCE.UF_IMAGE',
                'AMOUNT' => 'ADVANCE.UF_AMOUNT',
            ],
            'runtime' => [
                'DISCOUNT' => [
                    'data_type' => DiscountTable::class,
                    'reference' => ['=this.DISCOUNT_ID' => 'ref.ID'],
                ],
                'ADVANCE' => [
                    'data_type' => DiscountsHelperTable::class,
                    'reference' => ['=this.DISCOUNT_ID' => 'ref.UF_DISCOUNT_ID'],
                ],
            ],
        ]);

        $result = [];
        $imagesMap = [];
        foreach ($coupons as $coupon) {
            $coupon = array_combine(
                array_map(static fn ($key) => strtolower($key), array_keys($coupon)),
                $coupon
            );

            if ($coupon['image']) {
                $imagesMap[$coupon['image']] = $coupon['coupon'];
            }

            $result[$coupon['coupon']] = $coupon;
        }

        if ($imagesMap) {
            $images = CFile::GetList([], ['@ID' => implode(',', array_keys($imagesMap))]);
            while ($image = $images->Fetch()) {
                $result[$imagesMap[$image['ID']]]['image'] = CFile::GetFileSRC($image);
            }
        }

        return $result;
    }
}