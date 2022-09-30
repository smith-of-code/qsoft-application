<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

/**
 * @var array $arResult
 * @var array $arParams
 * @var array $templateData
 */

use Bitrix\Main\Localization\Loc;

$currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<div><?=Loc::getMessage('SETTINGS_PERSONAL_INFO')?></div>

<div style="background: grey">
    Фамилия: <input type="text" value="<?=$arResult['USER_INFO']['LAST_NAME']?>" required>
    Имя: <input type="text" value="<?=$arResult['USER_INFO']['NAME']?>" required>
    Отчество: <input type="text" value="<?=$arResult['USER_INFO']['SECOND_NAME']?>"><br>
    Пол: <input type="text" value="<?=$arResult['USER_INFO']['PERSONAL_GENDER']?>" required>
    Дата рождения: <input type="text" value="<?=$arResult['USER_INFO']['PERSONAL_BIRTHDAY']?>" required><br>
    Email: <input type="text" value="<?=$arResult['USER_INFO']['EMAIL']?>" required>
    Телефон: <input type="text" value="<?=$arResult['USER_INFO']['PERSONAL_PHONE']?>" required><br>
    Населенный пункт: <input type="text" value="<?=$arResult['USER_INFO']['PERSONAL_CITY']?>"required>
    Пункт выдачи заказов: <input type="text" value="<?=$arResult['USER_INFO']['']?>"required><br>
    Фото: <input type="text" value="<?=$arResult['USER_INFO']['']?>"><br>

    <button>Отменить изменения</button>
    <button style="background: darkgreen">Сохранить изменения</button>
    <?=dump($arResult)?>
</div>

<div>
    <ul>
        <li>
            <a href="<?=$arParams['PROFILE_URL']?>">
                Профиль
                <?=($arParams['PROFILE_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
            </a>
        </li>
        <li>
            <a href="<?=$arParams['ORDER_HISTORY_URL']?>">
                История заказов
                <?=($arParams['ORDER_HISTORY_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
            </a>
        </li>
        <?php if ($arResult['IS_CONSULTANT']): ?>
            <li>
                <a href="<?=$arParams['INCOMES_CALCULATOR_URL']?>">
                    Калькулятор доходов
                    <?=($arParams['INCOMES_CALCULATOR_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
                </a>
            </li>
            <li>
                <a href="<?=$arParams['SALES_REPORT_URL']?>">
                    Отчёт по объёмам продаж
                    <?=($arParams['SALES_REPORT_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
                </a>
            </li>
        <?php endif ?>
        <li>
            <a href="<?=$arParams['NOTIFICATIONS_URL']?>">
                Уведомления
                <b>(<?=$arResult['NOTIFICATION_COUNT']?>)</b>
                <?=($arParams['NOTIFICATIONS_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
            </a>
        </li>
    </ul>
</div>