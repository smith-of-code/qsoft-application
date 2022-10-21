<?php
// Инициализация административного блока, стилей и интерфейса

use Bitrix\Main\Loader;
use Bitrix\zolo\FormHandler;

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
}
?>
<div>
	<div>
		<?php foreach ($fields as $key => $value): ?>
				<div>
					<hr>
						<b><?=$key == 'USER_INFO' ? 'Информация о пользователе' : 'Юридическая информация'?></b>: 
					<hr>
					<?=$formHandler->prepareFields($value)?>
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