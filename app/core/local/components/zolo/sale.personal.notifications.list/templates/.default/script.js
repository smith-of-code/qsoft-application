  window.onload = function () {
        let moreNotificationsButton = document.querySelector('.notifications__button-more');
        moreNotificationsButton.addEventListener('click', function () {
            limit = BASE_LIMIT;
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
        })
}

function attach(notifications) {
    for (let i = 0; i < Object.keys(notifications).length; i++) {
        //установить цвет уведомления
        let item = document.querySelector('.cards-notify__item').cloneNode(true).getElement();
        let noteItemElement = item.querySelector('.card-notify');
        noteItemElement.className = "";
        let colorClass = "card-notify--" + notifications[i]['STATUS'] === "прочитано" ? "green" : "orange";
        noteItemElement.classList.add(["cards-notify__item", colorClass]);
        //добавить данные уведомления
        item.querySelector('.card-notify__title').innerHTML = notifications[i]['TITLE'];
        item.querySelector('.card-notify__message').innerHTML = notifications[i]['MESSAGE'];
        item.querySelector('.card-notify__send-date').innerHTML = notifications[i]['DATE'];
        item.querySelector('.card-notify__send-time').innerHTML = notifications[i]['TIME'];
        item.querySelector('.card-notify__status-text').innerHTML = notifications[i]['STATUS'];
        document.querySelector('.notifications__list').appendChild(item);
        /*
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
         */
    }
}
