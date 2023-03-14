<?php

/**
 * @var $adminPage
 * @var $adminMenu
 * @var $APPLICATION
 */

use QSoft\Helper\TicketHelper;
use QSoft\ORM\PickupPointTable;

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

$ticketId = $_REQUEST['ID'];

if (!$ticketId) {
    echo 'Не задан ID обращения';
    die();
}

$genders = ['M' => 'Мужской', 'F' => 'Женский'];

$pickupPoints = PickupPointTable::getList([
    'order' => ['UF_NAME' => 'ASC'],
    'select' => ['ID', 'UF_NAME'],
])->fetchAll();
$pickupPoints = array_combine(
    array_column($pickupPoints, 'ID'),
    array_column($pickupPoints, 'UF_NAME'),
);

$ticketData = (new TicketHelper)->getTicketData($ticketId);
?>

<div class="registration__form form form--separated form--wraped">
    <div class="registration__box box box--hidden box--grayish box--rounded-sm">
        <div class="registration__box registration__box--small box box--hidden box--white box--rounded-sm">
            <?php if ($ticketData['PERSONAL_PHOTO']):?>
                <div class="form__field-block form__field-block--label">
                    <label for="last_name" class="form__label form__label--required">
                        <span class="form__label-text">Персональное фото</span>
                    </label>
                </div>
                <img src="<?=str_replace($_SERVER['DOCUMENT_ROOT'], '', $ticketData['PERSONAL_PHOTO']['tmp_name'])?>" style="max-width: 300px;">
            <?php endif;?>

            <div class="form__row">
                <div class="form__col">
                    <?php if ($ticketData['LAST_NAME']):?>
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="last_name" class="form__label form__label--required">
                                    <span class="form__label-text">Фамилия</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                            type="text"
                                            class="input__control"
                                            name="last_name"
                                            id="last_name"
                                            value="<?=$ticketData['LAST_NAME']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>

                <div class="form__col">
                    <?php if ($ticketData['NAME']):?>
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="first_name" class="form__label form__label--required">
                                    <span class="form__label-text">Имя</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                            type="text"
                                            class="input__control"
                                            name="first_name"
                                            id="first_name"
                                            placeholder="Введите имя"
                                            value="<?=$ticketData['NAME']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>

            <div class="form__row form__row--centered">
                <div class="form__col">
                    <?php if ($ticketData['SECOND_NAME']):?>
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="second_name" class="form__label form__label--required">
                                    <span class="form__label-text">Отчество</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                            type="text"
                                            class="input__control"
                                            name="second_name"
                                            id="second_name"
                                            placeholder="Введите отчество"
                                            value="<?=$ticketData['SECOND_NAME']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>

            <div class="form__row">
                <div class="form__col">
                    <?php if ($ticketData['PERSONAL_GENDER']):?>
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="gender" class="form__label form__label--required">
                                    <span class="form__label-text">Пол</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="form__control">
                                    <div class="select select--mitigate" data-select>
                                        <select class="select__control" name="gender" id="gender" data-select-control data-placeholder="Выберите пол">
                                            <option><?=$genders[$ticketData['PERSONAL_GENDER']]?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>

                <div class="form__col">
                    <?php if ($ticketData['PERSONAL_BIRTHDAY']):?>
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="birthdate" class="form__label form__label--required">
                                    <span class="form__label-text">Дата рождения</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input input--iconed">
                                    <input inputmode="numeric"
                                           class="input__control"
                                           name="birthdate"
                                           id="birthdate"
                                           placeholder="ДД.ММ.ГГГГ"
                                           data-mask-date-reg
                                           value="<?=$ticketData['PERSONAL_BIRTHDAY']?>"
                                           autocomplete="off"
                                    >
                                    <span class="input__control-error--mask"></span>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>

            <div class="form__row">
                <div class="form__col">
                    <?php if ($ticketData['PERSONAL_CITY']):?>
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="city" class="form__label form__label--required">
                                    <span class="form__label-text">Населенный пункт</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="form__control">
                                    <div class="select select--mitigate" data-select>
                                        <select class="select__control" name="city" id="city" data-select-control data-placeholder="Выберите город">
                                            <option><?=$ticketData['PERSONAL_CITY']?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>

            <div class="form__row">
                <div class="form__col">
                    <?php if ($ticketData['PERSONAL_PHONE']):?>
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="phone" class="form__label form__label--required">
                                    <span class="form__label-text">Телефон</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                            type="tel"
                                            class="input__control"
                                            name="phone"
                                            id="phone"
                                            placeholder="+7 (___) ___-__-__"
                                            data-phone
                                            inputmode="text"
                                            value="<?=$ticketData['PERSONAL_PHONE']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>

                <div class="form__col">
                    <?php if ($ticketData['EMAIL']):?>
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="email" class="form__label form__label--required">
                                    <span class="form__label-text">E-mail</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                            type="text"
                                            class="input__control"
                                            name="email"
                                            id="email"
                                            placeholder="example@email.com"
                                            data-mail
                                            inputmode="email"
                                            value="<?=$ticketData['EMAIL']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>

            <div class="form__row">
                <div class="form__col">
                    <?php if ($ticketData['UF_PICKUP_POINT_ID']):?>
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="pickup_point_id" class="form__label form__label--required">
                                    <span class="form__label-text">Пункт выдачи заказов</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="form__control">
                                    <div class="select select--mitigate" data-select>
                                        <select class="select__control" name="pickup_point_id" id="pickup_point_id" data-select-control data-placeholder="Пункт выдачи заказов">
                                            <option><?=$pickupPoints[$ticketData['UF_PICKUP_POINT_ID']]?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>

        <?php if ($ticketData['OLD_MENTOR_ID']):
        global $USER;
        $checkNewMentor = !empty($USER->GetByID($ticketData['NEW_MENTOR_ID'])->Fetch());
        $oldMenthor = (new TicketHelper)->getMenthorData($ticketData['OLD_MENTOR_ID']);
        $newMenthor = $checkNewMentor ? (new TicketHelper)->getMenthorData($ticketData['NEW_MENTOR_ID']) : null;
        ?>
            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text"><b>Текущий наставник:</b></span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text">ID текущего наставника: <?=$oldMenthor['id']?></span>
                        </div>
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text">ФИО: <?=$oldMenthor['full_name']?></span>
                        </div>
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text">Дата рождения: <?=$oldMenthor['birthdate']?></span>
                        </div>
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text">Email: <?=$oldMenthor['email']?></span>
                        </div>
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text">Телефон: <?=$oldMenthor['phone'] != '' ? $oldMenthor['phone'] : 'Не указан'?></span>
                        </div>
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text">Пол: <?=$genders[$oldMenthor['gender']] ?></span>
                        </div>
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text">Город проживания: <?=$oldMenthor['city'] ?></span>
                        </div>
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text">Консультант: <?=$oldMenthor['is_consultant'] ? 'да': 'нет' ?></span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <span class="form__label-text"><b>Новый наставник:</b></span>
                        </div>
                    </div>
                </div>
                <br>
                <?php if ($newMenthor): ?>
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">ID нового наставника: <?=$newMenthor['id']?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">ФИО: <?=$newMenthor['full_name']?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Дата рождения: <?=$newMenthor['birthdate']?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Email: <?=$newMenthor['email']?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Телефон: <?=$newMenthor['phone'] != '' ? $newMenthor['phone'] : 'Не указан'?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Пол: <?=$genders[$newMenthor['gender']] ?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Город проживания: <?=$newMenthor['city'] ?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Консультант: <?=$newMenthor['is_consultant'] ? 'да': 'нет' ?></span>
                            </div>
                            <?php if (!$newMenthor['is_consultant']): ?>
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <span class="form__label-text"><b>Пользватель не может быть консультантом!</b></span>
                                    </div>
                                </div>
                            <?php endif;?>
                            <br>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Причина смены консультанта: <?=$ticketData['COUSES'] ?></span>
                            </div>
                            <br>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text"><b>Комментарий пользователя:</b> <?=$ticketData['MESSAGE'] ?></span>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text"><b>Пользователь c id <?=$ticketData['NEW_MENTOR_ID']?> не найден!</b></span>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <br>
            </div>
        </div>
        <?php endif;?>

        <?php if ($ticketData['IS_ORDER_REFUND']):
            $order = \CSaleOrder::GetByID($ticketData['ORDER_NUMBER']);
            if ($order):
                $orderStatus = (new TicketHelper)->getOrderStatus($order['STATUS_ID']);
                ?>
                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">ID заказа: <?=$order['ID']?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Владелец заказа: <?=$order['USER_NAME'] . ' ' . $order['USER_LAST_NAME']?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">email: <?=$order['USER_EMAIL']?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Оплачен: <?=$order['PAYED'] == 'Y' ? 'да' : 'нет' ?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Повторный: <?=$order['IS_RECURRING'] == 'Y' ? 'да' : 'нет' ?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Отменен: <?=$order['CANCELED'] == 'Y' ? 'да' : 'нет' ?></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Статус заказа: <?=$orderStatus ?></span>
                            </div>
                            <br>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Комментарий к обращению: <?=$ticketData['MESSAGE'] ?></span>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            <?php else: ?>
                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text"><b>Заказ № <?=$ticketData['ORDER_NUMBER'] ?> не найден!</b></span>
                            </div>
                            <div class="form__field-block form__field-block--label">
                                <span class="form__label-text">Комментарий к обращению: <?=$ticketData['MESSAGE'] ?></span>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            <?php endif;?>
        <?php endif;?>

        <div class="registration__actions registration__actions--inlined registration__actions--separated">
            <div class="registration__actions-col">
                <a href="/bitrix/admin/ticket_edit.php?ID=<?=intval($ticketId)?>" class="button button--rounded button--covered button--white-green button--full">
                    <span class="button__text">Вернуться к тикету</span>
                </a>
            </div>
        </div>
    </div>
</div>