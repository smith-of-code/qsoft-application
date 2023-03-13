let offset;

window.onload = function () {
    initTemplateType();
}

function initTemplateType() {
    let type = templateType[IBLOCK_ID];
    document.querySelector('.section__title').innerText = type.title;
    document.querySelector('.common_section').classList.add(type.style + "__section");
    let showMoreButton = document.querySelector('.common-button');
    if (showMoreButton !== null) {
        document.querySelector('.common-button').classList.add(type.style + "__more");
        document.querySelector('.common-button').classList.add(type.style + "__button");
        //Выполнить пагинацию по клику на кнопке "Показать больше"
        showMoreButton.addEventListener('click', loadItems);
    }
}

function loadItems() {
    BX.ajax.runComponentAction('zolo:common.list', 'load', {
        mode: 'class',
        data: {
            offset: offset,
            iblock_id: IBLOCK_ID
        }
    }).then(function (response) {
        console.log(response['status']);
        attach(response['data']['ITEMS']);
        offset = response['data']['OFFSET'];
        if (response['data']['LAST']) {
            hideShowMoreButton();
        }
    }, function (response) {
        console.log(response['data']['errors']);
    });
}

//Присоединение полученных данных
function attach(items) {
    for (let i = 0; i < items.length; i++) {
        let item = items[i];
        let addition = document.querySelector('.cards-article__item').cloneNode(true);
        // Картинка
        addition.querySelector('.card-article__banner-image').setAttribute('href', item['PICTURE']);
        // Заголовок
        addition.querySelector('.card-article__title').innerText = item['NAME'];
        // Анонс
        addition.querySelector('.card-article__text').innerText = item['PREVIEW_TEXT'];
        // Дата публикации
        addition.querySelector('.card-article__send').innerHTML = item['PUBLISHED_AT'];
        // URL детальной страницы
        addition.querySelector('.card-article__link').setAttribute('href', item['DETAIL_URL']);

        // Маркер и цвет нижней полосы
        setMarker(item, addition);
        document.querySelector('.cards-article__list').appendChild(addition);
    }
}

function setMarker(item, element = document) {
    let marker = element.querySelector('.card-article__label');
    let article = element.querySelector('article.card-article');
    marker.innerText = item['MARKER_NAME'];
    marker.className = "card-article__label label label--secondary";
    marker.classList.add("label--" + item['MARKER_COLOR']);
    article.className = "card-article card-article--" + item['MARKER_COLOR'] + " box box--hovering box--circle";
}

function hideShowMoreButton() {
    document.querySelector('.common-button').style.display = 'none';
}
