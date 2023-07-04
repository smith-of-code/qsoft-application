<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();



CUtil::InitJSCore(array('window'));

\Bitrix\Main\UI\Extension::load("zolo.geolocation");


global $USER;


$session = \Bitrix\Main\Application::getInstance()->getSession();
//var_dump($session->get('arrival_place'));
//exit();

?>

<div class="geolocation">
    <div class="geolocation__city-btn">
        <img class="geolocation__icon" src="/local/templates/.default/images/icons/geolocation.svg"
             alt="">
        <span id="geolocationName">Москва</span>
    </div>
    <div class="geolocation__address-btn">
        <span id="geolocationAddress">Укажите адрес доставки</span>
    </div>
</div>

<script>
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
            const taskManager = new Geolocation.GeoLocation('#geolocation',{
                activeTab,
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