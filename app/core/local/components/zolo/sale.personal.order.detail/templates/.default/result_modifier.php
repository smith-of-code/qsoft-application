<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Sale\Internals\StatusTable;
use \Bitrix\Main\ORM\Query\Query;

//Формирование имени для свойства заказа - "Кем заказан"
$arResult['DETAIL']['CREATED_BY'] = formUserName($arResult['DETAIL']['CREATED_BY']);

//Получение названия статуса заказа по краткому обозначению (по ID)
$arResult['DETAIL']['ORDER_STATUS'] = getStatusName($arResult['DETAIL']['ORDER_STATUS']);

//Получение пути к картинке товара
foreach($arResult['PRODUCTS'] as &$product) {
    $product['PICTURE'] = CFile::GetPath($product['PICTURE']);
}

/* Получение свойства "Кем заказан" по образцу из ВТЗ:
   Калининнкова А.Ш.
 */
function formUserName(array $user): string
{
    $userName = '';
    if (isset($user['LAST_NAME']) && $user['LAST_NAME']) {
        $userName .= $user['LAST_NAME'];

        if (isset($user['NAME']) && $user['NAME']) {
            $userName .= ' ' . substr($user['NAME'], 0, 1) . '.';
        }

        if (isset($user['SECOND_NAME']) && $user['SECOND_NAME']) {
            $userName .= ' ' . substr($user['SECOND_NAME'], 0, 1) . '.';
        }
    } else {
        $userName = $user['EMAIL'] ?? $user['LOGIN'];
    }

    return $userName;
}

function getStatusName($statusId) {
    $query = StatusTable::query();
    $query->setSelect(['NAME' => 'STATUS_LANG.NAME']);
    $query->where(Query::filter()
        ->where('ID', '=', $statusId));
    $statusName = $query->exec()->fetch();
    return $statusName['NAME'];
}
