<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

if (isset($arResult['ITEM']))
{
    /**
     * @var array Общие данные о продукте и его торговых предложениях
     */
    $item = $arResult['ITEM'];

	$currentUser = currentUser();

	$productTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $item['NAME'];

	$imgTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $item['NAME'];

    // Идентификаторы для работы с DOM-элементами карточки товара
    // Добавляем префикс, чтобы идентификаторы элементов карточек не пересекались
    $elementId = 'ob_' . preg_replace("/[^a-zA-Z0-9_]/", "x", $arResult['AREA_ID']);
    $elementIdPrefix =  $elementId . '-';
    $domElementsIds = [
        'label' => $elementIdPrefix . 'label',
        'favouriteButton' => $elementIdPrefix . 'favouriteButton',
        'image' => $elementIdPrefix . 'image',
        'title' => $elementIdPrefix . 'title',
        'article' => $elementIdPrefix . 'article',
        'mainPrice' => $elementIdPrefix . 'mainPrice',
        'totalPrice' => $elementIdPrefix . 'totalPrice',
        'bonuses' => $elementIdPrefix . 'bonuses',
    ];

    // Формируем массив данных о торговых предложениях для обновления данных карточки через JS
    $jsInfo = [
        'id' => $elementId,
        'elementsIds' => $domElementsIds,
    ];

    foreach ($item['OFFERS'] as $offer) {
        $jsInfo['offers'][$offer['ID']]['id'] = $offer['ID'];
        // Артикул
        if (isset($offer['PROPERTIES']['ARTICLE']['VALUE'])) {
            $jsInfo['offers'][$offer['ID']]['article'] = 'Арт. ' . $offer['PROPERTIES']['ARTICLE']['VALUE'];
        }
        // Атрибут акционного товара
        if (isset($offer['PROPERTIES']['DISCOUNT_LABEL']['VALUE'])) {
            $jsInfo['offers'][$offer['ID']]['label'] = $offer['PROPERTIES']['DISCOUNT_LABEL']['VALUE_XML_ID'];
        }
        // Параметры цен и баллов
        $jsInfo['offers'][$offer['ID']]['mainPrice'] = $offer['BASE_PRICE'];
        $jsInfo['offers'][$offer['ID']]['totalPrice'] = $offer['PRICE'];
        $jsInfo['offers'][$offer['ID']]['bonuses'] = $offer['BONUSES'];

        // Параметры торговых предложений
        $jsInfo['offers'][$offer['ID']]['tree'] = $offer['TREE'];
        $jsInfo['offers'][$offer['ID']]['available'] = $offer['CAN_BUY'];
        $jsInfo['offers'][$offer['ID']]['quantity'] = $offer['CATALOG_QUANTITY'];
        $jsInfo['offers'][$offer['ID']]['inWishlist'] = (bool) $offer['IN_WISHLIST'];
        $jsInfo['offers'][$offer['ID']]['nonreturnable'] = (bool) $item['PROPERTIES']['NONRETURNABLE_PRODUCT']['VALUE'];
    }

    $actualItem = reset($jsInfo['offers']);
    ?>
    <li class="product-cards__item<?= $arParams['EXPANDABLE']['CONTAINER_CLASS'] ? ' ' . $arParams['EXPANDABLE']['CONTAINER_CLASS'] : '' ?>"
        id="<?=$arResult['AREA_ID']?>"
        data-entity="item"
        <?= $arParams['EXPANDABLE']['CONTAINER_DATA'] ?? ''?>
    >
        <article class="product-card box box--circle box--hovering box--grayish" id="<?=$jsInfo['id']?>">

            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="product-card__link"></a>

            <div class="product-card__header">
                <div id="<?=$domElementsIds['label'] . '_SEASONAL_OFFER'?>"
                     class="product-card__label label label--pink"
                     style="<?= $actualItem['showLabel'] === 'SEASONAL_OFFER' ? '' : 'display: none;'?>"
                >сезонное предложение</div>
                <div id="<?=$domElementsIds['label'] . '_LIMITED_OFFER'?>"
                     class="product-card__label label label--violet"
                     style="<?= $actualItem['showLabel'] === 'LIMITED_OFFER' ? '' : 'display: none;'?>"
                >ограниченное предложение</div>

                <!-- Кнопка "Добавить в избранное" -->
                <?php if ($USER->IsAuthorized()):?>
                    <div class="product-card__favourite">
                        <button id="<?=$domElementsIds['favouriteButton']?>" type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                            <span class="button__icon button__icon--big">
                                <svg class="icon">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                </svg>
                            </span>
                        </button>
                    </div>
                <?php endif;?>
                <!-- Кнопка "Добавить в избранное" -->

                <!-- Картинка товара -->
                <div class="product-card__wrapper">
                    <div class="product-card__image box box--circle">
                        <div class="product-card__box">
                            <img id="<?=$domElementsIds['image']?>" src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $imgTitle ?>" class="product-card__pic">
                        </div>
                    </div>
                </div>
                <!-- Картинка товара -->
            </div>

            <div class="product-card__content">
                <h6 id="<?=$domElementsIds['title']?>" class="product-card__title"><?= $productTitle ?></h6>
                <p id="<?=$domElementsIds['article']?>" class="product-card__article"><?=$actualItem['article'] ?? ''?></p>

                <?php if (isset($arParams['SKU_PROPS']['COLOR']) && $item['OFFERS_PROP']['COLOR']):
                    $offerPropId = $arParams['SKU_PROPS']['COLOR']['ID'];
                    $propName = $elementIdPrefix . 'PROP_' . $offerPropId;
                    ?>
                    <?php if (is_numeric(array_key_first($item['SKU_TREE_VALUES'][$offerPropId]))):
                    // Записываем параметры элемента ввода для дальнейшего удобного обращения через JS
                    $jsInfo['elementsIds']['props']['PROP_' . $offerPropId]['desktop']['name'] = $propName;
                    $jsInfo['elementsIds']['props']['PROP_' . $offerPropId]['desktop']['type'] = 'radio';
                    ?>
                        <div class="product-card__colors colors">
                            <ul class="colors__list">
                                <? foreach ($arParams['SKU_PROPS']['COLOR']['VALUES'] as $value):
                                    if ($value['ID'] === 0) continue; // Пропускаем значение-плейсхолдер
                                    if (! $item['SKU_TREE_VALUES'][$offerPropId][$value['ID']]) continue; // Пропускаем значения, по которым не существует торговых предложений
                                    $propId = $propName . '_' . $value['ID'];
                                    $isChecked = $actualItem['tree']['PROP_' . $offerPropId] === $value['ID'];
                                    ?>
                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio"
                                                       class="color__input radio__input"
                                                       autocomplete="off"
                                                       name="<?=$propName?>"
                                                       value="<?=$value['ID']?>"
                                                       id="<?=$propId?>"
                                                       <?= $isChecked ? 'checked' : '' ?>
                                                       onchange="window.CatalogItemHelperZolo.refreshProductCard(<?=CUtil::PhpToJSObject($jsInfo['id'], false, true)?>, this)"
                                                >
                                                <label for="<?=$propId?>">
                                                    <div class="color__item">
                                                        <div class="color__item-wrapper">
                                                            <img src="<?=$value['PICT']['SRC']?>"
                                                                 class="color__item-pic">
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($arParams['SKU_PROPS']['SIZE']) && $item['OFFERS_PROP']['SIZE']):
                    $offerPropId = $arParams['SKU_PROPS']['SIZE']['ID'];
                    $propName = $elementIdPrefix . 'PROP_' . $offerPropId;
                    ?>
                    <?php if (is_numeric(array_key_first($item['SKU_TREE_VALUES'][$offerPropId]))):
                    // Записываем параметры элемента ввода для дальнейшего удобного обращения через JS
                    $jsInfo['elementsIds']['props']['PROP_' . $offerPropId]['desktop']['name'] = $propName;
                    $jsInfo['elementsIds']['props']['PROP_' . $offerPropId]['desktop']['type'] = 'select';
                    // Сортируем по ключу (ID значения);
                    ksort($arParams['SKU_PROPS']['SIZE']['VALUES']);
                    ?>
                        <div class="product-card__breed">
                            <div class="select select--mini" data-select>
                                <select class="select__control"
                                        name="<?=$propName?>"
                                        id="<?=$propName?>"
                                        autocomplete="off"
                                        data-select-control
                                        data-option
                                        onchange="window.CatalogItemHelperZolo.refreshProductCard(<?=CUtil::PhpToJSObject($jsInfo['id'], false, true)?>, this)"
                                >
                                    <? foreach ($arParams['SKU_PROPS']['SIZE']['VALUES'] as $value):
                                        if ($value['ID'] === 0) continue; // Пропускаем значение-плейсхолдер
                                        if (! $item['SKU_TREE_VALUES'][$offerPropId][$value['ID']]) continue; // Пропускаем значения, по которым не существует торговых предложений
                                        $isSelected = $actualItem['tree']['PROP_' . $offerPropId] === $value['ID'];
                                        ?>
                                        <option value="<?=$value['ID']?>"
                                                <?= $isSelected ? 'selected' : ''?>
                                        ><?=$value['NAME']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (isset($arParams['SKU_PROPS']['PACKAGING']) && $item['OFFERS_PROP']['PACKAGING']):
                    $offerPropId = $arParams['SKU_PROPS']['PACKAGING']['ID'];
                    $propName = $elementIdPrefix . 'PROP_' . $offerPropId;
                    ?>
                    <?php if (is_numeric(array_key_first($item['SKU_TREE_VALUES'][$offerPropId]))):
                    // Записываем параметры элемента ввода для дальнейшего удобного обращения через JS
                    $jsInfo['elementsIds']['props']['PROP_' . $offerPropId]['desktop']['name'] = $propName;
                    $jsInfo['elementsIds']['props']['PROP_' . $offerPropId]['desktop']['type'] = 'radio';
                    ?>
                        <div class="product-card__packs product-card__packs--desktop packs">
                        <ul class="packs__list">
                            <? foreach ($arParams['SKU_PROPS']['PACKAGING']['VALUES'] as $value):
                                if ($value['ID'] === 0) continue; // Пропускаем значение-плейсхолдер
                                if (! $item['SKU_TREE_VALUES'][$offerPropId][$value['ID']]) continue; // Пропускаем значения, по которым не существует торговых предложений
                                $propId = $propName . '_' . $value['ID'];
                                $isChecked = $actualItem['tree']['PROP_' . $offerPropId] === $value['ID'];
                                ?>
                                <li class="packs__item">
                                    <div class="pack">
                                        <div class="radio">
                                            <input type="radio"
                                                   class="pack__input radio__input"
                                                   name="<?=$propName?>"
                                                   autocomplete="off"
                                                   value="<?=$value['ID']?>"
                                                   id="<?=$propId?>"
                                                   <?= $isChecked ? 'checked' : '' ?>
                                                   onchange="window.CatalogItemHelperZolo.refreshProductCard(<?=CUtil::PhpToJSObject($jsInfo['id'], false, true)?>, this)"
                                            >
                                            <label for="<?=$propId?>">
                                                <div class="pack__item"><?=$value['NAME']?></div>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php
                    // Задаем название input с суффиксом для дублирующего поля в мобильной версии
                    $propName = $elementIdPrefix . 'PROP_' . $offerPropId . '_M';
                    ?>
                    <?php if (is_numeric(array_key_first($item['SKU_TREE_VALUES'][$offerPropId]))):
                    // Записываем параметры элемента ввода для дальнейшего удобного обращения через JS
                    $jsInfo['elementsIds']['props']['PROP_' . $offerPropId]['mobile']['name'] = $propName;
                    $jsInfo['elementsIds']['props']['PROP_' . $offerPropId]['mobile']['type'] = 'select';
                    ?>
                        <div class="product-card__packs product-card__packs--mobile">
                        <div class="select select--mini" data-select>
                            <select class="select__control"
                                    name="<?=$propName?>"
                                    id="<?=$propName?>"
                                    data-select-control
                                    autocomplete="off"
                                    data-option
                                    onchange="window.CatalogItemHelperZolo.refreshProductCard(<?=CUtil::PhpToJSObject($jsInfo['id'], false, true)?>, this, true)"
                            >
                                <? foreach ($arParams['SKU_PROPS']['PACKAGING']['VALUES'] as $value):
                                    if ($value['ID'] === 0) continue; // Пропускаем значение-плейсхолдер
                                    if (! $item['SKU_TREE_VALUES'][$offerPropId][$value['ID']]) continue; // Пропускаем значения, по которым не существует торговых предложений
                                    $isSelected = $actualItem['tree']['PROP_' . $offerPropId] === $value['ID'];
                                    ?>
                                    <option value="<?=$value['ID']?>"
                                            <?= $isSelected ? 'selected' : ''?>
                                    ><?=$value['NAME']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="product-card__footer">
                <div class="product-card__price price">
                    <p id="<?=$domElementsIds['mainPrice']?>"
                       class="price__main"
                       style="<?= $actualItem['mainPrice'] ? '' : 'display: none;' ?>"
                    >
                        <?=$actualItem['mainPrice']?>
                    </p>
                    <div class="price__calculation">
                        <p id="<?=$domElementsIds['totalPrice']?>"
                           class="price__calculation-total">
                            <?=$actualItem['totalPrice']?>
                        </p>
                        <p id="<?=$domElementsIds['bonuses']?>"
                           class="price__calculation-accumulation"
                           style="<?= $actualItem['bonuses'] ? '' : 'display: none;' ?>"
                        >
                            <?=$actualItem['bonuses']?>
                        </p>
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
                                <span class="quantity__total-sum" data-quantity-sum="0" data-quantity-max="10">0</span>
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
        <script>
            window.CatalogItemHelperZolo.addProduct(<?=CUtil::PhpToJSObject($jsInfo, false, true)?>);
        </script>
    </li>
	<?
	unset($item, $actualItem, $jsInfo);
}
