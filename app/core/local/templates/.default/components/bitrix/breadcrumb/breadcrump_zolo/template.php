<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
if (empty($arResult)) {
    return "";
}
$strReturn = '';
$strReturn .= '<div class="breadcrumbs">';
$strReturn .= '<ul class="breadcrumbs__list">';
    foreach ($arResult as $item) {
        if (!next($arResult)) {
            $strReturn .= '<li class="breadcrumbs__item breadcrumbs__item--active">';
            $strReturn .=   '<a class="breadcrumbs__link">';
            $strReturn .=       $item["TITLE"];
            $strReturn .=   '</a>';
            $strReturn .= '</li>';
        } else {
            if (!$arParam['UNEXIST_URL']) {
                $strReturn .= '<li class="breadcrumbs__item">';
                $strReturn .=   '<a href="#" class="breadcrumbs__link">';
                $strReturn .=       $item["TITLE"];
                $strReturn .=   '</a>';
                $strReturn .= '</li>';
            }
        }
    }
$strReturn .= '</ul>';
$strReturn .= '</div>';

return $strReturn;
?>