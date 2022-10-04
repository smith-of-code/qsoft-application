<?php

namespace QSoft\Queue\Jobs;

use QSoft\Service\BonusAccountService;

class BonusesPriceJob extends BaseJob
{
    public function __construct()
    {
    }

    protected function getQueueName(): string
    {
        return 'bonuses-price';
    }

    protected function process($data)
    {
        BonusAccountService::setOfferBonusesPrices($data['offerId'], $data['priceValue']);
    }

    protected function validateInputData($data): bool
    {
        return is_array($data) && !empty($data['offerId']) && !empty($data['priceValue']);
    }
}
