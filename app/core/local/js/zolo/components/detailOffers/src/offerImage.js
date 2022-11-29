import {detailOfferStore} from "../../../stores/detailOfferStore";
import {mapState} from "ui.vue3.pinia";
import initSwiper from "../../../../../../../../assets/js/modules/swiper";
import {useWishlistStore} from "../../../stores/wishlistStore";

export const OfferImage = {
    props: {
        isAuthorized: {
            type: Boolean,
            required: true,
        },
    },

    data() {
        return {
            inWishlistTemp: {},
        };
    },

    computed: {
        ...mapState(detailOfferStore, ['offers', 'currentOfferId', 'images', 'inWishlist', 'toggleInWishlist']),
        ...mapState(useWishlistStore, ['add', 'remove']),
    },

    setup() {
        return { store: detailOfferStore() };
    },

    mounted() {
        this.inWishlistTemp[this.currentOfferId] = this.inWishlist;
        if (window.swiper && window.swiper.destroy) window.swiper.destroy();
        initSwiper();
    },

    updated() {
        this.inWishlistTemp[this.currentOfferId] = this.inWishlist;
        if (window.swiper && window.swiper.destroy) window.swiper.destroy();
        initSwiper();
    },

    methods: {
        toggleWishlist() {
            this.inWishlistTemp[this.currentOfferId] ? this.remove(this.currentOfferId) : this.add(this.currentOfferId);
            this.inWishlistTemp[this.currentOfferId] = !this.inWishlistTemp[this.currentOfferId];
        },
    },

    template: ` 
            <div class="detail__card-slider slider slider--product" data-carousel="product">
            <div class="swiper-container" data-carousel-container>
                <div class="swiper-wrapper" data-card-favourite-block>
                    <template v-if="images && images.length > 0">
                        <div v-for="(image) in images" class="swiper-slide slider__slide">
                            <article class="product-card product-card--slide box box--circle box--hovering box--border">
                                <div class="product-card__header">
                                    <div v-if="offers.DISCOUNT_LABELS[currentOfferId].NAME"
                                         v-bind:class="'product-card__label label label--' +  offers.DISCOUNT_LABELS[currentOfferId].COLOR">
                                      {{ offers.DISCOUNT_LABELS[currentOfferId].NAME }}
                                      </div>
                                    <div v-if="isAuthorized" class="product-card__favourite">
                                        <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" :data-card-favourite="inWishlist ? 'heart-fill' : 'heart'" @click="toggleWishlist">
                                            <span class="button__icon button__icon--big">
                                                <svg class="icon icon--heart">
                                                    <use :xlink:href="'/local/templates/.default/images/icons/sprite.svg#icon-' + (inWishlist ? 'heart-fill' : 'heart')" data-card-favourite-icon></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>

                                    <a v-bind:href="image.SRC" data-fancybox="gallery">
                                        <div class="product-card__wrapper">
                                            <div class="product-card__image box box--circle">
                                                <div class="product-card__box">
                                                    <img v-bind:src="image.SRC" v-bind:alt="offers.TITLE" class="product-card__pic">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        </div>
                    </template>
                    <template v-else>
                        <div class="swiper-slide slider__slide">
                            <article class="product-card product-card--slide box box--circle box--hovering box--border">
                                <div class="product-card__header">
                                  <div v-if="offers.DISCOUNT_LABELS[currentOfferId].NAME"
                                       v-bind:class="'product-card__label label label--' +  offers.DISCOUNT_LABELS[currentOfferId].COLOR">
                                    {{ offers.DISCOUNT_LABELS[currentOfferId].NAME}}
                                  </div>
    
                                    <div v-if="isAuthorized" class="product-card__favourite">
                                        <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart" @click="toggleWishlist">
                                            <span class="button__icon button__icon--big">
                                                <svg class="icon icon--heart">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
    
                                    <a href="/local/templates/.default/images/no-image-placeholder.png" data-fancybox="gallery">
                                        <div class="product-card__wrapper">
                                            <div class="product-card__image box box--circle">
                                                <div class="product-card__box">
                                                    <img src="/local/templates/.default/images/no-image-placeholder.png" v-bind:alt="offers.TITLE" class="product-card__pic">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        </div>
                    </template>
                    
                    <div v-if="offers.PRODUCT_VIDEO" class="swiper-slide slider__slide">
                        <article class="product-card product-card--slide box box--circle box--hovering box--border">
                            <div class="product-card__header">
                                <div v-if="offers.DISCOUNT_LABELS[currentOfferId].NAME"
                                  v-bind:class="'product-card__label label label--' +  offers.DISCOUNT_LABELS[currentOfferId].COLOR">
                                  {{ offers.DISCOUNT_LABELS[currentOfferId].NAME}}
                                </div>
                                <div v-if="isAuthorized" class="product-card__favourite">
                                    <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart" @click="toggleWishlist">
                                    <span class="button__icon button__icon--big">
                                        <svg class="icon icon--heart">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                        </svg>
                                    </span>
                                    </button>
                                </div>

                                <a v-bind:href="offers.PRODUCT_VIDEO.path" data-fancybox="gallery">
                                    <div class="product-card__wrapper">
                                        <div class="product-card__image box box--circle">
                                            <div class="product-card__box">
                                                <video v-bind:src="offers.PRODUCT_VIDEO.path" poster="/local/templates/.default/images/detail-slide.png" controls class="product-card__pic"></video>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    </div>
                </div>

                <div v-if="images && images.length > 0" class="slider__buttons">
                    <div class="slider__buttons-item swiper-button-prev" data-carousel-prev>
                        <button type="button" class="slider__button slider__button--prev button button--circular button--small button--mixed button--gray-red button--shadow">
                            <span class="button__icon">
                                <svg class="icon icon--arrow-slider">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-slider"></use>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="swiper-pagination pagination pagination--image" data-carousel-pagination></div>

                    <div class="slider__buttons-item swiper-button-next" data-carousel-next>
                        <button type="button" class="slider__button slider__button--next button button--circular button--small button--mixed button--gray-red button--shadow">
                            <span class="button__icon">
                                <svg class="icon icon--arrow-slider">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-slider"></use>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    `
}