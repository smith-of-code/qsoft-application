<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

dump($arResult['ORDERS']);
if (!empty($arResult['ERRORS']['FATAL'])) {
	foreach($arResult['ERRORS']['FATAL'] as $error) {
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED])) {
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}
}
else {
	if (!empty($arResult['ERRORS']['NONFATAL'])) {
		foreach($arResult['ERRORS']['NONFATAL'] as $error) {
			ShowError($error);
		}
	}

    echo $arResult["NAV_STRING"];
}

