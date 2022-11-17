// https://swiper5.flandre.tw/api/
import Swiper from 'swiper';

const ELEMENTS_SELECTOR = {
    slider: '[data-carousel]',
    container: '[data-carousel-container]',
    pagination: '[data-carousel-pagination]',
    prev: '[data-carousel-prev]',
    next: '[data-carousel-next]',
    productImage: '.product-card__pic',
    slide: '.slider__slide',
};

export default function () {
    $(ELEMENTS_SELECTOR.slider).each(function () {
        const wrap = $(this);
        const type = wrap.data('carousel');
        const container = $(ELEMENTS_SELECTOR.container, wrap);
        const prev = $(ELEMENTS_SELECTOR.prev, wrap);
        const next = $(ELEMENTS_SELECTOR.next, wrap);
        const pagination = $(ELEMENTS_SELECTOR.pagination, wrap);

        let params = {
            speed: 700,
            navigation: {
                nextEl: next,
                prevEl: prev,
            },
            loop: true,
        };

        let paramsCustom = {};

        switch (type) {
            case 'main':
                paramsCustom = {
                    slidesPerView: 1,
                    centeredSlides: true,
                    pagination: {
                        el: pagination,
                        type: 'bullets',
                        clickable: true,
                    },
                    breakpoints: {
                        320: {
                            spaceBetween: 10,
                        },
                        768: {
                            spaceBetween: 20,
                        },
                    },
                };
                break;
            case 'product':
                const images = $(ELEMENTS_SELECTOR.productImage, wrap);

                paramsCustom = {
                    slidesPerView: 1,
                    pagination: {
                        el: pagination,
                        type: 'bullets',
                        clickable: true,
                        renderBullet: function (index, classname) {
                            const currentImage = images[index]?.getAttribute('poster') || images[index]?.getAttribute('src');

                            return `<div class="${classname}">
                                        <img
                                            src="${currentImage}"
                                            alt="вид товара ${index}"
                                            class="${classname}__image"
                                        />
                                    </div>`;
                        },
                    },
                    breakpoints: {
                        320: {
                            spaceBetween: 10,
                        },
                        768: {
                            spaceBetween: 20,
                        },
                    },
                    on: {
                        slideChange() {
                            const currentSlide = $(ELEMENTS_SELECTOR.slide, wrap)[this.realIndex];
                            const previousSlide = $(ELEMENTS_SELECTOR.slide, wrap)[this.previousIndex];
                            const videoSlide = currentSlide.querySelector('video') || previousSlide.querySelector('video');

                            if (videoSlide && !videoSlide?.paused) {
                                videoSlide.pause();
                            }
                        },
                    },
                };
                break;
            default:
                break;
        }

        params = $.extend(params, paramsCustom);

        window.swiper = new Swiper(container, params);
    });
};
