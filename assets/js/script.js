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


 const app = {
    ready() {
        // Пример вызова импортированнывх функций
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
    },

    load() {

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
