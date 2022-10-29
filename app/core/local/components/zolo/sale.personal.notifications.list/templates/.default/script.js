
function nextNotifications() {
    limit = BASE_LIMIT;
    loadNotifications();
}

function filterNotifications(status) {
    filter['status'] = status;
    limit = Math.max(limit, offset);
    offset = 0;
    loadNotifications();
}

function loadNotifications() {
    BX.ajax.runComponentAction('zolo:sale.personal.notifications.list', 'loadNotifications', {
        mode: 'class',
        data: {
            offset: offset,
            limit: limit,
            filter: filter
        }
    }).then(function (response) {
        console.log(response);
        if(offset === 0) {
            replace(response['data']['NOTIFICATIONS']);
        } else {
            attach(response['data']['NOTIFICATIONS']);
        }
        offset = response['data']['OFFSET'];
    }, function (response) {
        //console.log(response);
        alert("Ошибка при вызове метода компонента-контроллера")
    });
}

//прочитать уведомление
function readMessage() {
    let notificationId = document.getElementById("notificationIdInput").value;
    BX.ajax.runComponentAction('zolo:sale.personal.notifications.list', 'readMessage', {
        mode: 'class',
        data: {
            notificationId: notificationId
        }
    }).then(function (response) {
        console.log(response);
        let status = document.getElementById(notificationId);
        status.innerHTML = "Статус уведомления: " + response['data']['status'];
    }, function (response) {
        console.log(response);
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
        // div.setAttribute("id", notifications[i]['ID'] + "_div");
        div.innerHTML += "Уведомление:" + "<br>";
        div.innerHTML += "ID" + " - " + notifications[i]['ID'] + "<br>";
        div.innerHTML += "Заголовок" + " - " + notifications[i]['TITLE'] + "<br>";
        div.innerHTML += "Текст уведомления" + " - " + notifications[i]['MESSAGE'] + "<br>";
        div.innerHTML += "Дата создания уведомления" + " - " + notifications[i]['DATE'] + "<br>";
        div.innerHTML += "Время отправки уведомления" + " - " + notifications[i]['TIME'] + "<br>";
        //div.innerHTML += "Статус уведомления" + " - " + notifications[i]['STATUS'] + "<br>";
        div.innerHTML += "Ссылка" + " - " + notifications[i]['LINK'] + "<br>";

        let notificationStatus = document.createElement('span');
        notificationStatus.innerHTML = "Статус уведомления" + " - " + notifications[i]['STATUS'] + "<br>";
        notificationStatus.setAttribute('id', notifications[i]['ID']);
        div.appendChild(notificationStatus);

        document.getElementById("notificationList").appendChild(div);
    }
}