<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 */
dump($arResult);

?>

<div>
    <h2>Детали заказа:</h2>
    <p>Заказ от <?=$arResult['DETAIL']['CREATED_AT']?></p>
    <p>#<?=$arResult['DETAIL']['ID']?></p>
    <p>Кем заказан: <?=$arResult['DETAIL']['CREATED_BY']?></p>
    <p>Статус заказа: <?=$arResult['DETAIL']['STATUS_NAME']?> (<?=$arResult['STATUS_COLOR']?>)</p>
    <p>Статус оплаты: <?=$arResult['DETAIL']['IS_PAID'] ? 'Не' : ''?> оплачен</p>
    <p>Персональная акция: <?=$arResult['DETAIL']['VOUCHER_USED'] ? 'Да' : 'Нет'?></p>
    <p>Общая сумма: <?=$arResult['DETAIL']['TOTAL_PRICE']?></p>

    <div>
        <h2>Товары:</h2>
        <?php foreach ($arResult['PRODUCTS'] as $item): ?>
                <p>Название: <?=$item['NAME']?></p>
                <p>Артикул: <?=$item['ARTICLE']?></p>
                <p>Цена: <?=$item['PRICE']?></p>
                <p>Количество: <?=$item['QUANTITY']?></p>
                <p>Пикча: <?=$item['PICTURE']['SRC']?></p>
        <?php endforeach; ?>
    </div>
</div>

