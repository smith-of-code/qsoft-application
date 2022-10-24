<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<h3>Уведомления пользователя за последние 30 дней</h3>

<div id="notificationList">
    <div>
        <? foreach ($arResult['NOTIFICATIONS'] as $notification) :?>
            Уведомление:</br>
            Заголовок - <?="\"{$notification['NAME']}\""?><br>
            Текст уведомления - <?="\"{$notification['TEXT']}\""?><br>
            Дата создания уведомления - <?="\"{$notification['DATE']}\""?><br>
            Время отправки уведомления - <?=null?><br>
            Статус уведомления - <?=$notification['STATUS']?><br>
            Ссылка - <?=$notification['LINK']?><br>
        <?endforeach;?>
    </div>
</div>

<button id="button" onclick="loadNotifications()">Показать еще</button>

<script>
    let offset = <?=$arResult['OFFSET']?>;

    function loadNotifications() {
        BX.ajax.runComponentAction('zolo:sale.personal.notifications.list', 'loadNotifications', {
            mode: 'class',
            data: {
                offset: offset,
            }
        }).then(function (response) {
            console.log(response);
            offset = response['data']['OFFSET'];
            attach(response['data']['NOTIFICATIONS']);
        }, function (response) {
            alert("Ошибка при вызове метода компонента-контроллера")
        });
    }

    function attach(notifications) {
        for (let i = 0; i < Object.keys(notifications).length; i++) {
            let div = document.createElement('div');
            div.innerHTML += "Уведомление:" + "<br>";
            div.innerHTML += "Заголовок" + " - " + notifications[i]['NAME'] + "<br>";
            div.innerHTML += "Текст уведомления" + " - " + notifications[i]['TEXT'] + "<br>";
            div.innerHTML += "Дата создания уведомления" + " - " + "null" + "<br>";
            div.innerHTML += "Время отправки уведомления" + " - " + "null" + "<br>";
            div.innerHTML += "Статус уведомления" + " - " + notifications[i]['STATUS'] + "<br>";
            div.innerHTML += "Ссылка" + " - " + notifications[i]['LINK'] + "<br>";
            document.getElementById("notificationList").appendChild(div);
        }
    }

</script>
