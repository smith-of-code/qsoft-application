<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Security\Sign\Signer;
use QSoft\Entity\User;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- component-end -->
 */

// TODO:: Перенести больше логики в template.php, так как он кэшируется

global $APPLICATION;

if (isset($arResult['arResult'])) {
    $arResult =& $arResult['arResult'];
    include_once(GetLangFileName(dirname(__FILE__) . '/lang/', '/template.php'));
} else return;

$this->setFrameMode(true);

$user = new User;
if ($user->isAuthorized) {
    $wishlist = array_flip(array_column($user->wishlist->getAll(), 'UF_PRODUCT_ID'));
    foreach ($arResult['ITEMS'] as &$product) {
        foreach ($product['OFFERS'] as &$offer) {
            $offer['IN_WISHLIST'] = isset($wishlist[$offer['ID']]);
        }
    }
}

if (!empty($arResult['NAV_RESULT'])) {
    $navParams =  [
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum,
    ];
} else {
    $navParams = [
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString(),
    ];
}

$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
    $showLazyLoad = $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = ['popup', 'ajax', 'fx'];
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = [
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
];
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$arParams['~MESS_BTN_BUY'] = $arParams['~MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = $arParams['~MESS_BTN_DETAIL'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = $arParams['~MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = $arParams['~MESS_BTN_SUBSCRIBE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = $arParams['~MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = $arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = $arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');

$arParams['MESS_BTN_LAZY_LOAD'] = $arParams['MESS_BTN_LAZY_LOAD'] ?: Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');

$generalParams = [
    'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
    'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
    'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
    'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
    'MESS_SHOW_MAX_QUANTITY' => $arParams['~MESS_SHOW_MAX_QUANTITY'],
    'MESS_RELATIVE_QUANTITY_MANY' => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
    'MESS_RELATIVE_QUANTITY_FEW' => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
    'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
    'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
    'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
    'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
    'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
    'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
    'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'],
    'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
    'COMPARE_PATH' => $arParams['COMPARE_PATH'],
    'COMPARE_NAME' => $arParams['COMPARE_NAME'],
    'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
    'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
    'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
    'SLIDER_PROGRESS' => $arParams['SLIDER_PROGRESS'],
    '~BASKET_URL' => $arParams['~BASKET_URL'],
    '~ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
    '~BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
    '~COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
    '~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
    'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
    'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY'],
    'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
    'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
    'MESS_BTN_COMPARE' => $arParams['~MESS_BTN_COMPARE'],
    'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
    'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
    'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'],
];

$obName = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = "container-{$navParams['NavNum']}";?>

<div class="catalog__panel">
    <p class="catalog__results"><?=declinationProduct((int)$arResult['TOTAL_PRODUCTS_COUNT'])?></p>

    <div class="catalog__sort">
        <form
            id="sort_selector"
            class="form catalog__select select select--small select--limited select--sorting select--sorting-big select--borderless select--groups"
            data-select
            action="#"
            method="get"
        >
            <select
                class="select__control"
                name="sort"
                id="catalog_sort_sel"
                data-select-control
                data-placeholder="Сортировка"
            >
                <option value="<?= $APPLICATION->GetCurPageParam('sort=popularity', ['sort']);?>" <?= $arParams['ELEMENT_SORT_FIELD'] === 'SORT' && $arParams["ELEMENT_SORT_ORDER"] === 'desc' ? 'selected' : ''?>>По популярности</option>
                <option value="<?= $APPLICATION->GetCurPageParam('sort=price-asc', ['sort']);?>" <?= $arParams['ELEMENT_SORT_FIELD'] === 'CATALOG_PRICE_1' && $arParams["ELEMENT_SORT_ORDER"] === 'asc' ? 'selected' : ''?>>По цене (по возрастанию)</option>
                <option value="<?= $APPLICATION->GetCurPageParam('sort=price-desc', ['sort']);?>" <?= $arParams['ELEMENT_SORT_FIELD'] === 'CATALOG_PRICE_1' && $arParams["ELEMENT_SORT_ORDER"] === 'desc' ? 'selected' : ''?>>По цене (по убыванию)</option>
                <option value="<?= $APPLICATION->GetCurPageParam('sort=date-desc', ['sort']);?>" <?= $arParams['ELEMENT_SORT_FIELD'] === 'TIMESTAMP_X' && $arParams["ELEMENT_SORT_ORDER"] === 'desc' ? 'selected' : ''?>>Сначала новые товары</option>
                <option value="<?= $APPLICATION->GetCurPageParam('sort=date-asc', ['sort']);?>" <?= $arParams['ELEMENT_SORT_FIELD'] === 'TIMESTAMP_X' && $arParams["ELEMENT_SORT_ORDER"] === 'asc' ? 'selected' : ''?>>Сначала старые товары</option>
            </select>
            <button type="button" class="input__button input__button--select button button--iconed button--covered button--square button--dark button--noclick" disabled>
                <span class="button__icon button__icon--medium">
                    <svg class="icon icon--sort">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-sort"></use>
                    </svg>
                </span>
            </button>
            <script>
                $(document).ready(function() {
                    $('form#sort_selector').on('submit', function (e) {
                        e.preventDefault();
                        var formData = $(this).serializeArray();
                        window.location.href = String(formData[0].value);
                    });
                });
            </script>
        </form>
        <?php if (isset($this->arParams["USE_FILTER"]) && $this->arParams["USE_FILTER"] == "Y"):?>
            <div class="catalog__toggle">
                <button type="button" class="filter__toggle button button--square button--covered button--black-red button--full" data-filter-button>
                    <span class="button__icon button__icon--right button__icon--medium">
                        <svg class="icon icon--filter">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-filter"></use>
                        </svg>
                    </span>
                    <span class="button__text">Фильтр</span>
                </button>
            </div>
        <?php endif;?>
    </div>
</div>

<div class="catalog__products">
    <ul class="product-cards product-cards--catalog">
        <ul class="product-cards__list" data-entity="<?=$containerName?>">
            <!-- items-container -->
            <?php if (!empty($arResult['ITEMS'])) {
                $areaIds = [];

                foreach ($arResult['ITEMS'] as $item) {
                    $uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
                    $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
                    $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
                    $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
                }

                foreach ($arResult['ITEMS'] as $item) {
                    $APPLICATION->IncludeComponent(
                        'zolo:catalog.item',
                        '.default',
                        [
                            'RESULT' => [
                                'ITEM' => $item,
                                'AREA_ID' => $areaIds[$item['ID']],
                                'TYPE' => 'CARD',
                                'BIG_LABEL' => 'N',
                                'BIG_DISCOUNT_PERCENT' => 'N',
                                'BIG_BUTTONS' => 'Y',
                                'SCALABLE' => 'N',
                            ],
                            'PARAMS' => $generalParams + ['SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']]],
                        ],
                        $component,
                        ['HIDE_ICONS' => 'Y'],
                    );
                }
                unset($generalParams);
            }?>
            <!-- items-container -->
        </ul>
        <?php
        $signer = new Signer;
        $signedTemplate = $signer->sign($templateName, 'catalog.section');
        $signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
        ?>

</div>
<div data-entity="lazy-<?=$containerName?>" style="<?=(int) $arResult['TOTAL_PRODUCTS_COUNT'] === count($arResult['ITEMS']) ? 'display: none;' : '' ?>">
    <button
        type="button"
        class="catalog__button button button--rounded-big button--outlined button--green button--full"
        data-use="show-more-<?=$navParams['NavNum']?>"
    >Показать больше</button>
</div>
<script>
    BX.message({
        BASKET_URL: '<?=$arParams['BASKET_URL']?>',
        RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
        RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
        BTN_MESSAGE_LAZY_LOAD: '<?=CUtil::JSEscape($arParams['MESS_BTN_LAZY_LOAD'])?>',
        SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>',
    });
    var <?=$obName?> = new JCCatalogSectionComponent({
        siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
        componentPath: '<?=CUtil::JSEscape($componentPath)?>',
        navParams: <?=CUtil::PhpToJSObject($navParams)?>,
        deferredLoad: false, // enable it for deferred load
        initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
        bigData: <?=CUtil::PhpToJSObject($arResult['BIG_DATA'])?>,
        lazyLoad: !!'<?=$showLazyLoad?>',
        loadOnScroll: !!'<?=($arParams['LOAD_ON_SCROLL'] === 'Y')?>',
        template: '<?=CUtil::JSEscape($signedTemplate)?>',
        ajaxId: '<?=CUtil::JSEscape($arParams['AJAX_ID'])?>',
        parameters: '<?=CUtil::JSEscape($signedParams)?>',
        container: '<?=$containerName?>',
    });
</script>
</div>
<!-- component-end -->

<?php

if (!empty($templateData['TEMPLATE_LIBRARY'])) {
    $loadCurrency = false;
    if (!empty($templateData['CURRENCIES'])) {
        $loadCurrency = Loader::includeModule('currency');
    }

    CJSCore::Init($templateData['TEMPLATE_LIBRARY']);

    if ($loadCurrency) {
        ?>
        <script>
            BX.Currency.setCurrencies(<?=$templateData['CURRENCIES']?>);
        </script>
        <?php
    }
}

//	Lazy load and big data json answers
$request = Context::getCurrent()->getRequest();
if ($request->isAjaxRequest() && ($request->get('action') === 'showMore' || $request->get('action') === 'deferredLoad')) {
    $content = ob_get_contents();
    ob_end_clean();

    list(, $itemsContainer) = explode('<!-- items-container -->', $content);
    list(, $paginationContainer) = explode('<!-- pagination-container -->', $content);
    list(, $epilogue) = explode('<!-- component-end -->', $content);

    if ($arParams['AJAX_MODE'] === 'Y') {
        $component->prepareLinks($paginationContainer);
    }

    $component::sendJsonAnswer([
        'items' => $itemsContainer,
        'pagination' => $paginationContainer,
        'epilogue' => $epilogue,
    ]);
}
