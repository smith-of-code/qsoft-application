<?php

use Bitrix\Zolo\TicketHelper;

/**
 * @var $adminPage
 * @var $adminMenu
 * @var $APPLICATION
 */

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
    die();
}

$ticketData = (new TicketHelper)->getTicketData($ticketId);?>

<div>
    Заявка[<?=$ticketId?>] на смену персональных данных <a href="/bitrix/admin/user_edit.php?ID=<?=$ticketData['id']?>">пользователя[<?=$ticketData['id']?>]</a>:

    <?php if ($ticketData['photo']):?>
        <div>
            <p>Персональное фото:</p>
            <img src="<?=$ticketData['photo']?>"  alt="Персональное фото"/>
        </div>
    <?php endif;?>

    <ul>
        <?php if ($ticketData['first_name']):?>
            <li>
                <p>Имя: <?=$ticketData['first_name']?></p>
            </li>
        <?php endif;?>
        <?php if ($ticketData['last_name']):?>
            <li>
                <p>Фамилия: <?=$ticketData['last_name']?></p>
            </li>
        <?php endif;?>
        <?php if ($ticketData['second_name']):?>
            <li>
                <p>Отчество: <?=$ticketData['second_name']?></p>
            </li>
        <?php endif;?>
        <?php if ($ticketData['gender']):?>
            <li>
                <p>Пол: <?=$ticketData['gender']?></p>
            </li>
        <?php endif;?>
        <?php if ($ticketData['birthdate']):?>
            <li>
                <p>Дата рождения: <?=$ticketData['birthdate']?></p>
            </li>
        <?php endif;?>
        <?php if ($ticketData['email']):?>
            <li>
                <p>E-mail: <?=$ticketData['email']?></p>
            </li>
        <?php endif;?>
        <?php if ($ticketData['phone']):?>
            <li>
                <p>Номер телефона: <?=$ticketData['phone']?></p>
            </li>
        <?php endif;?>
        <?php if ($ticketData['city']):?>
            <li>
                <p>Населенный пункт: <?=$ticketData['city']?></p>
            </li>
        <?php endif;?>
        <?php if ($ticketData['pickup_point']):?>
            <li>
                <p>Пункт выдачи заказов: <?=$ticketData['pickup_point']?></p>
            </li>
        <?php endif;?>
    </ul>

    <a href="/bitrix/admin/ticket_edit.php?ID=<?=$ticketId?>">
        <-- Вернуться в тикет
    </a>
</div>