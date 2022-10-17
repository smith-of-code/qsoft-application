<?php

namespace QSoft\Service;

use Bitrix\Main\Type\DateTime;
use Carbon\Carbon;

/**
 * Класс для работы с датами/временем
 * @package QSoft\Service
 */
class DateTimeService
{
    /**
     * Конвертирует объект Carbon в DateTime Битрикса
     */
    static public function CarbonToBitrixDateTime(Carbon $dateTime) : DateTime
    {
        return DateTime::createFromTimestamp($dateTime->timestamp);
    }

    /**
     * Возвращает дату начала указанного квартала
     * @param int $quarter Позиция квартала:
     * "0" - текущий квартал, "-1" - предыдущий квартал, "1" - следующий квартал.
     * Аналогично для других кварталов (например "-3" - сдвиг на 3 квартала назад).
     * @return Carbon
     */
    static public function getStartOfQuarter(int $quarter): Carbon
    {
        if ($quarter > 0) {
            return Carbon::now()->startOfQuarter()->modify('+' . ($quarter * 3) . ' month');
        } elseif ($quarter < 0) {
            return Carbon::now()->startOfQuarter()->modify(($quarter * 3) . ' month');
        }
        return Carbon::now()->startOfQuarter();
    }

    /**
     * Возвращает дату окончания указанного квартала
     * @param int $quarter Позиция квартала:
     * "0" - текущий квартал, "-1" - предыдущий квартал, "1" - следующий квартал.
     * Аналогично для других кварталов (например "-3" - сдвиг на 3 квартала назад).
     * @return Carbon
     */
    static public function getEndOfQuarter(int $quarter): Carbon
    {
        if ($quarter > 0) {
            return Carbon::now()->endOfQuarter()->modify('+' . ($quarter * 3) . ' month');
        } elseif ($quarter < 0) {
            return Carbon::now()->endOfQuarter()->modify(($quarter * 3) . ' month');
        }
        return Carbon::now()->endOfQuarter();
    }

    /**
     * Возвращает отформатированный номер квартала.
     * Если не указать номер квартала - будет использован номер текущего квартала
     * @param int $quarter Номер квартала
     * @return string Форматированный номер
     */
    static public function getQuarterFormatted(int $quarter = 0): string
    {
        if ($quarter <= 0) {
            $quarter = Carbon::now()->quarter;
        }
        if ($quarter === 1) {
            return 'I';
        } elseif ($quarter === 2) {
            return 'II';
        } elseif ($quarter === 3) {
            return 'III';
        } elseif ($quarter === 4) {
            return 'IV';
        }
        return '';
    }
}