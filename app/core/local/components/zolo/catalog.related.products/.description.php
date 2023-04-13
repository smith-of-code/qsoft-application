<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

$arComponentDescription = [
	'NAME' => GetMessage('IBLOCK_ELEMENT_TEMPLATE_NAME'),
	'DESCRIPTION' => GetMessage('IBLOCK_ELEMENT_TEMPLATE_DESCRIPTION'),
	'CACHE_PATH' => 'Y',
	'SORT' => 40,
	'PATH' => [
		'ID' => 'content',
		'CHILD' => [
			'ID' => 'catalog',
			'NAME' => GetMessage('T_IBLOCK_DESC_CATALOG'),
			'SORT' => 30
		],
	],
];
