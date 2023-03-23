<?php

/**
 * @var $adminPage
 * @var $adminMenu
 * @var $APPLICATION
 */

use QSoft\Entity\User;
use QSoft\Helper\TicketHelper;
use QSoft\ORM\LegalEntityTable;

require_once("$_SERVER[DOCUMENT_ROOT]/bitrix/modules/main/include/prolog_admin_before.php");
IncludeModuleLangFile(__FILE__);

$adminPage->Init();
$adminMenu->Init($adminPage->aModules);

if (!$adminMenu->aGlobalMenu) {
    $APPLICATION->AuthForm(GetMessage('ACCESS_DENIED'));
}

$APPLICATION->SetAdditionalCSS('/bitrix/themes/' . ADMIN_THEME_ID . '/index.css');

$APPLICATION->SetTitle(GetMessage('admin_index_title'));

require_once("$_SERVER[DOCUMENT_ROOT]/bitrix/modules/main/include/prolog_admin_after.php");

$userId = $_REQUEST['user_id'];
$ticketId = $_REQUEST['ticket_id'];
if (!$userId && !$ticketId) {
    die();
}

if ($userId) {
    $ticketData = (new User)->legalEntity->getData();
} else {
    $ticketData = (new TicketHelper)->getTicketData($ticketId);
}
$arResult = $ticketData['documents'];?>

<div class="registration__form form form--separated form--wraped">
    <div class="section__box box box--gray box--rounded-sm">
        <div class="section__box-inner">
            <h5 class="box__heading box__heading--middle">Общее</h5>

            <div class="section__box-content box box--white box--rounded-sm box--inner">
                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Статус и гражданство</h6>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="status" class="form__label form__label--required">
                                        <span class="form__label-text">Статус</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="form__control">
                                        <div class="select select--mitigate" data-select>
                                            <select class="select__control" name="status" id="status" data-select-control data-placeholder="Выберите статус">
                                                <option><?=$ticketData['type']['name']?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="nationality" class="form__label form__label--required">
                                        <span class="form__label-text">Гражданство</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="form__control">
                                        <div class="select select--mitigate" data-select>
                                            <select class="select__control" name="nationality" id="nationality" data-select-control data-placeholder="Выберите пол">
                                                <option><!-- пустой option для placeholder --></option>
                                                <option value="russian" <?=$arResult['nationality'] === 'russian' ? 'selected' : ''?>>Резидент РФ</option>
                                                <option value="not_russian" <?=$arResult['nationality'] === 'not_russian' ? 'selected' : ''?>>Нерезидент РФ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Паспортные данные</h6>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="passport_series" class="form__label form__label--required">
                                        <span class="form__label-text">Серия</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="passport_series"
                                                id="passport_series"
                                                placeholder="12 34"
                                                data-passport-seria
                                                value="<?=$arResult['passport_series']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="passport_number" class="form__label form__label--required">
                                        <span class="form__label-text">Номер</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="passport_number"
                                                id="passport_number"
                                                placeholder="Введите номер паспорта"
                                                data-passport-number
                                                value="<?=$arResult['passport_number']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="who_got" class="form__label form__label--required">
                                        <span class="form__label-text">Кем выдан</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="who_got"
                                                id="who_got"
                                                placeholder="Кем выдан"
                                                value="<?=$arResult['who_got']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="getting_date" class="form__label">
                                        <span class="form__label-text">Дата выдачи паспорта</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input input--iconed">
                                        <input inputmode="numeric"
                                               class="input__control"
                                               name="getting_date"
                                               id="getting_date"
                                               placeholder="ДД.ММ.ГГГГ"
                                               data-mask-date
                                               data-pets-date-input
                                               data-pets-change
                                               value="<?=$arResult['getting_date']?>"
                                               autocomplete="off"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия паспорта</h6>
                    <?php foreach ($arResult['passport'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Адрес регистрации</h6>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="register_locality" class="form__label form__label--required">
                                        <span class="form__label-text">Населенный пункт</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="register_locality"
                                                id="register_locality"
                                                placeholder="Населенный пункт"
                                                value="<?=$arResult['register_locality']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="register_street" class="form__label form__label--required">
                                        <span class="form__label-text">Улица</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="register_street"
                                                id="register_street"
                                                placeholder="Улица"
                                                value="<?=$arResult['register_street']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="register_house" class="form__label form__label--required">
                                        <span class="form__label-text">Дом</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="register_house"
                                                id="register_house"
                                                placeholder="Дом"
                                                value="<?=$arResult['register_house']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="register_apartment" class="form__label form__label--required">
                                        <span class="form__label-text">Квартира</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="register_apartment"
                                                id="register_apartment"
                                                placeholder="Квартира"
                                                value="<?=$arResult['register_apartment']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="register_postal_code" class="form__label form__label--required">
                                        <span class="form__label-text">Индекс</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="register_postal_code"
                                                id="register_postal_code"
                                                placeholder="Индекс"
                                                value="<?=$arResult['register_postal_code']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block block_living">
                    <h6 class="box__heading box__heading--small">Адрес проживания</h6>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="living_locality" class="form__label form__label--required">
                                        <span class="form__label-text">Населенный пункт</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="living_locality"
                                                id="living_locality"
                                                placeholder="Населенный пункт"
                                                value="<?=$arResult['living_locality']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="living_street" class="form__label form__label--required">
                                        <span class="form__label-text">Улица</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="living_street"
                                                id="living_street"
                                                placeholder="Улица"
                                                value="<?=$arResult['living_street']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="living_house" class="form__label form__label--required">
                                        <span class="form__label-text">Дом</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="living_house"
                                                id="living_house"
                                                placeholder="Дом"
                                                value="<?=$arResult['living_house']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="living_apartment" class="form__label form__label--required">
                                        <span class="form__label-text">Квартира</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="living_apartment"
                                                id="living_apartment"
                                                placeholder="Квартира"
                                                value="<?=$arResult['living_apartment']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="living_postal_code" class="form__label form__label--required">
                                        <span class="form__label-text">Индекс</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="living_postal_code"
                                                id="living_postal_code"
                                                placeholder="Индекс"
                                                value="<?=$arResult['living_postal_code']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="checkbox">
                                    <input
                                            type="checkbox"
                                            class="checkbox__input"
                                            name="without_living"
                                            id="without_living"
                                        <?=$arResult['without_living'] ? 'checked' : ''?>
                                    >

                                    <label for="without_living" class="checkbox__label">
                                        <span class="checkbox__text">Адрес регистрации совпадает с адресом фактического проживания</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section__box-inner legal_entity" <?=$ticketData['type']['code'] === LegalEntityTable::STATUSES['self_employed'] ? '' : 'hidden'?>>
            <h5 class="box__heading box__heading--middle">Самозанятый</h5>

            <div class="section__box-content box box--white box--rounded-sm box--inner">
                <div class="section__box-block">
                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="tin" class="form__label form__label--required">
                                        <span class="form__label-text">ИНН</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="tin"
                                                id="tin"
                                                placeholder="ИНН"
                                                data-inn
                                                value="<?=$arResult['tin']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия свидетельства о постановке на учет в налоговом органе (ИНН)</h6>

                    <?php foreach ($arResult['tax_registration_certificate'] as $file):?>
                            <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                                <img src="<?=$file['src']?>" style="max-width: 300px;" />
                            <?php else :?>
                                <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                    <span class="button__text">Скачать файл </span>
                                </a>
                            <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Банковские реквизиты</h6>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="bank_name" class="form__label form__label--required">
                                        <span class="form__label-text">Наименование банка</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="bank_name"
                                                id="bank_name"
                                                placeholder="Наименование банка"
                                                value="<?=$arResult['bank_name']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="bic" class="form__label form__label--required">
                                        <span class="form__label-text">БИК</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="bic"
                                                id="bic"
                                                placeholder="БИК"
                                                data-bik
                                                value="<?=$arResult['bic']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="checking_account" class="form__label form__label--required">
                                        <span class="form__label-text">Расчетный счет</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="checking_account"
                                                id="checking_account"
                                                placeholder="Расчетный счет"
                                                value="<?=$arResult['checking_account']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="correspondent_account" class="form__label form__label--required">
                                        <span class="form__label-text">Корреспондентский счет</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="correspondent_account"
                                                id="correspondent_account"
                                                placeholder="Корреспондентский счет"
                                                value="<?=$arResult['correspondent_account']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Сведения о банковских реквизитах</h6>

                    <?php foreach ($arResult['bank_details'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия свидетельства о постановке на учет физического лица в качестве плательщика налога на профессиональный доход</h6>

                    <?php foreach ($arResult['personal_tax_registration_certificate'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>

        <div class="section__box-inner legal_entity" <?=$ticketData['type']['code'] === LegalEntityTable::STATUSES['ltc'] ? '' : 'hidden'?>>
            <h5 class="box__heading box__heading--middle">Общество с ограниченной ответственностью</h5>

            <div class="section__box-content box box--white box--rounded-sm box--inner">
                <div class="section__box-block">
                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ltc_full_name" class="form__label form__label--required">
                                        <span class="form__label-text">Наименование организации (полное)</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="ltc_full_name"
                                                id="ltc_full_name"
                                                placeholder="Наименование организации (полное)"
                                                value="<?=$arResult['ltc_full_name']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ltc_short_name" class="form__label form__label--required">
                                        <span class="form__label-text">
                                            <span class="form__label-text form__label-text--desktop">
                                                Наименование организации (сокращенное)
                                            </span>
                                            <span class="form__label-text form__label-text--mobile">
                                                Наименование организации
                                                <span class="form__label-minitext" data-tippy-content="сокращенное">
                                                    (сокр.)
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="ltc_short_name"
                                                id="ltc_short_name"
                                                placeholder="Наименование организации (сокращенное)"
                                                value="<?=$arResult['ltc_short_name']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ogrn" class="form__label form__label--required">
                                        <span class="form__label-text">ОГРН</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="ogrn"
                                                id="ogrn"
                                                placeholder="ОГРН"
                                                data-ogrn
                                                value="<?=$arResult['ogrn']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="tin" class="form__label form__label--required">
                                        <span class="form__label-text">ИНН</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="tin"
                                                id="tin"
                                                placeholder="ИНН"
                                                data-short-inn
                                                value="<?=$arResult['tin']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="checkbox">
                                    <input
                                            type="checkbox"
                                            class="checkbox__input"
                                            name="nds_payer_ltc"
                                            id="nds_payer_ltc"
                                        <?=$arResult['nds_payer_ltc'] ? 'checked' : ''?>
                                    >

                                    <label for="nds_payer_ltc" class="checkbox__label">
                                        <span class="checkbox__text">Плательщик НДС</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия свидетельства о постановке на учет российской организации в налоговом органе (ИНН)</h6>

                    <?php foreach ($arResult['tax_registration_certificate'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия уведомления о применении УСН упрощенной системы налогоплательщика(в случае применения УСН)</h6>

                    <?php foreach ($arResult['usn_notification'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="kpp" class="form__label form__label--required">
                                        <span class="form__label-text">КПП</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="kpp"
                                                id="kpp"
                                                placeholder="КПП"
                                                data-kpp
                                                value="<?=$arResult['kpp']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия устава ООО</h6>

                    <?php foreach ($arResult['llc_charter'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия протокола участников (решения участника) ООО об избрании руководителя организации</h6>

                    <?php foreach ($arResult['llc_members'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия приказа о вступлнеии в должность генерального директора</h6>

                    <?php foreach ($arResult['ceo_appointment'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия свидетельства о государственной регистрации ООО/листа записи ЕГРЮЛ о внесении записи об ООО в ЕГРЮЛ</h6>

                    <?php foreach ($arResult['llc_registration_certificate'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="form__row">
                    <div class="form__col form__col--full">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="need_proxy" class="form__label form__label--required">
                                    <span class="form__label-text">Право подписи</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="form__control">
                                    <div class="select select--mitigate" data-select>
                                        <select class="select__control" name="need_proxy" id="need_proxy" data-select-control data-placeholder="Выберите право подписи">
                                            <option value="true" <?=$arResult['need_proxy'] === 'true' ? 'selected' : ''?>>У меня есть право подписи документов ООО</option>
                                            <option value="false" <?=$arResult['need_proxy'] === 'false' ? 'selected' : ''?>>У меня нет права подписи документов ООО, я хотел(а) бы добавить уполномоченное лицо</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия доверенности на представителя (в случае подписания представителем-не руководителем ООО)</h6>

                    <?php foreach ($arResult['procuration'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Банковские реквизиты</h6>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="bank_name" class="form__label form__label--required">
                                        <span class="form__label-text">Наименование банка</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="bank_name"
                                                id="bank_name"
                                                placeholder="Наименование банка"
                                                value="<?=$arResult['bank_name']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="bic" class="form__label form__label--required">
                                        <span class="form__label-text">БИК</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="bic"
                                                id="bic"
                                                placeholder="БИК"
                                                data-bik
                                                value="<?=$arResult['bic']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="checking_account" class="form__label form__label--required">
                                        <span class="form__label-text">Расчетный счет</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="checking_account"
                                                id="checking_account"
                                                placeholder="Расчетный счет"
                                                value="<?=$arResult['checking_account']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="correspondent_account" class="form__label form__label--required">
                                        <span class="form__label-text">Корреспондентский счет</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="correspondent_account"
                                                id="correspondent_account"
                                                placeholder="Корреспондентский счет"
                                                value="<?=$arResult['correspondent_account']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Сведения о банковских реквизитах</h6>

                    <?php foreach ($arResult['bank_details'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Адрес организации</h6>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ltc_locality" class="form__label form__label--required">
                                        <span class="form__label-text">Населенный пункт</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="ltc_locality"
                                                id="ltc_locality"
                                                placeholder="Населенный пункт"
                                                value="<?=$arResult['ltc_locality']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ltc_street" class="form__label form__label--required">
                                        <span class="form__label-text">Улица</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="ltc_street"
                                                id="ltc_street"
                                                placeholder="Улица"
                                                value="<?=$arResult['ltc_street']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ltc_address_1" class="form__label form__label--required">
                                        <span class="form__label-text">Дом, корпус, строение</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="ltc_address_1"
                                                id="ltc_address_1"
                                                placeholder="Дом, корпус, строение"
                                                value="<?=$arResult['ltc_address_1']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ltc_address_2" class="form__label form__label--required">
                                        <span class="form__label-text">Этаж, помещение, комната</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="ltc_address_2"
                                                id="ltc_address_2"
                                                placeholder="Этаж, помещение, комната"
                                                value="<?=$arResult['ltc_address_2']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ltc_postal_code" class="form__label form__label--required">
                                        <span class="form__label-text">Индекс</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="ltc_postal_code"
                                                id="ltc_postal_code"
                                                placeholder="Индекс"
                                                value="<?=$arResult['ltc_postal_code']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section__box-inner legal_entity" <?=$ticketData['type']['code'] === LegalEntityTable::STATUSES['ip'] ? '' : 'hidden'?>>
            <h5 class="box__heading box__heading--middle">Индивидуальный предприниматель</h5>

            <div class="section__box-content box box--white box--rounded-sm box--inner">
                <div class="section__box-block">
                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ip_name" class="form__label form__label--required">
                                        <span class="form__label-text">Наименование ИП</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="ip_name"
                                                id="ip_name"
                                                placeholder="Наименование ИП"
                                                value="<?=$arResult['ip_name'] ?? "ИП $arResult[last_name] $arResult[first_name] $arResult[second_name]"?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="tin" class="form__label form__label--required">
                                        <span class="form__label-text">ИНН</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="tin"
                                                id="tin"
                                                placeholder="ИНН"
                                                data-inn
                                                value="<?=$arResult['tin']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="checkbox">
                                    <input
                                            type="checkbox"
                                            class="checkbox__input"
                                            name="nds_payer_ip"
                                            id="nds_payer_ip"
                                        <?=$arResult['nds_payer_ip'] ? 'checked' : ''?>
                                    >

                                    <label for="nds_payer_ip" class="checkbox__label">
                                        <span class="checkbox__text">Плательщик НДС</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия свидетельства о постановке на учет в налоговом органе (ИНН)</h6>

                    <?php foreach ($arResult['tax_registration_certificate'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия уведомления о применении УСН упрощенной системы налогоплательщика(в случае применения УСН)</h6>

                    <?php foreach ($arResult['usn_notification'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="ogrnip" class="form__label form__label--required">
                                        <span class="form__label-text">ОГРНИП</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="ogrnip"
                                                id="ogrnip"
                                                placeholder="ОГРНИП"
                                                data-ogrnip
                                                value="<?=$arResult['ogrnip']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Копия свидетельства о государственной регистрации ИП/листа записи ЕГРИП</h6>

                    <?php foreach ($arResult['ip_registration_certificate'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Банковские реквизиты</h6>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="bank_name" class="form__label form__label--required">
                                        <span class="form__label-text">Наименование банка</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="bank_name"
                                                id="bank_name"
                                                placeholder="Наименование банка"
                                                value="<?=$arResult['bank_name']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="bic" class="form__label form__label--required">
                                        <span class="form__label-text">БИК</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="text"
                                                class="input__control"
                                                name="bic"
                                                id="bic"
                                                placeholder="БИК"
                                                data-bik
                                                value="<?=$arResult['bic']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="checking_account" class="form__label form__label--required">
                                        <span class="form__label-text">Расчетный счет</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="checking_account"
                                                id="checking_account"
                                                placeholder="Расчетный счет"
                                                value="<?=$arResult['checking_account']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="correspondent_account" class="form__label form__label--required">
                                        <span class="form__label-text">Корреспондентский счет</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input">
                                        <input
                                                type="number"
                                                class="input__control"
                                                name="correspondent_account"
                                                id="correspondent_account"
                                                placeholder="Корреспондентский счет"
                                                value="<?=$arResult['correspondent_account']?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section__box-block">
                    <h6 class="box__heading box__heading--small">Сведения о банковских реквизитах</h6>

                    <?php foreach ($arResult['bank_details'] as $file):?>
                        <?php if (in_array(strtoupper($file['format']), ['JPEG', 'PNG', 'JPG'])) :?>
                            <img src="<?=$file['src']?>" style="max-width: 300px;" />
                        <?php else :?>
                            <a href="<?=$file['src']?>" target="_blank" class="button button--rounded button--covered button--white-green button--full">
                                <span class="button__text">Скачать файл </span>
                            </a>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>

    <div class="registration__actions registration__actions--inlined registration__actions--separated">
        <div class="registration__actions-col">
            <div class="registration__actions-col">
                <a href="/bitrix/admin/ticket_edit.php?ID=<?=intval($ticketId)?>" class="button button--rounded button--covered button--white-green button--full">
                    <span class="button__text">Вернуться к тикету</span>
                </a>
            </div>
        </div>
    </div>
</div>