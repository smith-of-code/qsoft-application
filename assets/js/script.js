/**
 * Vendors
 */
 import $ from 'jquery';
 window.$ = $;

 // Пример подключения плагина
 // import pluginName from 'plugin-name';
 import svg4everybody from 'svg4everybody';

 /**
  * Modules
  */
 // Пример подключения модуля
 //import module from './modules/module';


 import password from './modules/password';
 import symbolCounter from './modules/symbolCounter';
 import range from './modules/range';
 import inputPlaceholder from './modules/inputPlaceholder';
 import tabs from './modules/tabs';
 import scrollbar from './modules/scrollbar';
 import tooltip from "./modules/tooltip";
 import toggle from "./modules/toggle";
 import truncate from './modules/truncate';
 import dropdown from './modules/dropdown';
 import quantity from './modules/quantity';
 import select from './modules/select';
 import dropzone from './modules/dropzone';
 import steps from './modules/steps';
 import inputmask from './modules/inputmask';
 import addPets from './modules/add-pets';
 import registration from './modules/registration';
 import validation from './modules/validation';
 import accordeon from './modules/accordeon';
 import fancybox from './modules/fancybox';
 import technicalSupport from './modules/technicalSupport';
 import addFavourite from './modules/add-favourite';
 import filter from './modules/filter';
 import swiper from './modules/swiper'; 
 import bitrixPanelHide from './modules/bitrix-panel-hide'; 
 import showSupportPopup from './modules/support-popup'; 
 import cardCounting from './modules/cardCounting';
 import removeItem from './modules/remove-item';
 import editProfile from './modules/edit-profile'; 
 import cookie from './modules/cookie';
 import identic from './modules/identic';
 import showText from './modules/show-text';
 import basket from './modules/basket';
 import calculator from './modules/calculator';
 import chart from './modules/chart';
 import show from './modules/show';



 const app = {
    ready() {
        if (typeof Zolo !== 'undefined') {
            (new Zolo.Loader()).run();
        }

        // Пример вызова импортированных функций
        // pluginName();
        svg4everybody();

        password();
        symbolCounter();
        range();
        inputPlaceholder();
        tabs();
        scrollbar();
        tooltip();
        toggle();
        truncate();
        dropdown();
        quantity();
        select();
        dropzone();
        steps();
        inputmask();
        addPets();
        registration();
        validation();
        accordeon();
        fancybox();
        technicalSupport();
        addFavourite();
        filter();
        swiper();
        showSupportPopup();
        cardCounting();
        removeItem();
        editProfile();
        cookie();
        identic();
        showText();
        basket();
        calculator();
        chart();
        show();
    },

    load() {
        bitrixPanelHide();
    },

    resize() {

    },

    scroll() {

    },
};


$(() => {
    app.ready();

    $(window)
        .on('load', app.load)
        .on('resize', app.resize)
        .on('scroll', app.scroll);
});
