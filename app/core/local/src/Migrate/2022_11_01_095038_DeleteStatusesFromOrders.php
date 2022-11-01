<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use QSoft\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteStatusesFromOrders extends Migration {

    /**
     * STATUS_IDS
     *
     * @var const
     */
    private const STATUS_IDS = [
        'N',
        'F',
        'P',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $this->includeModules();
        $statusIds = $this->getStatusByCode();

        foreach($statusIds as $statusId) {dump($statusId);
            CSaleStatus::Delete($statusId);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $this->includeModules();
        $statusIds = $this->getStatusByCode();
        $statuses = $this->prepareFields();

        foreach ($statuses as $statusFealds) {
            if (in_array($statusFealds['ID'], $statusIds)) {dump($statusFealds);
                continue;
            }

            CSaleStatus::Add($statusFealds);
        }

    }

    /**
     * [Description for getStatusByCode]
     *
     * @return array
     * 
     */
    protected function getStatusByCode(): array
    {
        $dbResult = CSaleStatus::GetList([], ['ID' => self::STATUS_IDS]);
        while ($status = $dbResult->GetNext()) {
            $result[] = $status['ID'];
        }

        return $result ?? [];
    }

    /**
     * [Description for prepareFields]
     *
     * @return array
     * 
     */
    protected function prepareFields(): array
    {
        return [
            [
                'ID' => 'N',
                'SORT' => 100,
                'LANG' => [
                    'LID' => 'ru',
                    'NAME' => 'Принят, ожидается оплата',
                    'DESCRIPTION' => 'Заказ принят, но пока не обрабатывается (например, заказ только что создан или ожидается оплата заказа)',
                ]
            ],
            [
                'ID' => 'F',
                'SORT' => 200,
                'LANG' => [
                    'LID' => 'ru',
                    'NAME' => 'Выполнен',
                    'DESCRIPTION' => 'Заказ доставлен и оплачен',
                ]
            ],
            [
                'ID' => 'P',
                'SORT' => 150,
                'LANG' => [
                    [
                        'LID' => 'en',
                        'NAME' => 'Оплачен, формируется к отправке',
                        'DESCRIPTION' => 'Заказ оплачен, формируется к отправке клиенту.',
                    ],
                    [
                        'LID' => 'ru',
                        'NAME' => 'Оплачен, формируется к отправке',
                        'DESCRIPTION' => 'Заказ оплачен, формируется к отправке клиенту.',
                    ],
                ]
            ],
        ];
    }

    /**
     * @return void
     */
    protected function includeModules(): void
    {
        if (!\CModule::IncludeModule('sale')) {
            throw new \RuntimeException('Не удалось подключить модуль iblock');
        }
    }
}