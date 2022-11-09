<?php

\Bitrix\Main\Loader::registerAutoLoadClasses('zolo', [
    'Bitrix\Zolo\FormHandler' => 'lib/FormHandler.php',
    'Bitrix\Zolo\TicketHelper' => 'lib/TicketHelper.php',
]);

$arConfig = [
    'zolo' => [
        'css' => '/bitrix/css/zolo/style.css',
        'rel' => ['jquery'],
    ],
];

foreach ($arConfig as $ext => $arExt) {
    CJSCore::RegisterExt($ext, $arExt);
}
CJSCore::Init(array_keys($arConfig));

