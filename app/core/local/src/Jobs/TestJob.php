<?php
declare(strict_types=1);
namespace QSoft\Jobs;

class TestJob
{
    /**
     * Пример обработчика сообщения закинутого в очередь
     *
     * @param \QSoft\Queue\Jobs\BXDatabaseJob $job
     * @param $data
     * @return void
     */
    public function fire($job, $data)
    {
        // Дамп прилетевших данных в app/site/__bx_log.log
        // \Bitrix\Main\Diag\Debug::writeToFile($data, 'TestJob data');
        // В отдельном терминале следим за обновлениями файла: tail -f app/site/__bx_log.log

        // Делаем что-нибудь полезное

        // Удаляем успешно обработанное сообщение из очереди
        if (!$job->isDeletedOrReleased()) {
            $job->delete();
        }
    }
}
