<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Service\GeoIp;

$geolocation = GeoIp\Manager::getDataResult('95.31.209.94', "ru");
CUtil::InitJSCore(array('window'));
//var_dump(\Bitrix\Sale\Location\GeoIp::getLocationId($ip, $lang));
?>

    <?php
    Bitrix\Main\Loader::includeModule('sale');
    $db_vars = CSaleLocation::GetList(
        array(
            "SORT" => "ASC",
            "COUNTRY_NAME_LANG" => "ASC",
            "CITY_NAME_LANG" => "ASC"
        ),
        array("LID" => LANGUAGE_ID),
        false,
        false,
        array()
    );

    $cities = [];

    while ($vars = $db_vars->Fetch()) {
        if ($vars["CITY_NAME"]) {
            $cities[] = $vars;
        }
    }

    $currentCityIndex = array_search($geolocation->getGeoData()->cityName, array_column($cities, 'CITY_NAME'));
    if ($currentCityIndex){
        $currentCityId = $cities[$currentCityIndex]['ID'];
    }

   ?>

<div class="geolocation__city">
    <img class="geolocation__icon" src="/local/templates/.default/images/icons/geolocation.svg"
         alt="">
    <span><?= $geolocation->getGeoData()->cityName ?></span>

</div>

<script>

    class geolocation_popup {

        popup = null
        currentCityId = '<?= $currentCityId ?>'
        inputSearchCity = null
        cities = <?=json_encode($cities, JSON_UNESCAPED_UNICODE) ?>

        render=()=>{
            return `

            <h3 class="geolocation__header">
                Выберите город
            </h3>

            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" name="city_name_search" value="" placeholder="Ваш город">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="geolocation__city-list"></div>`
        }

        renderCityList = (cities)=>{
            let result =``
            this.filterCity(cities).forEach((e) => {
                result += `
                    <div class="radio-green">
                        <label class="radio-green__label" for="city">${e.CITY_NAME}<small class="radio-green__small">${e.REGION_NAME}</small></label>
                        <input class="radio-green__input" type="radio" name="city" value="${e.ID}" ${e.ID===this.currentCityId?'checked':''}>
                    </div>
                    `
            })
            document.querySelector('.geolocation__city-list').innerHTML = result
        }

        filterCity = (in_cities)=>{
            let result = []
            in_cities.forEach(e=>{
                if(!this.inputSearchCity || !this.inputSearchCity.value || e.CITY_NAME.toLowerCase().includes(this.inputSearchCity.value.toLowerCase())){
                    result.push(e)
                }
            })
            return result
        }

        init=()=>{


                <?php
                Bitrix\Main\Loader::includeModule('sale');
                $db_vars = CSaleLocation::GetList(
                    array(
                        "SORT" => "ASC",
                        "COUNTRY_NAME_LANG" => "ASC",
                        "CITY_NAME_LANG" => "ASC"
                    ),
                    array("LID" => LANGUAGE_ID),
                    false,
                    false,
                    array()
                );

                $cities = [];
                while ($vars = $db_vars->Fetch()) {
                    if ($vars["CITY_NAME"]) {
                        $cities[] = $vars;
                    }
                }

                ?>



                this.popup = new BX.CDialog({

                    'content': this.render(),

                    //   'content_post': this.JSParamsToPHP(arParams, 'PARAMS')+ '&' +

                    //  this.JSParamsToPHP(arProp, 'PROP')+'&'+this.SESS,
                    'width': 451,
                    'height': 725,

                    'draggable': false,

                    'resizable': false,
                });

                this.popup.DIV.classList.add('modal2')

                BX.addCustomEvent(this.popup, 'onWindowRegister',()=>{  // событие возникает после открытия окна, но до его выравнивания


                    this.renderCityList(this.cities)
                    this.popup.DIV.querySelector("[name='city_name_search']").addEventListener('input',(event)=>{
                        this.inputSearchCity = event.target
                        this.renderCityList(this.cities)

                    })


                });

                BX.addCustomEvent(this.popup, 'onWindowUnRegister',()=>{  // событие возникает после открытия окна, но до его выравнивания
                    this.popup.DIV.remove()
                    this.popup.OVERLAY.remove()
                });




                this.popup.Show();
                this.popup.ELEMENTS.close[0].classList.add('modal2__close')
                // popup.DIV.before(popup.ELEMENTS.close[0])
                this.popup.DIV.style.position = 'fixed'
                this.popup.DIV.style.zIndex = 99999
                this.popup.OVERLAY.style.zIndex = 99998



            console.log(this)
        }


    }

    document.querySelector(".geolocation__city").addEventListener('click', () => {
        (new geolocation_popup()).init()
    })

</script>