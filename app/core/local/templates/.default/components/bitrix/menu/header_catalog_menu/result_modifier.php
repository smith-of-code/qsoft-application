<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$result = [];
foreach ($arResult as $value) {
    if ($value['DEPTH_LEVEL'] > $arParams['MAX_LEVEL']) {
        continue;
    }

    $section = explode('/', $value['LINK'])[2];

    if ($value['DEPTH_LEVEL'] == 1) {
        $result[$section] = $value;
        $result[$section]['IMAGE_NAME'] = $section == 'for_dogs' ? 'dog' : 'cat';

        continue;
    }

    $result[$section]['SUBSECTIONS'][] = $value;
}

foreach ($result as &$section) {
    $section['SUBSECTIONS'][] = [
        'TEXT' => 'Советы экспертов',
        'LINK' => '/info/expert-advice/',
    ];
}

$arResult = $result;
