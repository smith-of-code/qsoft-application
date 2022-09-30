<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
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