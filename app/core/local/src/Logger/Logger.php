<?php
namespace QSoft\Logger;

use Bitrix\Main\Diag\FileLogger;
use Bitrix\Main\Diag\LogFormatter;
use Illuminate\Support\Carbon;

/**
 * Класс для логирования различных событий 
 * class Logger
 * @package QSoft\Logger
 * 
 */
class Logger extends FileLogger
{

    /**
     * Фиксированный уровень собития для логирования.
     *
     * @var string
     */
    private $fixLevel;

    /**
     * Определение трех основных параметров
     * название папки для логов
     * тип ошибки, как часть названия файла лога
     * И размер файла перед его ротацией, то-есть сколько должен весить файл, прежде чем его
     * архивирует логгер
     *
     * @param array $logName
     * @param mixed $size
     * @param string $level Можно задать при помощи констант класса LogLevel
     *      class Psr\Log\LogLevel
     *      {
     *          const EMERGENCY = 'emergency';
     *          const ALERT     = 'alert';
     *          const CRITICAL  = 'critical';
     *          const ERROR     = 'error';
     *          const WARNING   = 'warning';
     *          const NOTICE    = 'notice';
     *          const INFO      = 'info';
     *          const DEBUG     = 'debug';
     *      }
     * 
     */
    public function __construct($fileName, $maxSize = 0, $level = 'info') {
        $this->fixLevel = $level;
        self::$supportedLevels = parent::$supportedLevels;
        parent::__construct($this->setPath($fileName, $level), $maxSize);
        $this->setLevel($level);


    }

    /**
     * Статический способ создать логгер , для создания статического вызова
     *
     * @param string $logName
     * @param int $size
     * @param string $level
     * 
     * @return Logger
     */
    public static function createLogger(string $logName, int $size = 0, string $level = 'info'): Logger
    {
        return new Logger($logName, $size, $level);
    }

    /**
     * Запись в лог
     *
     * @param string $message - сообщение об ошибке
     * @param array $details - Массив, где можно поместить детали лога
     * 
     * @return void
     * 
     */
    public function setLog(string $message, array $details = [])
    {
        $this->log($this->fixLevel, $this->parseFormatMessage($message, $details), $this->setFormatArguments());

        return $this;
    }

    private function parseFormatMessage(string $message, array $details = [])
    {
        return PHP_EOL
            .'{date} - '
            . $message
            . PHP_EOL
            . (!empty($details) ? str_replace('Array', 'Datails', print_r($details, true)) : '') 
            . '{delimiter}';
    }

    private function setFormatArguments()
    {
        return [
            'date' => Carbon::now()->format('d.m.Y H:i:s'),
            'type' => $this->fixLevel,
        ];
    }

    /**
     * Создание пути к логу
     *
     * @return [type]
     * 
     */
    private function setPath($logName, $level)
    {
        $root = str_replace('/htdocs', '', $_SERVER['DOCUMENT_ROOT']);
        $path =
            $root
            . '/app/core/local/php_interface/logs/'
            . $logName . '/';

        if (!$this->createPath($path)) {
            return null;
        }

        return $path . $level . '_' . Carbon::now()->format('m.Y') . '.log';
    }

    private function createPath($path)
    {
        if (file_exists($path)) {
            return true;
        }

        mkdir($path, 0777, true);

        if (file_exists($path)) {
            return true;
        }

        return false;
    }

	protected function getFormatter()
	{
		if ($this->formatter === null)
		{
			$this->formatter = new LogFormatter(true);
		}

		return $this->formatter;
	}
}
