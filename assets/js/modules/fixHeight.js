
const ELEMENTS_SELECTOR = {
    block: '[data-fixheight]',
};

export default function() {


    $(ELEMENTS_SELECTOR.block).each(function (index, item) {

        console.log(`[data-fixheight-rel='${item.dataset.fixheightRel}']`)
       let height = $(`.${item.dataset.fixheightRel}`)[0].offsetHeight
        console.log(height)
        console.log( item)

        $(this).css({marginTop:height+'px'});

    })
}
