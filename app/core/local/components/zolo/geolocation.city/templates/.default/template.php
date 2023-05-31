<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Service\GeoIp;

//$ip = '95.31.209.94';
$ip ='';
$lang = 'ru';

$geolocation = GeoIp\Manager::getDataResult($ip, $lang);


$geolocationId = \Bitrix\Sale\Location\GeoIp::getLocationId($ip, $lang);
$geolocationName = $geolocation->getGeoData()->cityName;

$geolocationKladrId = $geolocation->getGeoData()->daData['city_kladr_id'];

$session = \Bitrix\Main\Application::getInstance()->getSession();

if ($session->has('current_city')){
    $geolocationId = $session->get('current_city')['CITY_ID'];
    $geolocationKladrId = $session->get('current_city')['city_kladr_id'];
    $geolocationName = $session->get('current_city')['CITY_NAME'];
}

CUtil::InitJSCore(array('window'));

\Bitrix\Main\UI\Extension::load("zolo.geolocation");

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
global $USER
?>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;coordorder=longlat&amp;apikey=457432fc-6d98-40a8-a99e-66c743f91e8f"
        type="text/javascript"></script>

<div class="geolocation">
    <div class="geolocation__city-btn">
        <img class="geolocation__icon" src="/local/templates/.default/images/icons/geolocation.svg"
             alt="">
        <span id="geolocationName"><?= $geolocationName ?></span>
    </div>
    <div class="geolocation__address-btn">
        <span id="geolocationAddress">Укажите адрес доставки</span>
    </div>
</div>

<script>

    if (localStorage.getItem('ls_v') !== '1'){
        localStorage.clear()
        localStorage.setItem('ls_v','1')
    }

    if(localStorage.getItem('deliveryPlaceAddressShort')){
        $('#geolocationAddress').text(localStorage.getItem('deliveryPlaceAddressShort'))
    }

    if (localStorage.getItem('current_city-name')){
        $('#geolocationName').text(localStorage.getItem('current_city-name'))
    }

    window.geolocation_fancybox = $('.geolocation__city-btn, .geolocation__address-btn').fancybox({
        baseClass: 'modal',
        src: `
    <article class="modal box box--circle box--hanging modal-geolocation" data-support>
        <div class="modal__content" data-support-content>
            <div id="geolocation"></div>
        </div>
    </article>
    `,
        type: "html",
        btnTpl: {
            smallBtn: `<div data-fancybox-close class="fancybox-close"><svg class="fancybox-close-icon icon icon--close-square" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.17004 14.83L14.83 9.17001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M14.83 14.83L9.17004 9.17001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21.9997H15C20 21.9997 22 19.9997 22 14.9997V8.99973C22 3.99973 20 1.99973 15 1.99973H9C4 1.99973 2 3.99973 2 8.99973V14.9997C2 19.9997 4 21.9997 9 21.9997Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>`,
        },
        beforeShow: function () {
            const bitrixPanel = document.querySelector('#bx-panel');
            offset = $(window).scrollTop();

            $('.fancybox-active').css('position', 'fixed');
            $('body').css('top', `${-offset}px`);
            $('header').css('top', bitrixPanel ? `${bitrixPanel.offsetHeight}px` : '0px');
        },
        beforeClose: function () {
            $('.fancybox-active').css('position', '');
            $('.fancybox-active').css('top', '');
            $('header').css('top', '');
            $('html').scrollTop(offset);
            localStorage.setItem('hide_auto_open_geolocation_popup',true)
        },

        afterShow: function (e) {
            let activeTab ='city'
            console.log()
            if(<?=$USER->IsAuthorized()?'false':'true'?> && e.$trigger[0].classList.contains('geolocation__address-btn') && !localStorage.getItem('deliveryPlaceAddressShort')){
                activeTab ='address'
            }
            const taskManager = new BX.GeoLocation('#geolocation',{
                cities:<?=json_encode($cities, JSON_UNESCAPED_UNICODE) ?>,
                currentCityId:<?=$geolocationId?>,
                activeTab,
                currentCityKladrId:'<?=$geolocationKladrId?>',
            });
            taskManager.start();
        },


    });

    <?php if (!$session->has('current_city')): ?>
        if (localStorage.getItem('hide_auto_open_geolocation_popup') !== 'true'){
            geolocation_fancybox[0].click()
        }
    <?php endif;?>


</script>