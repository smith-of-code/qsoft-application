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
    /**
     * @var array Текущее торговое предложение
     */
    $actualItem = isset($item['OFFERS'][$item['OFFERS_SELECTED']])
        ? $item['OFFERS'][$item['OFFERS_SELECTED']]
        : reset($item['OFFERS']);

	$areaId = $arResult['AREA_ID'];
	$currentUser = currentUser();
	$hasDiscount = (int) $actualItem['ITEM_PRICES'][0]['DISCOUNT'] > 0;

	$productTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $item['NAME'];

	$imgTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $item['NAME'];



    //dump('JS_OFFERS', $item['JS_OFFERS']);
    //dump('params', $arParams);
    //dump($actualItem);
    ?>
    <li class="product-cards__item" id="<?=$areaId?>" data-entity="item">
        <article class="product-card box box--circle box--hovering box--grayish">

            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="product-card__link"></a>

            <div class="product-card__header">
                <?php if (isset($actualItem['PROPERTIES']['DISCOUNT_LABEL']['VALUE'])): ?>
                    <?php if ($actualItem['PROPERTIES']['DISCOUNT_LABEL']['VALUE_XML_ID'] == "SEASONAL_OFFER"): ?>
                        <div class="product-card__label label label--pink">сезонное предложение</div>
                    <?php elseif ($actualItem['PROPERTIES']['DISCOUNT_LABEL']['VALUE_XML_ID'] == "LIMITED_OFFER"): ?>
                        <div class="product-card__label label label--violet">ограниченное предложение</div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Кнопка "Добавить в избранное" -->
                <div class="product-card__favourite">
                    <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                        <span class="button__icon button__icon--big">
                            <svg class="icon">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                            </svg>
                        </span>
                    </button>
                </div>
                <!-- Кнопка "Добавить в избранное" -->

                <!-- Картинка товара -->
                <div class="product-card__wrapper">
                    <div class="product-card__image box box--circle">
                        <div class="product-card__box">
                            <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $imgTitle ?>" class="product-card__pic">
                        </div>
                    </div>
                </div>
                <!-- Картинка товара -->
            </div>

            <div class="product-card__content">
                <h6 class="product-card__title"><?= $productTitle ?></h6>

                <p class="product-card__article">Арт. <?=$actualItem['PROPERTIES']['ARTICLE']['VALUE'] ?? ''?></p>

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
                    <?php if ($currentUser->groups->isConsultant()): ?>
                        <?php if ($hasDiscount): ?>
                            <p class="price__main"><?=$actualItem['ITEM_PRICES'][0]['PRINT_BASE_PRICE']?></p>
                        <?php endif; ?>
                        <div class="price__calculation">
                            <p class="price__calculation-total">
                                <?php if ($hasDiscount): ?>
                                    <?=$actualItem['ITEM_PRICES'][0]['PRINT_PRICE']?>
                                <?php else: ?>
                                    <?=$actualItem['ITEM_PRICES'][0]['PRINT_BASE_PRICE']?>
                                <?php endif; ?>
                            </p>
                            <?php if ($currentUser->loyaltyLevel && !empty($actualItem['PROPERTIES']['BONUSES_' . $currentUser->loyaltyLevel]['VALUE'])): ?>
                                <p class="price__calculation-accumulation"><?=$actualItem['PROPERTIES']['BONUSES_' . $currentUser->loyaltyLevel]['VALUE']?> ББ</p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
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
	<?
	unset($item, $actualItem, $minOffer);
}
