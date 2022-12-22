<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
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
    $navParams = [
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
$elementDeleteParams = ['CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM')];

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

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = "container-{$navParams['NavNum']}";

$indexedItems = [];
foreach ($arResult['ITEMS'] as $item) {
    $indexedItems[$item['ID']] = $item;
}?>
<section class="main__section main__section--separated">
    <div class="main__section-header">
        <p class="main__section-heading heading heading--huge">Хиты продаж</p>
        <a href="<?=HITS_LINK?>" type="button" class="button button--simple button--red button--transition">
        <span class="button__icon button__icon--average button__icon--red button__icon--right">
            <svg class="icon icon--arrow-right-light">
                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
            </svg>
        </span>
            <span class="button__text">Смотреть все</span>
        </a>
    </div>

    <div class="main__tabs tabs tabs--black tabs--rounded" data-tabs>
        <nav class="tabs__items">
            <ul class="tabs__list">
                <li class="tabs__item tabs__item--active" data-tab="food">
                    корм
                </li>

                <li class="tabs__item" data-tab="accessories">
                    аксессуары
                </li>
            </ul>
        </nav>

        <div class="main__tabs-body tabs__body" data-entity="<?=$containerName?>">
            <?php
            $tabsCount = 0;
            foreach ($arParams['SLIDER_PARAMS'] as $index => $slider) {
                $tabsCount += 1;
                $itemsTotalLimit = 10;
                $itemsCount = 1;
                ?>
                <div class="tabs__block<?= $tabsCount <= 1 ? ' tabs__block--active' : ''?>"
                     data-tab-section="<?= strtolower($index) ?>">
                    <div class="product-cards" data-show-cards>
                        <ul class="product-cards__list">
                            <?
                            if (! empty($slider['SORTED']))
                            {
                                $areaIds = array();

                                foreach ($slider['SORTED'] as $element) {
                                    if ($tabsCount > $itemsTotalLimit) {
                                        continue;
                                    }

                                    if ($element['UF_TYPE'] === 'PRODUCT' && isset($indexedItems[$element['UF_ELEMENT_ID']])) {

                                        $item = $indexedItems[$element['UF_ELEMENT_ID']];
                                        $uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
                                        $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
                                        $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
                                        $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);

                                        $itemComponentParams = [
                                            'RESULT' => [
                                                'ITEM' => $item,
                                                'AREA_ID' => $areaIds[$item['ID']],
                                                'TYPE' => 'CARD',
                                                'BIG_LABEL' => 'N',
                                                'BIG_DISCOUNT_PERCENT' => 'N',
                                                'BIG_BUTTONS' => 'Y',
                                                'SCALABLE' => 'N'
                                            ],
                                            'PARAMS' => $generalParams + [
                                                'SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']],
                                                'EXPANDABLE' => ['CONTAINER_DATA' => 'data-show-card'],
                                            ],
                                        ];

                                        $APPLICATION->IncludeComponent(
                                            'zolo:catalog.item',
                                            '',
                                            $itemComponentParams,
                                            $component,
                                            array('HIDE_ICONS' => 'Y')
                                        );

                                        $itemsCount++;
                                    } elseif ($element['UF_TYPE'] === 'BANNER' && isset($slider['BANNERS'][$element['UF_ELEMENT_ID']])) {

                                        ?>
                                        <li class="product-cards__item" data-show-card>
                                            <article class="product-card product-card--marketing box box--circle box--hovering box--grayish">
                                                <?= $slider['BANNERS'][$element['UF_ELEMENT_ID']]['CODE'] ?>
                                            </article>
                                        </li>
                                        <?
                                        $itemsCount++;
                                    }
                                }
                            }
                            ?>
                        </ul>
                        <button type="button" class="product-cards__button button button--full button--rounded button--covered button--white-green" data-show-button>
                            Показать еще
                        </button>
                    </div>
                </div>

            <?php }?>

        </div>
        <?php
        unset($generalParams);
        $signer = new Signer;
        $signedTemplate = $signer->sign($templateName, 'catalog.section');
        $signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
        ?>
    </div>
</section>
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
		<?
	}
}
