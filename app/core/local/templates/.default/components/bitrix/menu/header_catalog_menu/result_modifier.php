<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult as $value) {
    $section = explode('/', $value['LINK'])[2];

    if ($value['DEPTH_LEVEL'] == 1) {
        $result[$section] = $value;
        $result[$section]['IMAGE_NAME'] = $section == 'for_dogs' ? 'dog' : 'cat';

        continue;
    }

    $result[$section]['SUBSECTIONS'][] = $value;
}

$arResult = $result;
