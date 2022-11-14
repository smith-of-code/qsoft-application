let offset, limit, isLast;
const PERIOD = 30;
let filter = {'period': PERIOD};

window.onload = function () {
    //Выполнить пагинацию по клику на кнопке "Показать больше"
    document.querySelector('.notifications__button-more').addEventListener('click', loadNotifications);

    //Выполнить чтение уведомления по клику на уведомление
    let notificationRedirectAnchor = document.querySelectorAll('.card-notify__link');
    for (let i = 0; i < notificationRedirectAnchor.length; i++) {
        notificationRedirectAnchor[i].addEventListener('click', readNotification);
    }
}

//Получение уведомлений (пагинация)
function loadNotifications() {
    BX.ajax.runComponentAction('zolo:sale.personal.notifications.list', 'loadNotifications', {
        mode: 'class',
        data: {
            offset: offset,
            limit: limit,
            filter: filter
        }
    }).then(function (response) {
        attach(response['data']['NOTIFICATIONS']);
        offset = response['data']['OFFSET'];
        if (response['data']['LAST']) {
            hideShowMoreButton();
        }
    }, function (response) {
        console.log(response);
    });
}

//Присоединение полученных уведомлений
function attach(notifications) {
    for (let i = 0; i < notifications.length; i++) {
        //установить цвет уведомления
        let item = notifications[i];
        let addition = document.querySelector('.cards-notify__item').cloneNode(true);
        let noteItemElement = addition.querySelector('.card-notify');
        noteItemElement.className = "";
        let color = 'card-notify--' + (notifications[i]['STATUS'] === "Прочитано" ? "green" : "orange");
        noteItemElement.classList.add("card-notify", color);
        //добавить данные уведомления
        addition.querySelector('.card-notify__title').innerHTML = item['TITLE'];
        addition.querySelector('.card-notify__text').innerHTML = item['MESSAGE'];
        addition.querySelector('.card-notify__send-date').innerHTML = item['DATE'];
        addition.querySelector('.card-notify__send-time').innerHTML = item['TIME'];
        addition.querySelector('.card-notify__status-text').innerHTML = item['STATUS'];
        let notificationRedirectAnchor = addition.querySelector('.card-notify__link');
        notificationRedirectAnchor.setAttribute('href', item['LINK']);
        notificationRedirectAnchor.setAttribute('id', item['ID']);
        notificationRedirectAnchor.addEventListener('click', readNotification);
        document.querySelector('.notifications__list').appendChild(addition);
    }
}

//Прочитать уведомление
function readNotification(redirectEvent) {
    BX.ajax.runComponentAction('zolo:sale.personal.notifications.list', 'readMessage', {
        mode: 'class',
        data: {
            notificationId: redirectEvent.target.id
        }
    });
}

function hideShowMoreButton() {
    document.querySelector('.notifications__button-more').style.display = 'none';
}

