<?php
declare(strict_types=1);

namespace QSoft\Commands;

use Illuminate\Console\Command;
use QSoft\Service\OffersService;

class OfferCommand extends Command
{
    protected $description = 'Запускает пересчет акционных цен и бонусов для всех торговых предложений';
    protected $signature = 'offer:refresh
                            {prices? : пересчитывать акционные цены ТП}
                            {bonuses? : пересчитывать бонусные баллы ТП}';

    function handle()
    {
        try {
            $offersService = new OffersService();
            if (! is_null($this->argument('bonuses'))) {
                $offersService->updateAllOffersBonuses();
                echo 'Бонусные баллы ТП пересчитаны.' . PHP_EOL;
            }
            if (! is_null($this->argument('prices'))) {
                $offersService->updateAllOffersDiscountPrices();
                echo 'Акционные цены ТП пересчитаны.' . PHP_EOL;
            }

        } catch (\Throwable $e) {
            $this->output->error('Ошибка: ' . $e->getMessage());
            return;
        }
    }
}
