<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
global $USER;
?>
<?php if (!empty($arResult)): ?>
    <div class="header__block header__block--catalog catalog">
        <div class="header__catalog">
            <div class="dropdown dropdown--menu" data-dropdown>
                <!--кнопка основная-->
                <div class="header__catalog-button header__catalog-button--main">
                    <button type="button" class="header__catalog-button-menu button button--big button--square button--covered button--red button--heavy" data-dropdown-button data-dropdown-burger>
                                    <span class="button__icon">
                                        <svg class="header__catalog-button--open icon icon--burger">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-burger"></use>
                                        </svg>
                                        <svg class="header__catalog-button--close icon icon--close-square">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                                        </svg>
                                    </span>
                        <span class="button__text">Каталог</span>
                    </button>
                </div>
                <!--/кнопка основная-->

                <!--кнопка на МВ-->
                <div class="header__catalog-button header__catalog-button--hidden">
                    <button type="button"
                            class="button button--covered button--square button--small button--red button--burger"
                            data-dropdown-button data-dropdown-burger>
                                    <span class="button__icon button__icon--medium">
                                        <svg class="icon icon--burger">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-burger"></use>
                                        </svg>
                                    </span>
                    </button>
                </div>
                <!--/кнопка на МВ-->

                <!--дропдаун каталога-->
                <div class="menu dropdown__box box box--shading" data-dropdown-block>
                    <div class="dropdown__close" data-dropdown-close>
                        <svg class="dropdown__close-icon icon icon--close-square">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                        </svg>
                    </div>

                    <div class="menu__header">
                        <div class="menu__header-logo logo logo--small">
                            <img class="logo__pic" src="/local/templates/.default/images/icons/logo.svg"
                                    alt="logo">
                        </div>
                        <?php if ($USER->isAuthorized()): ?>
                            <div class="menu__header-profile">
                                <button type="button"
                                        onclick="location.href='/personal';"
                                        class="button button--huge button--rounded button--outlined button--green button--full">
                                    <span class="button__icon button__icon--right">
                                        <svg class="icon icon--user">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-user"></use>
                                        </svg>
                                    </span>
                                        <span class="button__text">Профиль</span>
                                </button>
                                <button type="button" data-logout
                                        class="button button--huge button--rounded button--outlined button--red button--full">
                                    <span class="button__icon">
                                        <svg class="icon icon--user">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-logout"></use>
                                        </svg>
                                    </span> 
                                    <span class="button__text">Выйти из профиля</span> 
                                </button>
                            </div>
                        <?php else: ?>
                            <div class="menu__header-profile">
                                <button type="button"
                                        onclick="location.href='/login';"
                                        class="button button--huge button--rounded button--outlined button--green button--full">
                                    <span class="button__icon button__icon--right">
                                        <svg class="icon icon--user">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-user"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text">Войти в профиль</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <p class="menu__header-title"><?=getMessage('MENU_CATALOG_TITLE') ?></p>
                    </div>

                    <div class="menu__content">
                        <div class="menu__row">

                            <?php foreach (array_values($arResult) as $index => $parentSection): ?>
                                <div class="menu__col <?=$index ? 'menu__col--right' : ''?>">
                                    <ul class="menu__list">
                                        <li class="menu__item menu__item--heading">
                                            <a href="<?=$parentSection['LINK']?>"
                                                class="menu__item-link button button--simple button--red"><?=$parentSection['TEXT'] ?></a>
                                        </li>
                                        <?php foreach ($parentSection['SUBSECTIONS'] as $section): ?>
                                            <li class="menu__item">
                                                <a href="<?=$section['LINK']?>"
                                                    class="menu__item-link button button--simple button--red"><?=$section['TEXT'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>

                                    <div class="menu__image">
                                        <img src="/local/templates/.default/images/<?=$parentSection['IMAGE_NAME']?>.png"
                                                alt="Каталог для собак" class="menu__image-pic">
                                    </div>
                                </div>
                            
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php
                        $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "catalog_top_menu_ame",
                            [
                                "ALLOW_MULTI_SELECT" => "N",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => [],
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "top_mobile",
                            ]
                        );
                    ?>
                </div>
                <!--/дропдаун каталога-->
            </div>
        </div>
    </div>

<?php endif; ?>

