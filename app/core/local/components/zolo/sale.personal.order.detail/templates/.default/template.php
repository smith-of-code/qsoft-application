<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 */
dump($arResult);

function color()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
?>

<div>
    <p>Заказ от <?=$arResult['CREATED_AT']?></p>
    <p>#<?=$arResult['ID']?></p>
    <p>Кем заказан: <?=$arResult['CREATED_BY']?></p>
    <p>Статус заказа: <?=$arResult['STATUS_NAME']?> (<?=$arResult['STATUS_COLOR']?>)</p>
    <p>Статус оплаты: <?=$arResult['IS_PAID'] ? 'Не' : ''?> оплачен</p>
    <p>Персональная акция: <?=$arResult['VOUCHER_USED'] ? 'Да' : 'Нет'?></p>
    <p>Общая сумма: <?=$arResult['TOTAL_PRICE']?></p>

    <div>
        <p>Итемы:</p>
        <?php foreach ($arResult['ITEMS'] as $item): ?>
            <article style="background-color: <?=color()?>">
                <p>Название: <?=$item['NAME']?></p>
                <p>Артикул: <?=$item['ARTICLE']?></p>
                <p>Цена: <?=$item['PRICE']?></p>
                <p>Количество: <?=$item['QUANTITY']?></p>
                <p>Пикча: <?=$item['PICTURE']['SRC']?></p>
            </article>
        <?php endforeach; ?>
    </div>
</div>
