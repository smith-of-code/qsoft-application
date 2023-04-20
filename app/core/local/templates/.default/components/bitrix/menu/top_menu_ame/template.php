<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
use \Bitrix\Main\Service\GeoIp;

$ipAddress = GeoIp\Manager::getRealIp();

$geolocation = GeoIp\Manager::getDataResult($ipAddress, "ru");

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
                                href="<?=$menuTab['LINK'] ?>" 
                                <?=$menuTab['PARAMS']['IMAGE'] ? '' : '' ?>
                                class="navigation__button button button--simple <?=
                                    $menuTab['PARAMS']['ADDITIONAL_CLASS_TAG'] ?? 'button--red'
                                ?>"
                            >
                                <?php if ($menuTab['PARAMS']['IMAGE']): ?>
                                    <span class="button__icon">
                                        <svg class="icon icon--discount">
                                            <use xlink:href="<?=$menuTab['PARAMS']['SVG'] ?>"></use>
                                        </svg>
                                    </span>
                                <?php endif; ?>
                                <span class="button__text"><?=$menuTab['TEXT'] ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <div class="geolocation">
<!--                    <div class="modal geolocation__modal">-->
<!--                        <div class="modal__content">-->
<!--                            <section class="modal__section modal__section--content">-->
<!---->
<!--                            </section>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="geolocation__city">
                        <img class="geolocation__icon" src="/local/templates/.default/images/icons/geolocation.svg" alt="">
                        <span><?=$geolocation->getGeoData()->cityName?></span>
<!--                        <pre>-->
<!--                            --><?php //var_dump($result->getGeoData()->cityName); ?>
<!--                        </pre>-->

                    </div>
                    <div class="geolocation__address">
                        <span>Укажите адрес доставки</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>