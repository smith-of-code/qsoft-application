<?php

namespace QSoft\Queue\Jobs;

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
        $offersService->setOfferBonuses($data['offerId'], $data['priceValue']);
        $offersService->setOfferDiscountPrices($data['offerId'], $data['priceValue']);
    }

    protected function validateInputData($data): bool
    {
        return is_array($data) && !empty($data['offerId']) && !empty($data['priceValue']);
    }
}
