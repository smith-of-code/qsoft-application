<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

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

$this->setFrameMode(true);

if (!empty($arResult['NAV_RESULT']))
{
	$navParams =  array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
}
else
{
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
	$showLazyLoad = $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
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

$generalParams = array(
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
	'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE']
);

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];
?>
<div class="catalog__panel">
    <p class="catalog__results">Найдено <span class="catalog__results-count"><?= count($arResult['ELEMENTS']) ?></span> товаров</p>

    <div class="catalog__sort">
        <form id="sort_selector" class="catalog__select select select--small select--limited select--sorting select--sorting-big select--borderless select--groups" data-select
              action="<?= $APPLICATION->GetCurPageParam('');?>"
              method="get"
              class="form">
            <select class="select__control" name="sort" id="sort" data-select-control data-placeholder="Сортировка">
                <option value="popularity" <?= $arParams['ELEMENT_SORT_FIELD'] === 'SORT' && $arParams["ELEMENT_SORT_ORDER"] === 'desc' ? 'selected' : ''?>>По популярности</option>
                <option value="price-asc" <?= $arParams['ELEMENT_SORT_FIELD'] === 'CATALOG_PRICE_1' && $arParams["ELEMENT_SORT_ORDER"] === 'asc' ? 'selected' : ''?>>По цене (по возрастанию)</option>
                <option value="price-desc" <?= $arParams['ELEMENT_SORT_FIELD'] === 'CATALOG_PRICE_1' && $arParams["ELEMENT_SORT_ORDER"] === 'desc' ? 'selected' : ''?>>По цене (по убыванию)</option>
                <option value="date-desc" <?= $arParams['ELEMENT_SORT_FIELD'] === 'TIMESTAMP_X' && $arParams["ELEMENT_SORT_ORDER"] === 'desc' ? 'selected' : ''?>>Сначала новые товары</option>
                <option value="date-asc" <?= $arParams['ELEMENT_SORT_FIELD'] === 'TIMESTAMP_X' && $arParams["ELEMENT_SORT_ORDER"] === 'asc' ? 'selected' : ''?>>Сначала старые товары</option>
            </select>
            <button type="submit" class="input__button input__button--select button button--iconed button--covered button--square button--dark">
                <span class="button__icon button__icon--medium">
                    <svg class="icon icon--sort">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-sort"></use>
                    </svg>
                </span>
            </button>
        </form>

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
    </div>
</div>

<div class="catalog__products">
    <ul class="product-cards product-cards--catalog">
        <ul class="product-cards__list" data-entity="<?=$containerName?>">
            <!-- items-container -->
			<?
			if (!empty($arResult['ITEMS']))
			{
				$areaIds = array();

				foreach ($arResult['ITEMS'] as $item)
				{
					$uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
					$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
					$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
					$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
				}

                foreach ($arResult['ITEMS'] as $item)
                {
                    ?>
                    <?
                    // TODO: Интегрировать карточку товара (верстку) в компонент ниже
                    /*$APPLICATION->IncludeComponent(
                        'zolo:catalog.item',
                        '',
                        array(
                            'RESULT' => array(
                                'ITEM' => $item,
                                'AREA_ID' => $areaIds[$item['ID']],
                                'TYPE' => 'CARD',
                                'BIG_LABEL' => 'N',
                                'BIG_DISCOUNT_PERCENT' => 'N',
                                'BIG_BUTTONS' => 'Y',
                                'SCALABLE' => 'N'
                            ),
                            'PARAMS' => $generalParams + array('SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']])
                        ),
                        $component,
                        array('HIDE_ICONS' => 'Y')
                    );*/
                    ?>
                    <li class="product-cards__item">
                        <article class="product-card box box--circle box--hovering box--grayish">
                            <a href="#" class="product-card__link"></a>
                            <div class="product-card__header">
                                <div class="product-card__label label label--violet">ограниченное предложение</div>

                                <div class="product-card__favourite">
                                    <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                                                <span class="button__icon button__icon--big">
                                                                    <svg class="icon">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                                    </svg>
                                                                </span>
                                    </button>
                                </div>

                                <div class="product-card__wrapper">
                                    <div class="product-card__image box box--circle">
                                        <div class="product-card__box">
                                            <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card__content">
                                <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                                <p class="product-card__article">Арт. СХ-С-456013</p>

                                <div class="product-card__colors colors">
                                    <ul class="colors__list">
                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r1" id="radio" checked>
                                                    <label for="radio">
                                                        <div class="color__item color__item--pink"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r2" id="radio2">
                                                    <label for="radio2">
                                                        <div class="color__item color__item--blue"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio3">
                                                    <label for="radio3">
                                                        <div class="color__item color__item--green"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r4" id="radio4">
                                                    <label for="radio4">
                                                        <div class="color__item color__item--yellow"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio5">
                                                    <label for="radio5">
                                                        <div class="color__item color__item--red"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio6">
                                                    <label for="radio6">
                                                        <div class="color__item color__item--violet"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-card__breed">
                                    <div class="select select--mini" data-select>
                                        <select class="select__control" name="select1m" id="select1m" data-select-control data-placeholder="Выберите размер" data-option>
                                            <option><!-- пустой option для placeholder --></option>
                                            <option value="1">Для всех пород</option>
                                            <option value="2">Мелкие породы</option>
                                            <option value="3">Средние породы</option>
                                            <option value="4">Крупные породы</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card__footer">
                                <div class="product-card__price price">
                                    <p class="price__main">1 545 ₽</p>
                                    <div class="price__calculation">
                                        <p class="price__calculation-total">1 420 ₽</p>
                                        <p class="price__calculation-accumulation">14 ББ</p>
                                    </div>
                                </div>

                                <div class="product-card__cart">
                                    <div class="quantity" data-quantity>
                                        <div class="quantity__button" data-quantity-button>
                                            <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--basket">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                            </svg>
                                                                        </span>
                                                <span class="button__text">В корзину</span>
                                            </button>
                                        </div>

                                        <div class="quantity__actions">
                                            <div class="quantity__decrease">
                                                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                                            <span class="button__icon button__icon--small">
                                                                                <svg class="icon icon--minus">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                                </svg>
                                                                            </span>
                                                </button>
                                            </div>

                                            <div class="quantity__total">
                                                                        <span class="quantity__total-icon">
                                                                            <svg class="icon icon--basket">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                            </svg>
                                                                        </span>
                                                <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                            </div>

                                            <div class="quantity__increase">
                                                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                                            <span class="button__icon button__icon--small">
                                                                                <svg class="icon icon--plus">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                                </svg>
                                                                            </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>

                    <li class="product-cards__item">
                        <article class="product-card box box--circle box--hovering box--grayish">
                            <a href="#" class="product-card__link"></a>
                            <div class="product-card__header">
                                <div class="product-card__label label label--pink">сезонное предложение</div>

                                <div class="product-card__favourite">
                                    <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                                                <span class="button__icon button__icon--big">
                                                                    <svg class="icon icon--heart">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                                    </svg>
                                                                </span>
                                    </button>
                                </div>

                                <div class="product-card__wrapper">
                                    <div class="product-card__image box box--circle">
                                        <div class="product-card__box">
                                            <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card__content">
                                <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                                <p class="product-card__article">Арт. СХ-С-456013</p>

                                <div class="product-card__packs product-card__packs--desktop packs">
                                    <ul class="packs__list">
                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11p" value="r11" id="radio11p" checked>
                                                    <label for="radio11p">
                                                        <div class="pack__item">600 г</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11p" value="r22" id="radio22p">
                                                    <label for="radio22p">
                                                        <div class="pack__item">1 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11p" value="r33" id="radio33p">
                                                    <label for="radio33p">
                                                        <div class="pack__item">3 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11p" value="r44" id="radio44p">
                                                    <label for="radio44p">
                                                        <div class="pack__item">5 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11p" value="r55" id="radio55p">
                                                    <label for="radio55p">
                                                        <div class="pack__item">7 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11p" value="r66" id="radio66p">
                                                    <label for="radio66p">
                                                        <div class="pack__item">10 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11p" value="r77" id="radio77p">
                                                    <label for="radio77p">
                                                        <div class="pack__item">15 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-card__packs product-card__packs--mobile">
                                    <div class="select select--mini" data-select>
                                        <select class="select__control" name="select1p" id="select1p" data-select-control data-placeholder="Выберите фасовку" data-option>
                                            <option><!-- пустой option для placeholder --></option>
                                            <option value="1">600 г</option>
                                            <option value="2">1 кг</option>
                                            <option value="3">3 кг</option>
                                            <option value="4">5 кг</option>
                                            <option value="5">7 кг</option>
                                            <option value="6">10 кг</option>
                                            <option value="7">15 кг</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card__footer">
                                <div class="product-card__price price">
                                    <p class="price__main">1 545 ₽</p>
                                    <div class="price__calculation">
                                        <p class="price__calculation-total">1 420 ₽</p>
                                        <p class="price__calculation-accumulation">14 ББ</p>
                                    </div>
                                </div>

                                <div class="product-card__cart">
                                    <div class="quantity" data-quantity>
                                        <div class="quantity__button" data-quantity-button>
                                            <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--basket">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                            </svg>
                                                                        </span>
                                                <span class="button__text">В корзину</span>
                                            </button>
                                        </div>

                                        <div class="quantity__actions">
                                            <div class="quantity__decrease">
                                                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                                            <span class="button__icon button__icon--small">
                                                                                <svg class="icon icon--minus">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                                </svg>
                                                                            </span>
                                                </button>
                                            </div>

                                            <div class="quantity__total">
                                                                        <span class="quantity__total-icon">
                                                                            <svg class="icon icon--basket">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                            </svg>
                                                                        </span>
                                                <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                            </div>

                                            <div class="quantity__increase">
                                                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                                            <span class="button__icon button__icon--small">
                                                                                <svg class="icon icon--plus">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                                </svg>
                                                                            </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>

                    <li class="product-cards__item">
                        <article class="product-card box box--circle box--hovering box--grayish">
                            <a href="#" class="product-card__link"></a>
                            <div class="product-card__header">
                                <div class="product-card__favourite">
                                    <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                                                <span class="button__icon button__icon--big">
                                                                    <svg class="icon icon--heart">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                                    </svg>
                                                                </span>
                                    </button>
                                </div>

                                <div class="product-card__wrapper">
                                    <div class="product-card__image box box--circle">
                                        <div class="product-card__box">
                                            <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card__content">
                                <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                                <p class="product-card__article">Арт. СХ-С-456013</p>

                                <div class="product-card__colors colors">
                                    <ul class="colors__list">
                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r1" id="radioc" checked>
                                                    <label for="radioc">
                                                        <div class="color__item color__item--pink"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r2" id="radio2c">
                                                    <label for="radio2c">
                                                        <div class="color__item color__item--blue"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio3c">
                                                    <label for="radio3c">
                                                        <div class="color__item color__item--green"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r4" id="radio4c">
                                                    <label for="radio4c">
                                                        <div class="color__item color__item--yellow"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio5c">
                                                    <label for="radio5c">
                                                        <div class="color__item color__item--red"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="colors__item">
                                            <div class="color">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio6c">
                                                    <label for="radio6c">
                                                        <div class="color__item color__item--violet"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-card__breed">
                                    <div class="select select--mini" data-select>
                                        <select class="select__control" name="select11m" id="select11m" data-select-control data-placeholder="Выберите размер" data-option>
                                            <option><!-- пустой option для placeholder --></option>
                                            <option value="1">Для всех пород</option>
                                            <option value="2">Мелкие породы</option>
                                            <option value="3">Средние породы</option>
                                            <option value="4">Крупные породы</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card__footer">
                                <div class="product-card__price price">
                                    <p class="price__main">1 545 ₽</p>
                                    <div class="price__calculation">
                                        <p class="price__calculation-total">1 420 ₽</p>
                                        <p class="price__calculation-accumulation">14 ББ</p>
                                    </div>
                                </div>

                                <div class="product-card__cart">
                                    <div class="quantity" data-quantity>
                                        <div class="quantity__button" data-quantity-button>
                                            <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--basket">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                            </svg>
                                                                        </span>
                                                <span class="button__text">В корзину</span>
                                            </button>
                                        </div>

                                        <div class="quantity__actions">
                                            <div class="quantity__decrease">
                                                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                                            <span class="button__icon button__icon--small">
                                                                                <svg class="icon icon--minus">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                                </svg>
                                                                            </span>
                                                </button>
                                            </div>

                                            <div class="quantity__total">
                                                                        <span class="quantity__total-icon">
                                                                            <svg class="icon icon--basket">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                            </svg>
                                                                        </span>
                                                <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                            </div>

                                            <div class="quantity__increase">
                                                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                                            <span class="button__icon button__icon--small">
                                                                                <svg class="icon icon--plus">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                                </svg>
                                                                            </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>

                    <li class="product-cards__item">
                        <article class="product-card box box--circle box--hovering box--grayish">
                            <a href="#" class="product-card__link"></a>
                            <div class="product-card__header">
                                <div class="product-card__label label label--pink">сезонное предложение</div>

                                <div class="product-card__favourite">
                                    <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                                                <span class="button__icon button__icon--big">
                                                                    <svg class="icon icon--heart">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                                    </svg>
                                                                </span>
                                    </button>
                                </div>

                                <div class="product-card__wrapper">
                                    <div class="product-card__image box box--circle">
                                        <div class="product-card__box">
                                            <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card__content">
                                <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                                <p class="product-card__article">Арт. СХ-С-456013</p>

                                <div class="product-card__packs product-card__packs--desktop packs">
                                    <ul class="packs__list">
                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11" value="r11" id="radio111p" checked>
                                                    <label for="radio111p">
                                                        <div class="pack__item">600 г</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11" value="r22" id="radio221p">
                                                    <label for="radio221p">
                                                        <div class="pack__item">1 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11" value="r33" id="radio331p">
                                                    <label for="radio331p">
                                                        <div class="pack__item">3 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11" value="r44" id="radio441p">
                                                    <label for="radio441p">
                                                        <div class="pack__item">5 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11" value="r55" id="radio551p">
                                                    <label for="radio551p">
                                                        <div class="pack__item">7 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11" value="r66" id="radio661p">
                                                    <label for="radio661p">
                                                        <div class="pack__item">10 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="packs__item">
                                            <div class="pack">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio11" value="r77" id="radio771p">
                                                    <label for="radio771p">
                                                        <div class="pack__item">15 кг</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-card__packs product-card__packs--mobile">
                                    <div class="select select--mini" data-select>
                                        <select class="select__control" name="select11p" id="select11p" data-select-control data-placeholder="Выберите фасовку" data-option>
                                            <option><!-- пустой option для placeholder --></option>
                                            <option value="1">600 г</option>
                                            <option value="2">1 кг</option>
                                            <option value="3">3 кг</option>
                                            <option value="4">5 кг</option>
                                            <option value="5">7 кг</option>
                                            <option value="6">10 кг</option>
                                            <option value="7">15 кг</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card__footer">
                                <div class="product-card__price price">
                                    <p class="price__main">1 545 ₽</p>
                                    <div class="price__calculation">
                                        <p class="price__calculation-total">1 420 ₽</p>
                                        <p class="price__calculation-accumulation">14 ББ</p>
                                    </div>
                                </div>

                                <div class="product-card__cart">
                                    <div class="quantity quantity--active" data-quantity>
                                        <div class="quantity__button" data-quantity-button>
                                            <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--basket">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                            </svg>
                                                                        </span>
                                                <span class="button__text">В корзину</span>
                                            </button>
                                        </div>

                                        <div class="quantity__actions">
                                            <div class="quantity__decrease">
                                                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                                            <span class="button__icon button__icon--small">
                                                                                <svg class="icon icon--minus">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                                </svg>
                                                                            </span>
                                                </button>
                                            </div>

                                            <div class="quantity__total">
                                                                        <span class="quantity__total-icon">
                                                                            <svg class="icon icon--basket">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                            </svg>
                                                                        </span>
                                                <span class="quantity__total-sum" data-quantity-sum="2">2</span>
                                            </div>

                                            <div class="quantity__increase">
                                                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                                            <span class="button__icon button__icon--small">
                                                                                <svg class="icon icon--plus">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                                </svg>
                                                                            </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>
                    <?
                }

				unset($generalParams);
			}
			?>
            <!-- items-container -->
		</ul>
        <?
		$signer = new \Bitrix\Main\Security\Sign\Signer;
		$signedTemplate = $signer->sign($templateName, 'catalog.section');
		$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
		?>

	</div>
    <!--<div data-entity="lazy-<?/*=$containerName*/?>">
        <button type="button"
                class="catalog__button button button--rounded-big button--outlined button--green button--full"
                data-use="show-more-<?/*=$navParams['NavNum']*/?>"
        >Показать больше</button>
    </div>-->
    <script>
        BX.message({
            BASKET_URL: '<?=$arParams['BASKET_URL']?>',
            RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
            RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
            BTN_MESSAGE_LAZY_LOAD: '<?=CUtil::JSEscape($arParams['MESS_BTN_LAZY_LOAD'])?>',
            SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
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
            container: '<?=$containerName?>'
        });
    </script>
</div>
<!-- component-end -->