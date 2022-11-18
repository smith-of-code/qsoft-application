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
        addition.querySelector('.card-article__banner-image').setAttribute('href', item['PICTURE']);
        addition.querySelector('.card-article__title').innerText = item['NAME'];
        addition.querySelector('.card-article__text').innerText = item['PREVIEW_TEXT'];
        addition.querySelector('.card-article__send').innerHTML = item['PUBLISHED_AT'];
        addition.querySelector('.card-article__link').setAttribute('href', item['DETAIL_URL']);
        setMarker(item, addition);
        document.querySelector('.cards-article__list').appendChild(addition);
    }
}

function setMarker(item, element = document) {
    let marker = element.querySelector('.card-article__label');
    marker.innerText = item['MARKER_NAME'];
    marker.className = "card-article__label label label--secondary";
    marker.classList.add("label--" + item['MARKER_COLOR']);
}

function hideShowMoreButton() {
    document.querySelector('.common-button').style.display = 'none';
}
