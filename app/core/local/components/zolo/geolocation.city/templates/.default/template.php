<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Service\GeoIp;

$ip ='95.31.209.94';
//$ip ='';
$lang = 'ru';

$geolocation = GeoIp\Manager::getDataResult($ip, $lang);

$geolocationId = \Bitrix\Sale\Location\GeoIp::getLocationId($ip, $lang);



CUtil::InitJSCore(array('window'));
//var_dump(\Bitrix\Sale\Location\GeoIp::getLocationId($ip, $lang));
?>



<?//$APPLICATION->IncludeComponent("bitrix:map.yandex.system", ".default", array(
//        "KEY" => "",
//        "INIT_MAP_TYPE" => "SATELLITE",
//        "MAP_WIDTH" => "800",
//        "MAP_HEIGHT" => "500",
//        "CONTROLS" => array(
//            0 => "TOOLBAR",
//            1 => "ZOOM",
//            2 => "MINIMAP",
//            3 => "TYPECONTROL",
//            4 => "SCALELINE",
//        ),
//        "OPTIONS" => array(
//            0 => "ENABLE_SCROLL_ZOOM",
//            1 => "ENABLE_DBLCLICK_ZOOM",
//            2 => "ENABLE_DRAGGING",
//            3 => "ENABLE_HOTKEYS",
//        ),
//        "MAP_ID" => "testmap"
//    )
//);
//?>

<?php
\Bitrix\Main\UI\Extension::load("ui.vue3");
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
    $('.geolocation__city').fancybox({
        baseClass : 'modal',
        src: `<article id="technical-support" class="modal modal--wide2 box box--circle box--hanging modal-geolocation" style="display: none" data-support>
        <div class="modal__content" data-support-content>
        <div id="geolocation"></div>
    </div>
    </article>
    `,
        type: "html",
        btnTpl: {
            smallBtn: `<div data-fancybox-close class="fancybox-close"><svg class="fancybox-close-icon icon icon--close-square" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.17004 14.83L14.83 9.17001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M14.83 14.83L9.17004 9.17001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21.9997H15C20 21.9997 22 19.9997 22 14.9997V8.99973C22 3.99973 20 1.99973 15 1.99973H9C4 1.99973 2 3.99973 2 8.99973V14.9997C2 19.9997 4 21.9997 9 21.9997Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>`,
        },
        beforeShow: function() {
            const bitrixPanel = document.querySelector('#bx-panel');
            offset = $(window).scrollTop();

            $('.fancybox-active').css('position', 'fixed');
            $('body').css('top', `${-offset}px`);
            $('header').css('top', bitrixPanel ? `${bitrixPanel.offsetHeight}px` : '0px');
        },
        beforeClose: function() {
            $('.fancybox-active').css('position', '');
            $('.fancybox-active').css('top', '');
            $('header').css('top', '');
            $('html').scrollTop(offset);
        },

        afterShow: function (){
            BX.Vue3.BitrixVue.createApp({
                components: {  },

                data() {
                    return {
                        cityId:'<?= $geolocationId ?>',
                        inputSearchCity:'',
                        tabs:[
                            {
                                name:'tab1',
                                title:'Куда доставить ваш заказ?',
                                isActive:true
                            },
                            {
                                name:'tab2',
                                title:'Выберите город',
                                isActive:false
                            },
                            {
                                name:'tab3',
                                title:'Укажите ваш адрес для доставки заказов',
                                isActive:false
                            }
                        ],
                        place:{
                            address:'',
                            flat:'',
                            index:'',
                            entry:'',
                            housepin:'',
                            floor:'',
                        },
                        searchResult:[]
                    };
                },

                props: {
                    cities: {
                        type: Array,
                        default:<?=json_encode($cities, JSON_UNESCAPED_UNICODE) ?>,
                        required: false,
                    },
                },

                computed: {
                    filterCity (){
                        let result = []
                        this.cities.forEach(e=>{
                            if(!this.inputSearchCity || !this.inputSearchCity || e.CITY_NAME.toLowerCase().startsWith(this.inputSearchCity.toLowerCase())){
                                result.push(e)
                            }
                        })
                        return result
                    },
                    activeTab(){
                        return this.tabs.find(e=>e.isActive)
                    },
                    activeCity(){
                        return this.cities.find(e=>this.cityId === e.ID)
                    },


                },

                created() {

                },

                mounted() {
                    console.log(this.defaultCityId)
                },

                methods: {
                    setActiveTab(name){
                            this.tabs.forEach(e=> {
                                if (e.name !== name){
                                    e.isActive = false
                                }else {
                                    e.isActive = true
                                }
                            })

                    },
                    fillPlace(place){
                        this.place.address = place.value
                    },
                    setCity(city){
                        this.cityId = city.ID
                        this.setActiveTab('tab1')
                    },
                    isSelectedCity(city){
                        return city.ID === this.cityId
                    },

                    async saveCity(){
                        // prominado – префикс партнера, отделяется двоеточием
// module – название модуля
// api – приставка из .settings.php
// updater.apply – название класса и метода без постфикса Action

                        BX.ajax.runAction('wizandr:geolocation.usercity.add',{data:{
                            place:'валаби 42 сидней'
                            }})
                            .then(function() {
                                // Код после выполнения экшена
                            });
                        // const response = await BX.ajax.runAction('wizandr:geolocation.Item.add', {
                        //     data: {
                        //        dsdsd:332323
                        //     }
                        // }).then((response) => response.data)
                    }
                },
                watch:{
                    'place.address'(newVal){
                        if (newVal.length > 3){
                            BX.ajax.runAction('wizandr:geolocation.usercity.dadata',{data:{
                                    query:newVal
                                }})
                                .then((res)=> {
                                    this.searchResult = res.data
                                    // Код после выполнения экшена
                                });
                        }

                    }

                },

                template: `

        <header class="modal__section modal__section--header ">
            <h3 class="geolocation__header">{{activeTab.title}}</h3>
        </header>
        <section v-if="activeTab.name === 'tab1'" class="modal__section modal__section--content modal-geolocation__content1" data-scrollbar data-modal-section>
            <img src="/local/templates/.default/images/delivery-box.png" alt="">
            <div class="modal-geolocation__container">
            <div class="modal-geolocation__city">
                <div class="modal-geolocation__curr-city">
                    <img class="modal-geolocation__curr-city-icon" src="/local/templates/.default/images/icons/geolocation-big.svg" alt="">
                    <span class="modal-geolocation__curr-city-text">Ваш город <b>{{activeCity.CITY_NAME}}</b></span>
                </div>
                <p class="modal-geolocation__change-city"
                @click="setActiveTab('tab2')">изменить</p>
            </div>
            <p class="modal-geolocation__message">
                Сохраните ваш адрес, удобный пункт выдачи или постамат, чтобы видеть условия доставки при оформлении заказа
            </p>
            <button type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
                    <b class="button__text" @click="setActiveTab('tab3')">Выбрать на карте</b>
            </button>
            </div>



        </section>



        <section v-else-if="activeTab.name === 'tab2'" class="modal__section modal__section--content" data-scrollbar data-modal-section>
        <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input type="text" class="input__control pr-1" v-model="inputSearchCity"  placeholder="Ваш город">
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="geolocation__city-list">

                <div class="radio-green" v-for="city in filterCity" :key="city">
                    <label class="radio-green__label" for="city">{{city.CITY_NAME}}<small class="radio-green__small">{{city.REGION_NAME}}</small></label>
                    <input class="radio-green__input" type="radio" name="city" @change="setCity(city)" :checked="isSelectedCity(city)" >
                </div>

        </div>
        </section>

        <section v-else-if="activeTab.name === 'tab3'" class="modal__section modal__section--content" data-scrollbar data-modal-section>
            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="address" class="form__label ">
                                <span class="form__label-text">Город, улица, дом</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.address" name="address">
                            </div>
                        </div>
                        <div v-if="searchResult.length && place.address.length > 3" class="form__field-search--result">
                            <p v-for="placeItem in searchResult" @click="fillPlace(placeItem)" >{{placeItem.value}}</p>
                        </div>

                    </div>
                </div>
            </div>


            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="flat" class="form__label ">
                                <span class="form__label-text">Квартира/офис</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.flat" name="flat">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="index" class="form__label ">
                                <span class="form__label-text">Индекс</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.index" name="index">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="entry" class="form__label ">
                                <span class="form__label-text">Подъезд</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.entry" name="entry">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="floor" class="form__label ">
                                <span class="form__label-text">Этаж</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.floor" name="floor">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="housepin" class="form__label ">
                                <span class="form__label-text">Домофон</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.housepin" name="housepin">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <div class="modal-geolocation__container">
            <button type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
                    <b class="button__text" @click="saveCity()">Сохранить адрес</b>
            </button>
        </div>

        </section>

    `
            }).mount('#geolocation');
        },


    });


</script>