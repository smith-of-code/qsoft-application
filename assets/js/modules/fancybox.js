import fancybox from "@fancyapps/fancybox";
import select2 from './select';

const ID = {
    bitrix: '#bx-panel',
};

export default function () {
    let smallBtn = '<div data-fancybox-close class="fancybox-close"><svg class="fancybox-close-icon icon icon--close-square" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.17004 14.83L14.83 9.17001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M14.83 14.83L9.17004 9.17001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21.9997H15C20 21.9997 22 19.9997 22 14.9997V8.99973C22 3.99973 20 1.99973 15 1.99973H9C4 1.99973 2 3.99973 2 8.99973V14.9997C2 19.9997 4 21.9997 9 21.9997Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>';

    $.fancybox.defaults.hash = false;
    $.fancybox.defaults.infobar = false;
    $.fancybox.defaults.toolbar = false;
    $.fancybox.defaults.smallBtn = true;
    $.fancybox.defaults.closeExisting = true;
    $.fancybox.defaults.touch = false;
    $.fancybox.defaults.hideScrollbar = true;
    $.fancybox.defaults.fullScreen = false;
    $.fancybox.defaults.backFocus = false;
    $.fancybox.defaults.keyboard = false;
    $.fancybox.defaults.arrows = false;
    $.fancybox.defaults.loop = false;

    let offset;

    $('[data-modal-type="modal"]').fancybox({
        baseClass : 'modal',
        btnTpl: {
            smallBtn: smallBtn,
        },
        beforeShow: function() {
            const bitrixPanel = document.querySelector(ID.bitrix);
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
    });

    $('[data-modal-type="modal-order"]').fancybox({
        baseClass : 'modal',
        clickSlide: false,
        btnTpl: {
            smallBtn: smallBtn,
        },
        beforeShow: function() {
            const bitrixPanel = document.querySelector(ID.bitrix);
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
    });

    $('[data-fancybox="gallery"]').fancybox({
        keyboard: true,
        arrows: true,
        beforeShow: function() {
            const bitrixPanel = document.querySelector(ID.bitrix);
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
    });
}