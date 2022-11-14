let offset, limit;
const PERIOD = 30;
let filter = {'period': PERIOD};

window.onload = function () {
    //Выполнить чтение уведомления по клику на уведомление
    let notificationRedirectAnchor = document.querySelectorAll('.status__link');
    for (let i = 0; i < notificationRedirectAnchor.length; i++) {
        notificationRedirectAnchor[i].addEventListener('click', readNotification);
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
