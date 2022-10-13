let addonsIdx = 0,
    BITRIX_AJAX = '/bitrix/services/main/ajax.php?',
    query = {
        c: 'zolo:main.profile',
        mode: 'class',
    };


$(document).on("submit", "#user_info", function (e) {
    e.preventDefault();
    query.action = 'userInfoUpdate';
    $.ajax({
        url: BITRIX_AJAX + $.param(query, true),
        method: 'POST',
        cache: false,
        data: {form: $("#user_info").serializeArray()},
        success: function (response) {
            if (response.status === 'success') {
                location.reload();
            }
        }
    });
});

$(document).on("submit", "#legal_entity", function (e) {
    e.preventDefault();
    query.action = 'legalEntityUpdate';
    $.ajax({
        url: BITRIX_AJAX + $.param(query, true),
        method: 'POST',
        cache: false,
        data: {form: $("#legal_entity").serializeArray()},
        success: function (response) {
            if (response.status === 'success') {
                location.reload();
            }
        }
    });
});

// TODO: переключатель для инпута выбора породы, разобраться почему формдата не улетает
$(document).on("submit", "[data-pet-item]", function (e) {
    e.preventDefault();
    query.action = 'savePet';
    let item = $(this.closest('[data-pet-item]')),
        id = item.attr('id');

    const petName = item.find('[name="UF_NAME"]').val().trim();
    const petGender = item.find('[name="UF_GENDER"]').find(':selected').val().trim();
    const petKind = item.find('[name="UF_KIND"]').find(':selected').val().trim();
    const petBirth = item.find('[name="UF_BIRTHDATE"]').val().trim();
    const petCatBreed = item.find('[name="UF_CAT_BREED"]').find(':selected').val().trim();
    const petDogBreed = item.find('[name="UF_DOG_BREED"]').find(':selected').val().trim();

    let formData = {
        ID: id,
        UF_NAME: petName,
        UF_GENDER: petGender,
        UF_KIND: petKind,
        UF_BIRTHDATE: petBirth,
        UF_CAT_BREED: petCatBreed,
        UF_DOG_BREED: petDogBreed
    };


    if (id == 0) {
        query.action = 'addPet';
    } else {
        query.action = 'changePet';
    }

    $.ajax({
        url: BITRIX_AJAX + $.param(query, true),
        method: 'POST',
        cache: false,
        data: {form: formData},
        success: function (response) {
            if (response.status === 'success') {
                location.reload();
                // if ('pet-id' in response['data']) {
                //     item.attr('id', response['data']['id']);
                // }
            }
        }
    });
});

$(document).on("click", "[add-pet]", function () {
    let list = $('[data-pet-list]');

    list.prepend(createRow);
});

$(document).on("click", "[delete-pet]", function () {
    let item = $(this.closest('[data-pet-item]')),
        id = item.attr('id');

    if (id) {
        query.action = 'deletePet';

        $.ajax({
            url: BITRIX_AJAX + $.param(query, true),
            method: 'POST',
            data: {
                id: id,
            },
            success: function (response) {
                if (response['status'] === "success" && response['data']['deleted']) {
                    item.remove();
                }
            }
        });
    } else {
        item.remove();
    }
});

function createRow() {
    const optionsKind = $('[data-kind-name-list]').html()
    const optionsGender = $('[data-gender-name-list]').html()
    const optionsCatBreed = $('[data-cat-name-list]').html()
    const optionsDogBreed = $('[data-dog-name-list]').html()

    let newPriceElement = `
    <li data-pet-item id="0">
        <form action="">
            <div style="background: whitesmoke; margin:5px">
                <div style="background: lightgrey; margin:5px">
                    Тип питомца:<select name="UF_KIND" id="UF_KIND-${addonsIdx}-new">
                        <option disabled selected></option>
                        ${optionsKind}
                    </select>
                    Пол:<select name="UF_GENDER" id="UF_GENDER-${addonsIdx}-new">
                        <option disabled selected></option>
                        ${optionsGender}
                    </select>
                    Дата рождения: <input type="text" name="UF_BIRTHDATE"><br>
                    Породы кошек:<select name="UF_CAT_BREED" id="UF_CAT_BREED-${addonsIdx}-new">
                        <option disabled selected></option>
                        ${optionsCatBreed}    
                    </select>
                    Породы собак:<select name="UF_DOG_BREED" id="UF_DOG_BREED-${addonsIdx}-new">
                        <option disabled selected></option>
                        ${optionsDogBreed}    
                    </select>
                    Кличка: <input type="text" name="UF_NAME"><br>
                </div>
                <button delete-pet>Удалить</button>
                <button style="background: darkgreen" save-pet>Сохранить</button>
            </div>
        </form>
    </li>`;
    addonsIdx++;

    return newPriceElement;
}