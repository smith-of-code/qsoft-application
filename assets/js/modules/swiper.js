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

export default function (update) {
    $(ELEMENTS_SELECTOR.slider).each(function () {
        const wrap = $(this);
        const type = wrap.data('carousel');
        const container = $(ELEMENTS_SELECTOR.container, wrap);
        const prev = $(ELEMENTS_SELECTOR.prev, wrap);
        const next = $(ELEMENTS_SELECTOR.next, wrap);
        const pagination = $(ELEMENTS_SELECTOR.pagination, wrap);

        if (update) {
            document.querySelector(ELEMENTS_SELECTOR.container).swiper.loopDestroy();
            document.querySelector(ELEMENTS_SELECTOR.container).swiper.loopCreate();
            document.querySelector(ELEMENTS_SELECTOR.container).swiper.pagination.render();
            document.querySelector(ELEMENTS_SELECTOR.container).swiper.update();
            document.querySelector(ELEMENTS_SELECTOR.container).swiper.slideToLoop(0, 1000);
           
            const images = $(ELEMENTS_SELECTOR.productImage, wrap);
            const imagesPag = pagination.find('.swiper-pagination-bullet__image');
            
            images.each((index, item) => {
                const currentImage = images[index]?.getAttribute('poster') || images[index]?.getAttribute('src');
                const video = images[index]?.getAttribute('poster') !== undefined;
            
                imagesPag.each((indexItem, element) => {
                    const indexBullets = $(element).attr('data-index');

                    if (indexItem === index) {
                        $(element).attr('src', currentImage);
                    }
                })
            })
            
            return;
        }


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
                    on: {
                        slideChange() {
                            document.querySelector(ELEMENTS_SELECTOR.container).swiper.loopDestroy();
                            document.querySelector(ELEMENTS_SELECTOR.container).swiper.loopCreate();
                            document.querySelector(ELEMENTS_SELECTOR.container).swiper.update();
                        },
                    },
                };
                break;
            case 'product':
                const images = $(ELEMENTS_SELECTOR.productImage, wrap);

                paramsCustom = {
                    slidesPerView: 'auto',
                    observer: true,
                    observeParents: true,
                    observeSlideChildren: true,
                    pagination: {
                        el: pagination,
                        type: 'bullets',
                        clickable: true,
                        renderBullet(index, classname) {
                            const currentImage = images[index]?.getAttribute('poster') || images[index]?.getAttribute('src');
                            const video = images[index]?.getAttribute('poster');

                            let vodeoIcon = '';
                            if (video) {
                                vodeoIcon = `
                                    <span class="swiper-pagination-bullet__video">
                                        <svg class="icon icon--video">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-video"></use>
                                        </svg>
                                    </span>
                                `;
                            }

                            return `<div class="${classname}">
                                        ${vodeoIcon}
                                        <img
                                            src="${currentImage}"
                                            alt="вид товара ${index}"
                                            class="${classname}__image"
                                            data-index="${index}"
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
                        1440: {
                            spaceBetween: 5,
                            pagination: {
                                dynamicBullets: true,
                                dynamicMainBullets: 8,
                            }
                        }
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

        new Swiper(container, params);
    });
};
