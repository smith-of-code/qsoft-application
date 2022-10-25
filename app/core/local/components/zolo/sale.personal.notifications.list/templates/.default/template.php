<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<h3>Уведомления пользователя за последние 30 дней</h3>

<div id="notificationList">
    <div>
        <? foreach ($arResult['NOTIFICATIONS'] as $notification) :?>
            Уведомление:</br>
            Заголовок - <?=$notification['TITLE']?><br>
            Текст уведомления - <?=$notification['TEXT']?><br>
            Дата создания уведомления - <?=$notification['DATE']?><br>
            Время отправки уведомления - <?=$notification['TIME']?><br>
            Статус уведомления - <?=$notification['STATUS']?><br>
            Ссылка - <?=$notification['LINK']?><br>
        <?endforeach;?>
    </div>
</div>

<button id="button" onclick="nextNotifications()">Показать еще</button>
<button id="filterRead" onclick="notificationsFilterRead()">Фильтр: Прочитано</button>
<button id="filterRead" onclick="notificationsFilterNotRead()">Фильтр: Не прочитано</button>
<button id="filterRead" onclick="notificationsFilterReset()">Фильтр: Все уведомления</button>


<script>
    let offset = <?=$arResult['OFFSET']?>;
    let filter = {'day_interval': 30};

    function nextNotifications() {
        loadNotifications({'offset': offset, 'filter': filter});
    }

    function notificationsFilterRead() {
        filter['status'] = 'прочитано';
        loadNotifications({'size': offset, 'filter': filter});
    }

    function notificationsFilterNotRead() {
        filter['status'] = 'не прочитано';
        loadNotifications({'size': offset, 'filter': filter});
    }

    function notificationsFilterReset() {
        filter['status'] = '';
        loadNotifications({'size': offset, 'filter': filter});
    }

    function loadNotifications(parameters) {
        BX.ajax.runComponentAction('zolo:sale.personal.notifications.list', 'loadNotifications', {
            mode: 'class',
            data: {
                parameters: parameters
            }
        }).then(function (response) {
            console.log(response);
            offset = response['data']['OFFSET'];
            if('size' in parameters) {
                replace(response['data']['NOTIFICATIONS'])
            } else {
                attach(response['data']['NOTIFICATIONS'])
            }
        }, function (response) {
            //console.log(response);
            alert("Ошибка при вызове метода компонента-контроллера")
        });
    }

    function replace(notifications) {
        document.getElementById("notificationList").innerHTML = '';
        attach(notifications);
    }

    function attach(notifications) {
        for (let i = 0; i < Object.keys(notifications).length; i++) {
            let div = document.createElement('div');
            div.innerHTML += "Уведомление:" + "<br>";
            div.innerHTML += "Заголовок" + " - " + notifications[i]['TITLE'] + "<br>";
            div.innerHTML += "Текст уведомления" + " - " + notifications[i]['TEXT'] + "<br>";
            div.innerHTML += "Дата создания уведомления" + " - " + notifications[i]['DATE'] + "<br>";
            div.innerHTML += "Время отправки уведомления" + " - " + notifications[i]['TIME'] + "<br>";
            div.innerHTML += "Статус уведомления" + " - " + notifications[i]['STATUS'] + "<br>";
            div.innerHTML += "Ссылка" + " - " + notifications[i]['LINK'] + "<br>";
            document.getElementById("notificationList").appendChild(div);
        }
    }

</script>

<!--
loadNotifications(offset, filter): [NOTIFICATIONS=>[], OFFSET=>] // получить следующую часть уведомлений (пагинация)
loadNotifications(size, filter): [NOTIFICATIONS=>[], OFFSET=>]  // фильтрованные текущие уведомления
Объект фильтра filter не должен быть изменен перед вызовом метода пагинации отфильтрованных ранее данных .
-->
