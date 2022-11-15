<?php
// Инициализация административного блока, стилей и интерфейса

use Bitrix\Main\Loader;
use Bitrix\Zolo\FormHandler;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
IncludeModuleLangFile(__FILE__);

$adminPage->Init();
$adminMenu->Init($adminPage->aModules);

if (empty($adminMenu->aGlobalMenu)) {
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}

$APPLICATION->SetAdditionalCSS("/bitrix/themes/" . ADMIN_THEME_ID . "/index.css");

$APPLICATION->SetTitle(GetMessage("admin_index_title"));

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

$fields = [];
if (loader::includeModule('zolo') && $_REQUEST['ID'] > 0) {
	$formHandler = (new FormHandler());
	$fields = $formHandler->GetFormData($_REQUEST['ID']);
}dump($fields);
?>
<div>
	<div>
		<?php foreach ($fields as $key => $value): ?>
				<div>
					<hr>
						<?php if ($key == 'USER_INFO'): ?> 
							<b>Информация о пользователе</b>:
							<hr>
							<?=$formHandler->prepareFields($value)?>
						<?php elseif ($key == 'LEGAL_ENTITY'): ?> 
							<b>Юридическая информация</b>:
							<hr>
							<?=$formHandler->prepareFields($value)?>
						<?php elseif ($key == 'REFUND_ORDER'): ?> 
							<b>Информация по возврату товара</b>:
							<hr>
							<?=$formHandler->getOrderInfo($value)?>
						<?php elseif ($key == 'CHANGE_MENTOR'): ?> 
							<b>Информация по смене ментора</b>:
							<hr>
							<?=$formHandler->getMentorInfo($value)?>
						<?php else: ?> 
							<b>Иная информация</b>:
							<hr>
						<?php endif; ?>
				</div>
		<?php endforeach; ?>
	</div>
	<hr>
	<div>
		<a href="/bitrix/admin/ticket_edit.php?ID=<?= $_REQUEST['ID'] ?>&lang=<?= LANG ?>">
			<-- Вернуться в тикет
		</a>
	</div>
	<br>
	<br>
</div>