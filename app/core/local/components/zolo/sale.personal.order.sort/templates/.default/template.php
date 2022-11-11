<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="form__col form__col--right form__col--definite">
    <div class="form__field">
        <div class="form__field-block form__field-block--input">
            <div class="form__control">
                <div class="filter__sort select select--small select--sorting select--borderless" data-select>
                    <div class="select__group">
                        <select class="select__control" name="SORTING" id="SORTING_BY" data-select-control data-placeholder="Сортировка">
                            <option><!-- пустой option для placeholder --></option>
                            <? foreach ($arResult['SORT'] as  $code => $name) : ?>
                                <option value="<?=$code?>"><?=$name?></option>
                            <?php endforeach; ?>
                        </select>

                        <button type="button" id="SORTING" class="input__button input__button--select button button--iconed button--covered button--square button--dark asc">
                            <span class="button__icon button__icon--medium">
                                <svg class="icon icon--sort">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-sort"></use>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
