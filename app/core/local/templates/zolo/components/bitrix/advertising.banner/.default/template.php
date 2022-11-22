<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @var $arResult
 **/
    $params = unserialize($arResult['BANNER_PROPERTIES']['TEMPLATE'], ['allowed_classes' => false])['PROPS'];
    $files = unserialize($arResult['BANNER_PROPERTIES']['TEMPLATE_FILES'], ['allowed_classes' => false]);
    $sliders = [];
    for ($i = 0; $i < count($params); $i++) {
        $slider = array_merge($params[$i], $files[$i]);
        $slider['IMG'] = CFile::GetPath($slider['IMG']);
        $slider['IMG_MOBILE'] = CFile::GetPath($slider['IMG_MOBILE']);
        $slider['IMG_TABLET'] = CFile::GetPath($slider['IMG_TABLET']);
        $sliders[] = $slider;
    }
?>

<section class="main__section">
    <div class="slider slider--main" data-carousel="main">
        <div class="swiper-container" data-carousel-container>
            <div class="swiper-wrapper">
            <?php foreach ($sliders as $slider) { ?>
                <div class="swiper-slide slider__slide">
                    <div class="slider__image">
                        <picture>
                            <source media="(min-width: 1440px)"
                                    srcset="<?=$slider['IMG']?>">
                            <source media="(min-width: 768px)"
                                    srcset="<?=$slider['IMG_TABLET']?>">
                            <img src="<?=$slider['IMG_MOBILE']?>"
                                 alt="Слайд на главной" class="slider__image-picture">
                        </picture>
                    </div>

                    <article class="slider__card card-banner">
                        <a href="<?=$slider['LINK_URL']?>" class="card-banner__link"></a>
                        <div class="card-banner__inner">
                            <h2 class="card-banner__title">
                                <?=$slider['HEADING']?>
                            </h2>
                            <p class="card-banner__text">
                                <?=$slider['ANNOUNCEMENT']?>
                            </p>

                            <div class="card-banner__pagination swiper-pagination pagination pagination--default"
                                 data-carousel-pagination></div>

                            <div class="card-banner__sale sale">
                                <p class="sale__text">
                                    <?=$slider['SALE']?>
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
                <?php } ?>
            </div>

            <div class="swiper-pagination pagination" data-carousel-pagination></div>

            <div class="slider__buttons">
                <div class="slider__buttons-item swiper-button-prev" data-carousel-prev>
                    <button type="button" class="slider__button slider__button--prev">
                        <svg class="slider__button-icon icon icon--arrow">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left"></use>
                        </svg>
                    </button>
                </div>
                <div class="slider__buttons-item swiper-button-next" data-carousel-next>
                    <button type="button" class="slider__button slider__button--next">
                        <svg class="slider__button-icon icon icon--arrow">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Слайдер-->
