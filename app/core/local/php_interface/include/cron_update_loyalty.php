<?php

// Проверка, что скрипт запущен из консоли(или cron).

use QSoft\Service\UpdateLoyaltyService;

if (substr(php_sapi_name(), 0, 3) !== 'cli') {
    echo 'access denied';
    die();
}

define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_CHECK', true);
define('NOT_CHECK_PERMISSIONS', true);

$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/../../../';
require_once($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php');

$loyaltyUpdater = new UpdateLoyaltyService();
$loyaltyUpdater->updateUsersLoyalty();

echo PHP_EOL;
echo 'access granted';
echo PHP_EOL;
