<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<?php if (!empty($arResult)): ?>
    <div class="header__row header__row--nav">
        <div class="container">
            <div class="header__wrapper">
                <nav class="navigation">
                    <ul class="navigation__list">
                        <?php foreach ($arResult as $menuTab): ?>
                            <li class="navigation__item">
                                <a
                                        href="<?= $menuTab['LINK'] ?>"
                                    <?= $menuTab['PARAMS']['IMAGE'] ? '' : '' ?>
                                        class="navigation__button button button--simple <?=
                                            $menuTab['PARAMS']['ADDITIONAL_CLASS_TAG'] ?? 'button--red'
                                        ?>"
                                >
                                    <?php if ($menuTab['PARAMS']['IMAGE']): ?>
                                        <span class="button__icon">
                                        <svg class="icon icon--discount">
                                            <use xlink:href="<?= $menuTab['PARAMS']['SVG'] ?>"></use>
                                        </svg>
                                    </span>
                                    <?php endif; ?>
                                    <span class="button__text"><?= $menuTab['TEXT'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <div class="geolocation">
<!--                    <div class="fancybox-container modal fancybox-is-open" role="dialog" tabindex="-1"-->
<!--                         id="fancybox-container-2" style="transition-duration: 366ms;">-->
<!--                        <div class="fancybox-bg" style=""></div>-->
<!--                        <div class="fancybox-inner">-->
<!--                            <div class="fancybox-infobar">-->
<!--                                <span data-fancybox-index="">1</span>&nbsp;/&nbsp;<span data-fancybox-count="">1</span>-->
<!--                            </div>-->
<!--                            <div class="fancybox-toolbar compensate-for-scrollbar">-->
<!--                                <button data-fancybox-zoom="" class="fancybox-button fancybox-button--zoom" title="Zoom"-->
<!--                                        disabled="">-->
<!--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">-->
<!--                                        <path d="M18.7 17.3l-3-3a5.9 5.9 0 0 0-.6-7.6 5.9 5.9 0 0 0-8.4 0 5.9 5.9 0 0 0 0 8.4 5.9 5.9 0 0 0 7.7.7l3 3a1 1 0 0 0 1.3 0c.4-.5.4-1 0-1.5zM8.1 13.8a4 4 0 0 1 0-5.7 4 4 0 0 1 5.7 0 4 4 0 0 1 0 5.7 4 4 0 0 1-5.7 0z"></path>-->
<!--                                    </svg>-->
<!--                                </button>-->
<!--                                <button data-fancybox-play="" class="fancybox-button fancybox-button--play"-->
<!--                                        title="Start slideshow" style="display: none;">-->
<!--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">-->
<!--                                        <path d="M6.5 5.4v13.2l11-6.6z"></path>-->
<!--                                    </svg>-->
<!--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">-->
<!--                                        <path d="M8.33 5.75h2.2v12.5h-2.2V5.75zm5.15 0h2.2v12.5h-2.2V5.75z"></path>-->
<!--                                    </svg>-->
<!--                                </button>-->
<!--                                <button data-fancybox-thumbs="" class="fancybox-button fancybox-button--thumbs"-->
<!--                                        title="Thumbnails" style="display: none;">-->
<!--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">-->
<!--                                        <path d="M14.59 14.59h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76H5.65V5.65z"></path>-->
<!--                                    </svg>-->
<!--                                </button>-->
<!--                                <button data-fancybox-close="" class="fancybox-button fancybox-button--close"-->
<!--                                        title="Close">-->
<!--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">-->
<!--                                        <path d="M12 10.6L6.6 5.2 5.2 6.6l5.4 5.4-5.4 5.4 1.4 1.4 5.4-5.4 5.4 5.4 1.4-1.4-5.4-5.4 5.4-5.4-1.4-1.4-5.4 5.4z"></path>-->
<!--                                    </svg>-->
<!--                                </button>-->
<!--                            </div>-->
<!--                            <div class="fancybox-navigation">-->
<!--                                <button data-fancybox-prev="" class="fancybox-button fancybox-button--arrow_left"-->
<!--                                        title="Previous" disabled="">-->
<!--                                    <div>-->
<!--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">-->
<!--                                            <path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.38-2.68 2.72H19v1.94H8.6z"></path>-->
<!--                                        </svg>-->
<!--                                    </div>-->
<!--                                </button>-->
<!--                                <button data-fancybox-next=""-->
<!--                                        class="fancybox-button fancybox-button--arrow_right compensate-for-scrollbar"-->
<!--                                        title="Next" disabled="">-->
<!--                                    <div>-->
<!--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">-->
<!--                                            <path d="M15.4 12.97l-2.68 2.72 1.34 1.38L19 12l-4.94-5.07-1.34 1.38 2.68 2.72H5v1.94z"></path>-->
<!--                                        </svg>-->
<!--                                    </div>-->
<!--                                </button>-->
<!--                            </div>-->
<!--                            <div class="fancybox-stage">-->
<!--                                <div class="fancybox-slide fancybox-slide--html fancybox-slide--current fancybox-slide--complete"-->
<!--                                     style="">-->
<!--                                    <article-->
<!--                                             class="modal modal--scrolled box box--circle box--hanging fancybox-content"-->
<!--                                             style="" data-support="">-->
<!--                                        <div class="modal__content" data-support-content="">-->
<!---->
<!--                                            <header class=" modal__section--header">-->
<!--                                                <p class="heading heading--average">Куда доставить ваш заказ?</p>-->
<!--                                                <img src="/local/templates/.default/images/delivery-box.png" alt="delivery-box">-->
<!--                                            </header>-->
<!--                                            <section-->
<!--                                                    class="modal__section modal__section--content os-host os-theme-dark os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden os-host-transition"-->
<!--                                                    data-scrollbar="" data-modal-section="">-->
<!--                                                <div class="os-resize-observer-host observed">-->
<!--                                                    <div class="os-resize-observer"-->
<!--                                                         style="left: 0px; right: auto;"></div>-->
<!--                                                </div>-->
<!--                                                <div class="os-size-auto-observer observed"-->
<!--                                                     style="height: calc(100% + 1px); float: left;">-->
<!--                                                    <div class="os-resize-observer"></div>-->
<!--                                                </div>-->
<!--                                                <div class="os-content-glue"-->
<!--                                                     style="margin: 0px -200px; height: 319px; width: 769px;"></div>-->
<!--                                                <div class="os-padding">-->
<!--                                                    <div class="os-viewport os-viewport-native-scrollbars-invisible">-->
<!--                                                        <div class="os-content"-->
<!--                                                             style="padding: 0px 200px; height: auto; width: 100%;">-->
<!---->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                                <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable">-->
<!--                                                    <div class="os-scrollbar-track os-scrollbar-track-off">-->
<!--                                                        <div class="os-scrollbar-handle"-->
<!--                                                             style="width: 100%; transform: translate(0px, 0px);"></div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                                <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-unusable">-->
<!--                                                    <div class="os-scrollbar-track os-scrollbar-track-off">-->
<!--                                                        <div class="os-scrollbar-handle"-->
<!--                                                             style="height: 100%; transform: translate(0px, 0px);"></div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                                <div class="os-scrollbar-corner"></div>-->
<!--                                            </section>-->
<!--                                        </div>-->
<!--                                        <div data-fancybox-close="" class="fancybox-close outside">-->
<!---->
<!---->
<!--                                            <svg class="fancybox-close-icon-1 icon icon--close-square" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                                <g style="mix-blend-mode:multiply">-->
<!--                                                    <circle cx="23" cy="23" r="23" fill="#D9D9D9"/>-->
<!--                                                </g>-->
<!--                                                <path d="M34.717 12.1505L13.0189 33.8486" stroke="white" stroke-width="3" stroke-linejoin="round"/>-->
<!--                                                <path d="M34.717 33.8486L12.151 12.1505" stroke="white" stroke-width="3" stroke-linejoin="round"/>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                    </article>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="fancybox-caption fancybox-caption--separate">-->
<!--                                <div class="fancybox-caption__body">-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->


                    <?php
                    $APPLICATION->IncludeComponent("zolo:geolocation.city",[])
                    ?>
                    <div class="geolocation__address">
                        <span>Укажите адрес доставки</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>