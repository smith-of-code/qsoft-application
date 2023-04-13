<?php

namespace QSoft\Queue\Jobs;

use QSoft\Foundation\Component\Exception;
use QSoft\Service\OffersService;

class BonusesPriceJob extends BaseJob
{
    public function __construct()
    {
    }

    protected function getQueueName(): string
    {
        return 'bonuses-price';
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    protected function process($data)
    {
        $offersService = new OffersService();
        $offersService->setOfferBonuses((int)$data['offerId'], (float)$data['priceValue']);
        $offersService->setOfferDiscountPrices((int)$data['offerId'], (float)$data['priceValue']);
    }

    protected function validateInputData($data): bool
    {
        return is_array($data) && !empty($data['offerId']) && !empty($data['priceValue']);
    }
}
