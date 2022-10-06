// https://swiper5.flandre.tw/api/
import Swiper from 'swiper';

const ELEMENTS_SELECTOR = {
    slider: '[data-carousel]',
    container: '[data-carousel-container]',
    pagination: '[data-carousel-pagination]',
    prev: '[data-carousel-prev]',
    next: '[data-carousel-next]',
};

export default function () {
    $(ELEMENTS_SELECTOR.slider).each(function () {
        const wrap = $(this);
        const type = wrap.data('carousel');
        const container = $(ELEMENTS_SELECTOR.container, wrap);
        const prev = $(ELEMENTS_SELECTOR.prev, wrap);
        const next = $(ELEMENTS_SELECTOR.next, wrap);

        let params = {
            navigation: {
                nextEl: next,
                prevEl: prev,
            },
            loop: true,
        };

        let paramsCustom = {};
        
        switch (type) {
            case 'main':
                let pagination = $(ELEMENTS_SELECTOR.pagination, wrap);

                paramsCustom = {
                    slidesPerView: 1,
                    speed: 700,
                    pagination: {
                        el: pagination,
                        type: 'bullets',
                        clickable: true,
                    },
                    breakpoints: {
                        320: {
                            spaceBetween: 4,
                        },
                        768: {
                            spaceBetween: 20,
                        },
                    },
                };
                break;
            case 'pagination':
                paramsCustom = {
                    slidesPerView: 1,
                    speed: 700,
                    pagination: {
                        el: pagination,
                        type: 'bullets',
                        clickable: true,
                    },
                    breakpoints: {
                        320: {
                            spaceBetween: 4,
                        },
                        768: {
                            spaceBetween: 20,
                        },
                    },
                };
                break;
            default:
                break;
        };

        params = $.extend(params, paramsCustom);

        const swiper = new Swiper(container, params);
    });
};
