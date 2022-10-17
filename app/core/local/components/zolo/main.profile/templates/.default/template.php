<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\Localization\Loc;

global $APPLICATION;

$APPLICATION->IncludeComponent(
    'zolo:personal.main.profile.navigation_menu',
    '',
);
?>

<div><?=Loc::getMessage('SETTINGS_PERSONAL_INFO')?></div>
<?php if ($arResult['USER_GROUP'] == 'Покупатель') :?>
    <div style="background: grey; margin: 5px;">Становись консультантом</div>
<?php endif;?>
<div style="background: grey; margin: 5px;">
    Персональные данные
    <form action="" method="post" id="user_info" enctype="multipart/form-data">
        <div style="background: whitesmoke; margin:5px">
            Фамилия: <input type="text" name="LAST_NAME" value="<?=$arResult['USER_INFO']['LAST_NAME']?>" >
            Имя: <input type="text" name="NAME" value="<?=$arResult['USER_INFO']['NAME']?>" required>
            Отчество: <input type="text" name="SECOND_NAME" value="<?=$arResult['USER_INFO']['SECOND_NAME']?>"><br>
            Пол: <select name="PERSONAL_GENDER" value="<?=$arResult['USER_INFO']['PERSONAL_GENDER']?>">
                <?php foreach ($arResult['SELECT_OPTIONS']['USER_GENDER'] as $id => $value) : ?>
                    <option value="<?= $id ?>" class="form-control__option"
                        <?= ($id == $arResult['USER_INFO']['PERSONAL_GENDER']) ? 'selected' : '' ?>>
                        <?= $value ?>
                    </option>
                <?php endforeach;?>
            </select>
            Дата рождения: <input type="text" name="PERSONAL_BIRTHDAY" value="<?=$arResult['USER_INFO']['PERSONAL_BIRTHDAY']?>" required><br>
            Email: <input type="text" name="EMAIL" value="<?=$arResult['USER_INFO']['EMAIL']?>" required>
            Телефон: <input type="text" name="PERSONAL_PHONE" value="<?=$arResult['USER_INFO']['PERSONAL_PHONE']?>" ><br>
            Населенный пункт: <input type="text" name="PERSONAL_CITY" value="<?=$arResult['USER_INFO']['PERSONAL_CITY']?>" >
            Пункт выдачи заказов: <select name="UF_PICKUP_POINT_ID" value="<?=$arResult['USER_INFO']['UF_PICKUP_POINT_ID']?>">
                <?php foreach ($arResult['SELECT_OPTIONS']['PICK_POINT'] as $id => $value) : ?>
                    <option value="<?= $id ?>" class="form-control__option"
                        <?= ($id == $arResult['USER_INFO']['UF_PICKUP_POINT_ID']) ? 'selected' : '' ?>>
                        <?= $value ?>
                    </option>
                <?php endforeach;?>
            </select><br>
            Фото:
            <img src="<?=$arResult['USER_INFO']['PERSONAL_PHOTO_URL']?>"><br>
        </div>
        <button>Отменить изменения</button>
        <button style="background: darkgreen" type="submit" value="Y">Сохранить изменения</button>
    </form>
        <?=dump($arResult)?>
</div>

<?php if ($arResult['USER_GROUP'] == 'Консультант') :?>
    <div style="background: grey; margin: 5px;">
        Юридические данные<br>
        <form action="" method="post" id="legal_entity" enctype="multipart/form-data">
            Общее<br>
            <div style="background: whitesmoke; margin:5px">
                Статус и гражданство<br>
                Статус: <select name="UF_STATUS" value="<?=$arResult['LEGAL_ENTITY']['UF_STATUS']?>">
                    <?php foreach ($arResult['SELECT_OPTIONS']['STATUS'] as $id => $value) : ?>
                        <option value="<?= $id ?>" class="form-control__option"
                            <?= ($id == $arResult['LEGAL_ENTITY']['UF_STATUS']) ? 'selected' : '' ?>>
                            <?= $value ?>
                        </option>
                    <?php endforeach;?>
                </select><br>
                Гражданство: <input type="text" name="citizenship" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['citizenship']?>" required>
                Паспортные данные<br>
                Серия: <input type="text" name="passport.series" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['series']?>" required>
                Номер: <input type="text" name="passport.number" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['number']?>" required><br>
                Кем выдан: <input type="text" name="passport.issued" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['issued']?>" required>
                Когда выдан: <input type="text" name="passport.date" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['date']?>" required><br>
                Адрес регистрации<br>
                Населенный пункт: <input type="text" name="passport.addressRegistration.locality" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['locality']?>" required>
                Улица: <input type="text" name="passport.addressRegistration.street" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['street']?>" required><br>
                Дом: <input type="text" name="passport.addressRegistration.home" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['home']?>" required>
                Квартира: <input type="text" name="passport.addressRegistration.flat" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['flat']?>" required>
                Индекс: <input type="text" name="passport.addressRegistration.index" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['index']?>" required><br>
                Адрес проживания<br>
                Адрес регистрации совпадает с адресом фактического проживания
                <input type="checkbox" name="passport.addressRegistration.index" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['index']?>"><br>
                <?php if ($arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact'] != 'Y') :?>
                    Населенный пункт: <input type="text" name="passport.addressFact.locality" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['locality']?>" required>
                    Улица: <input type="text" name="passport.addressFact.street" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['street']?>" required><br>
                    Дом: <input type="text" name="passport.addressFact.home" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['home']?>" required>
                    Квартира: <input type="text" name="passport.addressFact.flat" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['flat']?>" required>
                    Индекс: <input type="text" name="passport.addressFact.index" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['index']?>" required><br>
                <?php endif;?>
                Копия паспорта<br>
                <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['copyPassport'] as $file) :?>
                Файл: <input type="text" name="passport.copyPassport" value="<?=$file?>" required> <br>
                <?php endforeach;?>
            </div>
            <?php if ($arResult['STATUS'] == "Самозанятый") :?>
                Самозанятый
                <div style="background: whitesmoke; margin:5px">
                    ИНН и копия свидетельства о постановке на учет в налоговом органе<br>
                    ИНН:<br><input type="text" name="inn" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['inn']?>" required>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['innFiles'] as $file) :?>
                        Файл: <input type="text" name="innFiles" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Банковские реквизиты<br>
                    Наименование банка:<input type="text" name="bank.name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['name']?>" required>
                    БИК:<input type="text" name="bank.bik" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bik']?>" required><br>
                    Расчетный счет:<input type="text" name="bank.rAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['rAccount']?>" required>
                    Корреспондентский счет:<input type="text" name="bank.kAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['kAccount']?>" required><br>
                    Сведения о банковских реквизитах<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bankFiles'] as $file) :?>
                        Файл: <input type="text" name="bank.bankFiles" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Справка о постановке на учет физического лица в качестве плательщика налога на профессиональный доход<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['referenceFNS'] as $file) :?>
                        Файл: <input type="text" name="referenceFNS" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                </div>
            <?php elseif ($arResult['STATUS'] == "ИП") :?>
                Индивидуальный предприниматель
                <div style="background: whitesmoke; margin:5px">
                    Наименование ИП: <input type="text" name="name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['name']?>" required>
                    ИНН: <input type="text" name="inn" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['inn']?>" required>
                    Плательщик НДС: <input type="checkbox" name="nds" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['nds']?>" required>
                    Копия свидетельства о постановке на учет в налоговом органе:
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['referenceFNS'] as $file) :?>
                        Файл: <input type="text" name="referenceFNS" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    <?php if ($arResult['LEGAL_ENTITY']['DOCUMENTS']['nds'] == "Да") :?>
                        “Уведомление о применении УСН упрощенной системы налогоплательщика”:
                        <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['usn'] as $file) :?>
                            Файл: <input type="text" name="usn" value="<?=$file?>" required> <br>
                        <?php endforeach;?>
                    <?php endif;?>
                    ОГРНИП: <input type="text" name="ogrnip" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['ogrnip']?>" required> <br>
                    “Свидетельство о государственной регистрации ИП/листа записи ЕГРИП”;
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['egrip'] as $file) :?>
                        Файл: <input type="text" name="egrip" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Банковские реквизиты<br>
                    Наименование банка:<input type="text" name="bank.name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['name']?>" required>
                    БИК:<input type="text" name="bank.bik" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bik']?>" required><br>
                    Расчетный счет:<input type="text" name="bank.rAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['rAccount']?>" required>
                    Корреспондентский счет:<input type="text" name="bank.kAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['kAccount']?>" required><br>
                    Сведения о банковских реквизитах<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bankFiles'] as $file) :?>
                        Файл: <input type="text" name="bank.bankFiles" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Справка о постановке на учет физического лица в качестве плательщика налога на профессиональный доход<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['referenceFNS'] as $file) :?>
                        Файл: <input type="text" name="referenceFNS" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                </div>
            <?php elseif ($arResult['STATUS'] == "ООО") :?>
                Общество с ограниченной ответственностью (ООО)
                <div style="background: whitesmoke; margin:5px">
                    Наименование организации (полное): <input type="text" name="name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['name']?>" required>
                    Наименование организации (сокращенное): <input type="text" name="nameSmall" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['nameSmall']?>" required>
                    ОГРН: <input type="text" name="ogrn" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['ogrn']?>" required> <br>
                    ИНН: <input type="text" name="inn" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['inn']?>" required>
                    Плательщик НДС: <input type="checkbox" name="nds" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['nds']?>" required>
                    Копия свидетельства о постановке на учет российской организации в налоговом органе (ИНН)
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['referenceFNS'] as $file) :?>
                        Файл: <input type="text" name="referenceFNS" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    КПП: <input type="text" name="kpp" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['kpp']?>" required>
                    “Устав ООО”
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['rule'] as $file) :?>
                        Файл: <input type="text" name="rule" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    “Протокол участников (решения участника) ООО об избрании руководителя организации”;
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['leader'] as $file) :?>
                        Файл: <input type="text" name="leader" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Приказ о вступлении в должность ген.директора: <input type="text" name="order" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['order']?>" required>
                    “Свидетельство о государственной регистрации ООО/листа записи ЕГРЮЛ о внесении записи об ООО в ЕГРЮЛ”
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['egrul'] as $file) :?>
                        Файл: <input type="text" name="egrul" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Право подписи: “[У меня есть право подписи документов ООО”|“У меня нет права подписи документов ООО, я хотел бы добавить уполномоченное лицо]”
                    <input type="checkbox" name="rightToSign" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['rightToSign']?>" required>
                    <?php if ($arResult['LEGAL_ENTITY']['DOCUMENTS']['rightToSign'] != "Да") :?>
                        <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['rightToSign'] as $file) :?>
                            Файл: <input type="text" name="rightToSign" value="<?=$file?>" required> <br>
                        <?php endforeach;?>
                    <?endif;?>
                    Банковские реквизиты<br>
                    Наименование банка:<input type="text" name="bank.name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['name']?>" required>
                    БИК:<input type="text" name="bank.bik" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bik']?>" required><br>
                    Расчетный счет:<input type="text" name="bank.rAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['rAccount']?>" required>
                    Корреспондентский счет:<input type="text" name="bank.kAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['kAccount']?>" required><br>
                    Сведения о банковских реквизитах<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bankFiles'] as $file) :?>
                        Файл: <input type="text" name="bank.bankFiles" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Адрес организации<br>
                    Населенный пункт: <input type="text" name="addressOrganization.locality" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['locality']?>" required>
                    Улица: <input type="text" name="addressOrganization.street" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['street']?>" required><br>
                    Дом, корпус, строение: <input type="text" name="addressOrganization.home" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['home']?>" required>
                    Этаж, помещение, комната: <input type="text" name="addressOrganization.flat" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['flat']?>" required>
                    Индекс: <input type="text" name="addressOrganization.index" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['index']?>" required><br>
                </div>
            <?php endif;?>
            <button>Отменить изменения</button>
            <button style="background: darkgreen" type="submit" value="Y">Сохранить изменения</button>
        </form>
    </div>
<?php endif;?>

    <div style="background: grey; margin: 5px;">
        Данные о питомцах
        <ul data-pet-list>
        <?php $index = 0;?>
        <?php foreach ($arResult['PETS_INFO'] as $pet) : ?>
        <li data-pet-item id="<?=$pet['ID']?>">
            <form action="" id="pet_info">
                <div style="background: whitesmoke; margin:5px">
                    <div style="background: lightgrey; margin:5px">
                        Тип питомца:<select name="UF_KIND" id="UF_KIND-<?=$index?>" value="<?=$pet['UF_KIND']?>">
                                <?php foreach ($arResult['SELECT_OPTIONS']['PET_KIND'] as $id => $value) : ?>
                                    <option value="<?= $id ?>" class="form-control__option"
                                        <?= ($id == $pet['UF_KIND']) ? 'selected' : '' ?>>
                                        <?= $value ?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        Пол:<select name="UF_GENDER" id="UF_GENDER-<?=$index?>" value="<?=$pet['UF_GENDER']?>">
                                <?php foreach ($arResult['SELECT_OPTIONS']['PET_GENDER'] as $id => $value) : ?>
                                    <option value="<?= $id ?>" class="form-control__option"
                                        <?= ($id == $pet['UF_GENDER']) ? 'selected' : '' ?>>
                                        <?= $value ?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        Дата рождения: <input type="text" name="UF_BIRTHDATE" value="<?=$pet['UF_BIRTHDATE']?>" required><br>
                        Породы кошек:<select name="UF_CAT_BREED" id="UF_CAT_BREED-<?=$index?>" value="<?=$pet['UF_BREED']?>">
                            <?php foreach ($arResult['SELECT_OPTIONS']['CAT_BREED'] as $id => $value) : ?>
                                <option value="<?= $id ?>" class="form-control__option"
                                    <?= ($id == $pet['UF_BREED']) ? 'selected' : '' ?>>
                                    <?= $value ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                        Породы собак:<select name="UF_DOG_BREED" id="UF_DOG_BREED-<?=$index?>" value="<?=$pet['UF_BREED']?>">
                            <?php foreach ($arResult['SELECT_OPTIONS']['DOG_BREED'] as $id => $value) : ?>
                                <option value="<?= $id ?>" class="form-control__option"
                                    <?= ($id == $pet['UF_BREED']) ? 'selected' : '' ?>>
                                    <?= $value ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                        Кличка: <input type="text" name="UF_NAME" value="<?=$pet['UF_NAME']?>" required><br>
                    </div>
                    <button delete-pet>Удалить</button>
                    <button type="submit" style="background: darkgreen" save-pet>Сохранить</button>
                </div>
            </form>
        </li>
        <?php $index++;
        endforeach;?>
        </ul>
        <button add-pet>Добавить питомца</button>
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
            Фото: <img src="<?=$arResult['MENTOR_INFO']['PERSONAL_PHOTO_URL']?>"><br>
        </div>
    </div>
    <div style="background: grey; margin: 5px;">Система лояльности</div>
        <div class="profile_block_title">
            <span class="block_title"><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_TITLE')?></span>
        </div>
        <?php if (! empty($arResult['LOYALTY_INFO'])) :?>
            <?php if ($arResult['USER_GROUP'] == 'Консультант') :?>

            <?/* БЛОК "ДОСТИЖЕНИЯ" */?>
            <div style="display: flex; flex-direction: row;">
                <div class="block current_level" style="display: flex; flex-direction: column; height: 100px; background-color: #daf5e8">
                    <div><?=$arResult['LOYALTY_INFO']['CURRENT_LEVEL']?></div>
                    <div><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_ACHIEVEMENTS_LEVEL')?></div>
                </div>
                <div class="block current_level" style="display: flex; flex-direction: column; height: 100px; background-color: #fdd1d8">
                    <div><?=$arResult['LOYALTY_INFO']['PERSONAL_DISCOUNT'] . '%'?></div>
                    <div><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_ACHIEVEMENTS_DISCOUNT')?></div>
                </div>
                <div class="block current_level" style="display: flex; flex-direction: column; height: 100px; background-color: #dccee2">
                    <div><?=$arResult['LOYALTY_INFO']['CURRENT_AMOUNT_OF_BONUSES']?></div>
                    <div>
                        <?=Loc::getMessage(
                            'PROFILE_PAGE_LOYALTY_SYSTEM_ACHIEVEMENTS_BONUSES',
                            [
                                '#QUARTER#' => \QSoft\Service\DateTimeService::getQuarterFormatted(),
                                '#YEAR#' => \Carbon\Carbon::now()->year
                            ]
                        )?>
                    </div>
                </div>
            </div>
            <?php elseif ($arResult['USER_GROUP'] == 'Покупатель') :?>

            <?php endif;?>
        <?php else: ?>
            <div>
                <span class="error" style="background-color: #f5b0cc; color: white; font-weight: bold;">
                    <?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_NOT_PARTICIPANT')?>
                </span>
            </div>
        <?php endif;?>
    <div style="background: grey; margin: 5px;">Персональные акции</div>


<div data-kind-name-list class="is-hidden">
    <?php foreach ($arResult['SELECT_OPTIONS']['PET_KIND'] as $id => $value) : ?>
        <option value="<?= $id ?>" class="form-control__option"><?= $value ?></option>
    <?php endforeach;?>
</div>
<div data-gender-name-list class="is-hidden">
    <?php foreach ($arResult['SELECT_OPTIONS']['PET_GENDER'] as $id => $value) : ?>
        <option value="<?= $id ?>" class="form-control__option"><?= $value ?></option>
    <?php endforeach;?>
</div>
<div data-cat-name-list class="is-hidden">
    <?php foreach ($arResult['SELECT_OPTIONS']['CAT_BREED'] as $id => $value) : ?>
        <option value="<?= $id ?>" class="form-control__option"><?= $value ?></option>
    <?php endforeach;?>
</div>
<div data-dog-name-list class="is-hidden">
    <?php foreach ($arResult['SELECT_OPTIONS']['DOG_BREED'] as $id => $value) : ?>
        <option value="<?= $id ?>" class="form-control__option"><?= $value ?></option>
    <?php endforeach;?>
</div>

