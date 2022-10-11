<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle("Test");
?>

<h4>Задача</h4>
Состав "новости":</br>
-Заголовок -        "NAME"</br>
-Краткое описание - "PREVIEW_TEXT"</br>
-Картинка -         "DETAIL_PICTURE"</br>
-Маркер -           "MARKER"</br>
<h4>Тест</h4>
Массив данных: $arResult['NEWS']</br>
Кол-во элементов (новостей): <?=count($arResult['NEWS'])?></br>
Ключи элементов: <pre><?=print_r(array_keys($arResult['NEWS'][0]), true)?></pre></br>
Элемент:
<table>
    <tr>
        <?php foreach($arResult['NEWS'][3] as $key => $value) : ?>
            <td><?="|" . ($value ?? "НЕТ ЗНАЧЕНИЯ ДЛЯ КЛЮЧА" . $key) . "|"?></td>
        <?php endforeach;?>
    </tr>
</table>
<?php

