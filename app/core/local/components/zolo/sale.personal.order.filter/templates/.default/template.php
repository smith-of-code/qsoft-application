<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="content__filter filter filter--content">
    <form class="form form--wraped form--separated form--wraped-small">
        <div class="form__row">
            <div class="form__col">
                <div class="form__field">
                    <div class="form__field-block form__field-block--input">
                        <div class="input input--small input--squared input--buttoned">
                            <input type="text" class="input__control" name="text" id="text5" placeholder="Я ищу...">
                            <button type="button" class="input__button input__button--search button button--iconed button--covered button--square button--dark">
                                <span class="button__icon button__icon--medium">
                                    <svg class="icon icon--search">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-search"></use>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form__row form__row--merged">
            <div class="form__col form__col--definite">
                <div class="form__field">
                    <div class="form__field-block form__field-block--input">
                        <div class="form__control">
                            <div class="filter__select select select--mitigate select--small select--squared select--multiple" data-select>
                                <select class="select__control" name="STATUS" id="STATUS" data-select-control data-placeholder="Статус заказа" multiple>
                                    <option><!-- пустой option для placeholder --></option>
                                    <? foreach ($arResult['STATUS'] as $code => $name): ?>
                                        <option value="<?=$code ?>"><?=$name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__col form__col--definite">
                <div class="form__field">
                    <div class="form__field-block form__field-block--input">
                        <div class="form__control">
                            <div class="filter__select select select--mitigate select--small select--squared" data-select>
                                <select class="select__control" name="PAYD" id="PAYD" data-select-control data-placeholder="Статус оплаты">
                                    <option><!-- пустой option для placeholder --></option>
                                    <?php foreach ($arResult['PAYMENT'] as $code => $name): dump($code, $name);?>
                                        <option value="<?=$code ?>"><?=$name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Подключил блок с сортировкой тут ввиду особености реализации верстки -->
            <?$APPLICATION->IncludeComponent("zolo:sale.personal.order.sort", "", []);?>
        </div>
    </form>
</div>