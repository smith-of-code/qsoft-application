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
?>

<div><?=Loc::getMessage('SETTINGS_PERSONAL_INFO')?></div>
<?php if ($arResult['USER_GROUP'] == 'Покупатель') :?>
    <div style="background: grey; margin: 5px;">Становись консультантом</div>
<?php endif;?>
<div style="background: grey; margin: 5px;">
    Персональные данные
    <div style="background: whitesmoke; margin:5px">
        Фамилия: <input type="text" value="<?=$arResult['USER_INFO']['LAST_NAME']?>" required>
        Имя: <input type="text" value="<?=$arResult['USER_INFO']['NAME']?>" required>
        Отчество: <input type="text" value="<?=$arResult['USER_INFO']['SECOND_NAME']?>"><br>
        Пол: <input type="text" value="<?=$arResult['USER_INFO']['PERSONAL_GENDER']?>" required>
        Дата рождения: <input type="text" value="<?=$arResult['USER_INFO']['PERSONAL_BIRTHDAY']?>" required><br>
        Email: <input type="text" value="<?=$arResult['USER_INFO']['EMAIL']?>" required>
        Телефон: <input type="text" value="<?=$arResult['USER_INFO']['PERSONAL_PHONE']?>" required><br>
        Населенный пункт: <input type="text" value="<?=$arResult['USER_INFO']['PERSONAL_CITY']?>" required>
        Пункт выдачи заказов: <input type="text" value="<?=$arResult['USER_INFO']['']?>" required><br>
        Фото: <input type="text" value="<?=$arResult['USER_INFO']['PERSONAL_PHOTO']?>"><br>
    </div>
    <button>Отменить изменения</button>
    <button style="background: darkgreen">Сохранить изменения</button>
    <?=dump($arResult)?>
</div>

<?php if ($arResult['USER_GROUP'] == 'Консультант') :?>
    <div style="background: grey; margin: 5px;">
        Юридические данные<br>
        Общее<br>
        <div style="background: whitesmoke; margin:5px">
            Статус и гражданство<br>
            Статус: <select value="<?=$arResult['LEGAL_ENTITY']['UF_STATUS']?>">
                <?php foreach ($arResult['SELECT_OPTIONS']['STATUS'] as $id => $value) : ?>
                    <option value="<?= $id ?>" class="form-control__option"
                        <?= ($id == $arResult['LEGAL_ENTITY']['UF_STATUS']) ? 'selected' : '' ?>>
                        <?= $value ?>
                    </option>
                <?php endforeach;?>
            </select><br>
            Гражданство: <input type="text" value="<?=$arResult['DOCUMENTS']['citizenship']?>" required>
            Паспортные данные<br>
            Серия: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['series']?>" required>
            Номер: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['number']?>" required><br>
            Кем выдан: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['issued']?>" required>
            Когда выдан: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['date']?>" required><br>
            Адрес регистрации<br>
            Населенный пункт: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressRegistration']['locality']?>" required>
            Улица: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressRegistration']['street']?>" required><br>
            Дом: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressRegistration']['home']?>" required>
            Квартира: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressRegistration']['flat']?>" required>
            Индекс: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressRegistration']['index']?>" required><br>
            Адрес проживания<br>
            <?php if ($arResult['DOCUMENTS']['passport']['addressFact'] == 'same') :?>
            Адрес регистрации совпадает с адресом фактического проживания<br>
            <?php else :?>
                Населенный пункт: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressFact']['locality']?>" required>
                Улица: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressFact']['street']?>" required><br>
                Дом: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressFact']['home']?>" required>
                Квартира: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressFact']['flat']?>" required>
                Индекс: <input type="text" value="<?=$arResult['DOCUMENTS']['passport']['addressFact']['index']?>" required><br>
            <?php endif;?>
            Копия паспорта<br>
            <?php foreach ($arResult['DOCUMENTS']['passport']['copyPassport'] as $file) :?>
            Файл: <input type="text" value="<?=$file?>" required> <br>
            <?php endforeach;?>
        </div>
        <?php if ($arResult['DOCUMENTS']['STATUS'] == "Самозанятый") :?>
            Самозанятый
            <div style="background: whitesmoke; margin:5px">
                ИНН и копия свидетельства о постановке на учет в налоговом органе<br>
                ИНН:<br><input type="text" value="<?=$arResult['DOCUMENTS']['inn']?>" required>
                <?php foreach ($arResult['DOCUMENTS']['innFiles'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                Банковские реквизиты<br>
                Наименование банка:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['name']?>" required>
                БИК:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['bik']?>" required><br>
                Расчетный счет:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['rAccount']?>" required>
                Корреспондентский счет:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['kAccount']?>" required><br>
                Сведения о банковских реквизитах<br>
                <?php foreach ($arResult['DOCUMENTS']['bank']['bankFiles'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                Справка о постановке на учет физического лица в качестве плательщика налога на профессиональный доход<br>
                <?php foreach ($arResult['DOCUMENTS']['referenceFNS'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
            </div>
        <?php elseif ($arResult['DOCUMENTS']['STATUS'] == "ИП") :?>
            Индивидуальный предприниматель
            <div style="background: whitesmoke; margin:5px">
                Наименование ИП: <input type="text" value="<?=$arResult['DOCUMENTS']['name']?>" required>
                ИНН: <input type="text" value="<?=$arResult['DOCUMENTS']['inn']?>" required>
                Плательщик НДС: <input type="text" value="<?=$arResult['DOCUMENTS']['nds']?>" required>
                Копия свидетельства о постановке на учет в налоговом органе:
                <?php foreach ($arResult['DOCUMENTS']['referenceFNS'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                <?php if ($arResult['DOCUMENTS']['nds'] == "Да") :?>
                    “Уведомление о применении УСН упрощенной системы налогоплательщика”:
                    <?php foreach ($arResult['DOCUMENTS']['usn'] as $file) :?>
                        Файл: <input type="text" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                <?php endif;?>
                ОГРНИП: <input type="text" value="<?=$arResult['DOCUMENTS']['ogrnip']?>" required> <br>
                “Свидетельство о государственной регистрации ИП/листа записи ЕГРИП”;
                <?php foreach ($arResult['DOCUMENTS']['egrip'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                Банковские реквизиты<br>
                Наименование банка:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['name']?>" required>
                БИК:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['bik']?>" required><br>
                Расчетный счет:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['rAccount']?>" required>
                Корреспондентский счет:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['kAccount']?>" required><br>
                Сведения о банковских реквизитах<br>
                <?php foreach ($arResult['DOCUMENTS']['bank']['bankFiles'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                Справка о постановке на учет физического лица в качестве плательщика налога на профессиональный доход<br>
                <?php foreach ($arResult['DOCUMENTS']['referenceFNS'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
            </div>
        <?php elseif ($arResult['DOCUMENTS']['STATUS'] == "ООО") :?>
            Общество с ограниченной ответственностью (ООО)
            <div style="background: whitesmoke; margin:5px">
                Наименование организации (полное): <input type="text" value="<?=$arResult['DOCUMENTS']['name']?>" required>
                Наименование организации (сокращенное): <input type="text" value="<?=$arResult['DOCUMENTS']['nameSmall']?>" required>
                ОГРН: <input type="text" value="<?=$arResult['DOCUMENTS']['ogrn']?>" required> <br>
                ИНН: <input type="text" value="<?=$arResult['DOCUMENTS']['inn']?>" required>
                Плательщик НДС: <input type="text" value="<?=$arResult['DOCUMENTS']['nds']?>" required>
                Копия свидетельства о постановке на учет российской организации в налоговом органе (ИНН)
                <?php foreach ($arResult['DOCUMENTS']['referenceFNS'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                КПП: <input type="text" value="<?=$arResult['DOCUMENTS']['kpp']?>" required>
                “Устав ООО”
                <?php foreach ($arResult['DOCUMENTS']['rule'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                “Протокол участников (решения участника) ООО об избрании руководителя организации”;
                <?php foreach ($arResult['DOCUMENTS']['leader'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                Приказ о вступлении в должность ген.директора: <input type="text" value="<?=$arResult['DOCUMENTS']['order']?>" required>
                “Свидетельство о государственной регистрации ООО/листа записи ЕГРЮЛ о внесении записи об ООО в ЕГРЮЛ”
                <?php foreach ($arResult['DOCUMENTS']['egrul'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                Право подписи: “[У меня есть право подписи документов ООО”|“У меня нет права подписи документов ООО, я хотел бы добавить уполномоченное лицо]”<input type="text" value="<?=$arResult['DOCUMENTS']['rightToSign']?>" required>
                <?php if ($arResult['DOCUMENTS']['rightToSign'] != "Да") :?>
                    <?php foreach ($arResult['DOCUMENTS']['rightToSign'] as $file) :?>
                        Файл: <input type="text" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                <?endif;?>
                Банковские реквизиты<br>
                Наименование банка:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['name']?>" required>
                БИК:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['bik']?>" required><br>
                Расчетный счет:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['rAccount']?>" required>
                Корреспондентский счет:<input type="text" value="<?=$arResult['DOCUMENTS']['bank']['kAccount']?>" required><br>
                Сведения о банковских реквизитах<br>
                <?php foreach ($arResult['DOCUMENTS']['bank']['bankFiles'] as $file) :?>
                    Файл: <input type="text" value="<?=$file?>" required> <br>
                <?php endforeach;?>
                Адрес организации<br>
                Населенный пункт: <input type="text" value="<?=$arResult['DOCUMENTS']['addressOrganization']['locality']?>" required>
                Улица: <input type="text" value="<?=$arResult['DOCUMENTS']['addressOrganization']['street']?>" required><br>
                Дом, корпус, строение: <input type="text" value="<?=$arResult['DOCUMENTS']['addressOrganization']['home']?>" required>
                Этаж, помещение, комната: <input type="text" value="<?=$arResult['DOCUMENTS']['addressOrganization']['flat']?>" required>
                Индекс: <input type="text" value="<?=$arResult['DOCUMENTS']['addressOrganization']['index']?>" required><br>
            </div>
        <?php endif;?>
        <button>Отменить изменения</button>
        <button style="background: darkgreen">Сохранить изменения</button>
    </div>
<?php endif;?>

    <div style="background: grey; margin: 5px;">
        Данные о питомцах
        <div style="background: whitesmoke; margin:5px">
            <?php foreach ($arResult['PETS_INFO'] as $pet) : ?>
            Тип питомца:<select value="<?=$pet['UF_KIND']?>">
                    <?php foreach ($arResult['SELECT_OPTIONS']['PET_KIND'] as $id => $value) : ?>
                        <option value="<?= $id ?>" class="form-control__option"
                            <?= ($id == $pet['UF_KIND']) ? 'selected' : '' ?>>
                            <?= $value ?>
                        </option>
                    <?php endforeach;?>
                </select>
            Пол:<select value="<?=$pet['UF_GENDER']?>">
                    <?php foreach ($arResult['SELECT_OPTIONS']['PET_GENDER'] as $id => $value) : ?>
                        <option value="<?= $id ?>" class="form-control__option"
                            <?= ($id == $pet['UF_GENDER']) ? 'selected' : '' ?>>
                            <?= $value ?>
                        </option>
                    <?php endforeach;?>
                </select>
            Дата рождения: <input type="date" value="<?=$pet['UF_BIRTHDATE']?>" required><br>
            Порода:<select value="<?=$pet['UF_BREED']?>">
                    <?php foreach ($arResult['SELECT_OPTIONS']['PET_BREED'] as $id => $value) : ?>
                        <option value="<?= $id ?>" class="form-control__option"
                            <?= ($id == $pet['UF_BREED']) ? 'selected' : '' ?>>
                            <?= $value ?>
                        </option>
                    <?php endforeach;?>
                </select>
            Кличка: <input type="text" value="<?=$pet['UF_NAME']?>" required><br>
            <?php endforeach;?>
            <button>Отменить изменения</button>
            <button style="background: darkgreen">Сохранить изменения</button>
        </div>
    </div>
    <div style="background: grey; margin: 5px;">
        Контактные данные наставника
        <div style="background: whitesmoke; margin:5px">
            Фамилия: <input type="text" value="<?=$arResult['MENTOR_INFO']['LAST_NAME']?>" required>
            Имя: <input type="text" value="<?=$arResult['MENTOR_INFO']['NAME']?>" required>
            Отчество: <input type="text" value="<?=$arResult['MENTOR_INFO']['SECOND_NAME']?>"><br>
            Email: <input type="text" value="<?=$arResult['MENTOR_INFO']['EMAIL']?>" required>
            Телефон: <input type="text" value="<?=$arResult['MENTOR_INFO']['PERSONAL_PHONE']?>" required><br>
            Населенный пункт: <input type="text" value="<?=$arResult['MENTOR_INFO']['PERSONAL_CITY']?>" required>
            Пункт выдачи заказов: <input type="text" value="<?=$arResult['MENTOR_INFO']['']?>" required><br>
            Фото: <input type="text" value="<?=$arResult['MENTOR_INFO']['PERSONAL_PHOTO']?>"><br>
            <button>Отменить изменения</button>
            <button style="background: darkgreen">Сохранить изменения</button>
        </div>
    </div>
    <div style="background: grey; margin: 5px;">Система лояльности</div>
    <div style="background: grey; margin: 5px;">Персональные акции</div>


<?php
$APPLICATION->IncludeComponent(
    'zolo:personal.main.profile.navigation_menu',
    '',
    [],
    [],
);
?>
