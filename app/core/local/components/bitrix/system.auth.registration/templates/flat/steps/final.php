<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die;
/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */
?>

<section class="section section--limited-big">
    <div class="registration__notification notification">
        <div class="notification__icon">
            <svg class="icon icon--tick-circle">
                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
            </svg>
        </div>

        <h4 class="notification__title">
            Заявка успешно отправлена!
        </h4>

        <p class="notification__text">
            Ваша заявка на восстановление пароля отправлена. Проверьте вашу электронную почту.
        </p>
    </div>
</section>