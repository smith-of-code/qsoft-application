<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин");
?>
    <div class="content__main content__main--primary">
        <!--Слайдер-->
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:advertising.banner',
            '',
            [
                "QUANTITY" => "1",
                "TYPE" => "MAIN",
            ]);?>
        <!--/Слайдер-->

        <!--Каталоги-->
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => 'include/mainPage/catalog.php'
        ])?>
        <!--/Каталоги-->

        <!--Хиты продаж-->
        <?php
        $bestSellersProductsFood = QSoft\Helper\SliderHelper::prepareDataForComponent('main_hits_food');
        $bestSellersProductsAccessories = QSoft\Helper\SliderHelper::prepareDataForComponent('main_hits_accessories');

        global $bestSellersProductsFilter;

        $bestSellersProductsFilter = array_merge($bestSellersProductsFood['FILTER'], $bestSellersProductsAccessories['FILTER']);
        $bestSellersProductsFilter['ID'] = array_merge($bestSellersProductsFood['FILTER']['ID'], $bestSellersProductsAccessories['FILTER']['ID']);

        if (! empty($bestSellersProductsFilter['ID'])) {

            $bestSellersProductsSectionComponentParams = [
                "SLIDER_PARAMS" => [
                    'FOOD' => $bestSellersProductsFood,
                    'ACCESSORIES' => $bestSellersProductsAccessories,
                ],
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => IBLOCK_PRODUCT,
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_ORDER" => "id",
                "ELEMENT_SORT_FIELD2" => "asc",
                "ELEMENT_SORT_ORDER2" => "desc",
                "PROPERTY_CODE" => array(
                    0 => "PET_TYPE",
                    1 => "VIDEO",
                    2 => "PRODUCT_DETAILS",
                    3 => "ENERGY",
                    4 => "CALCIUM",
                    5 => "COMPLETENESS",
                    6 => "TREAT",
                    7 => "LINE",
                    8 => "MATERIAL",
                    9 => "APPOINTMENT",
                    10 => "NONRETURNABLE_PRODUCT",
                    11 => "PRODUCT_FEATURES",
                    12 => "PROTEIN",
                    13 => "FEEDING_RECOMMENDATIONS",
                    14 => "COMPOSITION",
                    15 => "ROW_ASH",
                    16 => "CRUDE_FIBRE",
                    17 => "PRHOSPHORUS",
                    18 => "BREED",
                    19 => "AGE",
                    20 => "FEED_TASTE",
                    21 => "SPECIAL_INDICATIONS",
                    22 => "",
                ),
                "PROPERTY_CODE_MOBILE" => [],
                "META_KEYWORDS" => "",
                "META_DESCRIPTION" => "",
                "BROWSER_TITLE" => "",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_SUBSECTIONS" => "A",
                "BASKET_URL" => "/cart/",
                "ACTION_VARIABLE" => "action",
                "PRODUCT_ID_VARIABLE" => "id",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "FILTER_NAME" => "bestSellersProductsFilter",
                "CACHE_TYPE" => 'A',
                "CACHE_TIME" => 86400,
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "N",
                "SET_TITLE" => "N",
                "MESSAGE_404" => "",
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                "DISPLAY_COMPARE" => 'N',
                "PAGE_ELEMENT_COUNT" => 10,
                "LINE_ELEMENT_COUNT" => 0,
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "USE_PRICE_COUNT" => "N",
                "SHOW_PRICE_COUNT" => "1",

                "PRICE_VAT_INCLUDE" => "Y",
                "USE_PRODUCT_QUANTITY" => "Y",
                "ADD_PROPERTIES_TO_BASKET" => "",
                "PARTIAL_PRODUCT_PROPERTIES" => "",
                "PRODUCT_PROPERTIES" => "",

                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Хиты продаж",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "LAZY_LOAD" => 'N',
                "MESS_BTN_LAZY_LOAD" => '',
                "LOAD_ON_SCROLL" => 'N',

                "OFFERS_CART_PROPERTIES" => array(
                    0 => "ARTICLE",
                    1 => "BONUSES_K1",
                    2 => "BONUSES_K2",
                    3 => "BONUSES_K3",
                    4 => "DISCOUNT_LABEL",
                    5 => "SIZE",
                    6 => "PACKAGING",
                    7 => "IS_BESTSELLER",
                    8 => "COLOR",
                    9 => "CML2_LINK",
                ),
                "OFFERS_FIELD_CODE" => array(
                    0 => "ID",
                    1 => "NAME",
                    2 => "SORT",
                    3 => "PREVIEW_TEXT",
                    4 => "IBLOCK_ID",
                    5 => "",
                ),
                "OFFERS_PROPERTY_CODE" => array(
                    0 => "ARTICLE",
                    1 => "BONUSES_K1",
                    2 => "BONUSES_K2",
                    3 => "BONUSES_K3",
                    4 => "DISCOUNT_LABEL",
                    5 => "SIZE",
                    6 => "PACKAGING",
                    7 => "IS_BESTSELLER",
                    8 => "COLOR",
                    9 => "CML2_LINK",
                    10 => "",
                ),
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER2" => "desc",
                "OFFERS_LIMIT" => "0",

                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
                "DETAIL_URL" => "/catalog/#SECTION_CODE_PATH#/#CODE#",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                "CONVERT_CURRENCY" => "N",
                "CURRENCY_ID" => "",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",

                'LABEL_PROP' => "",
                'LABEL_PROP_MOBILE' => "",
                'LABEL_PROP_POSITION' => "",
                'ADD_PICT_PROP' => "",
                'PRODUCT_DISPLAY_MODE' => 'Y',
                'PRODUCT_BLOCKS_ORDER' => "",
                'PRODUCT_ROW_VARIANTS' => "",
                'ENLARGE_PRODUCT' => "",
                'ENLARGE_PROP' => "",
                'SHOW_SLIDER' => "N",
                'SLIDER_INTERVAL' => "3000",
                'SLIDER_PROGRESS' => "N",

                'OFFER_ADD_PICT_PROP' => "",
                'OFFER_TREE_PROPS' => "",
                'PRODUCT_SUBSCRIPTION' => "",
                'SHOW_DISCOUNT_PERCENT' => "",
                'SHOW_OLD_PRICE' => 'Y',
                'SHOW_MAX_QUANTITY' => 'N',
                'MESS_SHOW_MAX_QUANTITY' => "",
                'RELATIVE_QUANTITY_FACTOR' => "",
                'MESS_RELATIVE_QUANTITY_MANY' => "",
                'MESS_RELATIVE_QUANTITY_FEW' => "",
                'MESS_BTN_BUY' => "",
                'MESS_BTN_ADD_TO_BASKET' => "",
                'MESS_BTN_SUBSCRIBE' => "",
                'MESS_BTN_DETAIL' => "",
                'MESS_NOT_AVAILABLE' => "",
                'MESS_BTN_COMPARE' => "",

                'USE_ENHANCED_ECOMMERCE' => "",
                'DATA_LAYER_NAME' => "",
                'BRAND_PROPERTY' => "",

                'TEMPLATE_THEME' => "",
                "ADD_SECTIONS_CHAIN" => "N",
                'ADD_TO_BASKET_ACTION' => "",
                'SHOW_CLOSE_POPUP' => "",
                'COMPARE_PATH' => "",
                'COMPARE_NAME' => "",
                'USE_COMPARE_LIST' => "",
                "COMPATIBLE_MODE" => "N",
                "ADD_ELEMENT_CHAIN" => "N",
                "SHOW_ALL_WO_SECTION" => "Y",
                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            ];

            $APPLICATION->IncludeComponent(
                "zolo:catalog.section",
                "main_page_slider",
                $bestSellersProductsSectionComponentParams
            );

        }
        ?>
        <!--/Хиты продаж-->

        <!--Подборки-->
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            [
                'AREA_FILE_SHOW' => 'file',
                'PATH' => 'include/mainPage/collections.php'
            ])?>
        <!--/Подборки-->

        <!--Новости-->
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            [
                'AREA_FILE_SHOW' => 'file',
                'PATH' => 'include/mainPage/news.php'
            ])
        ?>
        <!--/Новости-->

        <!--Баннер-->
        <section class="main__section">
            <div class="banner banner--consultant">
                <div class="banner__image">
                    <img class="banner__image-picture" src="/local/templates/.default/images/banner1.png" alt="">
                </div>
                <div class="banner__inner">
                    <p class="banner__title">
                        Приводи друзей — зарабатывайте вместе
                    </p>
                    <p class="banner__text">
                        Работай с единомышленниками и получай бонусные баллы
                    </p>
                </div>
            </div>
        </section>
        <!--/Баннер-->

        <!--Баннер2-->
        <section class="main__section" style="display:none">
            <div class="banner banner--user">
                <div class="banner__image">
                    <img class="banner__image-picture" src="/local/templates/.default/images/banner1.png" alt="">
                </div>
                <div class="banner__inner">
                    <p class="banner__title">
                        Приводи друзей — зарабатывайте вместе
                    </p>
                    <p class="banner__text">
                        Работай с единомышленниками и получай бонусные баллы
                    </p>

                    <div class="banner__actions">
                        <a href="#"
                           class="banner__actions-button button button--rounded button--covered button--red button--heavy">Стать
                            консультантом</a>
                        <a href="#"
                           class="banner__actions-button button button--rounded button--covered button--white-green button--heavy">Узнать
                            больше</a>
                    </div>
                </div>
            </div>
        </section>
        <!--/Баннер2-->

        <!--Баннер3-->
        <section class="main__section" style="display:none">
            <div class="banner banner--user">
                <div class="banner__image">
                    <img class="banner__image-picture" src="/local/templates/.default/images/banner1.png" alt="">
                </div>
                <div class="banner__inner">
                    <p class="banner__title">
                        Получите все привилегии AmeБизнес, став консультантом
                    </p>

                    <div class="banner__actions">
                        <a href="#"
                           class="banner__actions-button button button--rounded button--covered button--red button--heavy">Стать
                            консультантом</a>
                        <a href="#"
                           class="banner__actions-button button button--rounded button--covered button--white-green button--heavy">Узнать
                            больше</a>
                    </div>
                </div>
            </div>
        </section>
        <!--/Баннер3-->

        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            [
                'AREA_FILE_SHOW' => 'file',
                'PATH' => 'include/mainPage/about.php'
            ])?>
    </div>


<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>