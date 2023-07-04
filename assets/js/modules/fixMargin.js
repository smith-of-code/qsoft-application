import $ from "jquery";

const ELEMENTS_SELECTOR = {
    block: '[data-fixmargin]',
};

export default function() {


    let div = document.createElement('div');

    div.style.overflowY = 'scroll';
    div.style.width = '50px';
    div.style.height = '50px';
// мы должны вставить элемент в документ, иначе размеры будут равны 0
    document.body.append(div);
    let scrollWidth = div.offsetWidth - div.clientWidth;
    div.remove();
    $('.page__header').css({marginRight:'-'+scrollWidth+'px'});

    $(ELEMENTS_SELECTOR.block).each(function (index, item) {
        try {
            item.css({marginRight:'-'+scrollWidth+'px'});
        }catch (e){

        }
    })
}
