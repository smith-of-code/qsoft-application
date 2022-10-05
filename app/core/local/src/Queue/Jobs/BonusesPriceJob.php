<?php

namespace QSoft\Queue\Jobs;

use QSoft\Service\LoyaltyService;

class BonusesPriceJob extends BaseJob
{
    private LoyaltyService $loyaltyService;

    public function __construct()
    {
        $this->loyaltyService = new LoyaltyService;
    }

    protected function getQueueName(): string
    {
        return 'bonuses-price';
    }

    protected function process($data)
    {
        $this->loyaltyService->setOfferBonusesPrices($data['offerId'], $data['priceValue']);
    }

    protected function validateInputData($data): bool
    {
        return is_array($data) && !empty($data['offerId']) && !empty($data['priceValue']);
    }
}
