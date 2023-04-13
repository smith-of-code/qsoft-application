<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$arTemplateParameters = [
    'BREADCRUMB_ACTIVATE' => [
        'TYPE' => 'STRING',
        'MULTIPLE' => 'N',
        'DEFAULT' => 0,
        'NAME' => GetMessage('BREADCRUMB_ACTIVATE'),
    ],	
];