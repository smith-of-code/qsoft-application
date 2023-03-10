<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\Internals\DiscountCouponTable;
use Bitrix\Sale\Internals\DiscountTable;
use CFile;
use QSoft\ORM\DiscountsHelperTable;

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
                $result[$imagesMap[$image['ID']]]['image'] = CFile::ResizeImageGet(
                    $image['ID'],
                    ['width' => MAIN_PROFILE_PERSONAL_COUPONS_PICTURES_MAX_WIDTH, 'height'=> MAIN_PROFILE_PERSONAL_COUPONS_PICTURES_MAX_HEIGHT],
                    BX_RESIZE_IMAGE_EXACT,
                )['src'];
            }
        }

        return $result;
    }
}