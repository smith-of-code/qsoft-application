<?php

namespace QSoft\Queue\Jobs;

use QSoft\Service\OffersService;

class UpdateAllOffersBonusesJob extends BaseJob
{
    public function __construct()
    {
    }

    protected function getQueueName(): string
    {
        return 'update-all-offers-bonuses';
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    protected function process($data)
    {
        $offersService = new OffersService();
        $offersService->updateAllOffersBonuses();
    }

    protected function validateInputData($data): bool
    {
        return true;
    }
}
