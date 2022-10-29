<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<script>
    window.onload = function () {
        attach(<?=json_encode($arResult['NOTIFICATIONS']);?>)
    }
    let offset = <?=$arResult['OFFSET']?>;
    let filter = {'period': 30};
    let limit = offset;
    const BASE_LIMIT = offset;
</script>

<h3>Уведомления пользователя за последние 30 дней</h3>

<h4><a href="http://p7.zolo.vpool/bitrix/admin/highloadblock_rows_list.php?ENTITY_ID=709&lang=ru" target="_blank">Таблица с уведомлениями в Административной части</a></h4>

<div id="notificationList">

</div>

<button id="button" onclick="nextNotifications()">Показать еще</button>
<button id="filterRead" onclick="filterNotifications('прочитано')">Фильтр: Прочитано</button>
<button id="filterRead" onclick="filterNotifications('не прочитано')">Фильтр: Не прочитано</button>
<button id="filterRead" onclick="filterNotifications('')">Фильтр: Все уведомления</button>
<br>
<br>
<input id="notificationIdInput" type="text"><button id="readMessage" onclick="readMessage()">прочитать уведомление</button>