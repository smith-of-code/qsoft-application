<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}
Loc::loadMessages(__FILE__);
/**
 * @var array $arResult
 * @var array $arParams
 * @var array $templateData
 */

$currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<div class="profile__block accordeon__item" data-accordeon="">
    <section class="section">
        <div class="section__box box box--gray box--rounded-sm">
            <div class="profile__accordeon-header accordeon__header section__header">
                <h4 class="section__title section__title--closer">Реферальные ссылки</h4>

                <div class="profitability__hint" data-tippy-html="">
                    <svg class="icon icon--question-circle">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                    </svg>

                    <div style="display: none;" data-tippy-template="">
                        <div class="profitability__tooltip">
                            <p class="profitability__tooltip-title">Вы можете поделиться своей персональной ссылкой на сайт или на регистрацию в качестве покупателя или консультанта. Все новые покупатели или консультанты, пришедшие по ссылке и прошедшие регистрацию, попадут в первый уровень Вашей структуры.</p>


                        </div>
                    </div>
                </div>
            </div>

            <div class="profile__accordeon-body accordeon__body--closer" data-accordeon-content="">
                <?php foreach ($arResult['ref_links'] as $item): ?>

                    <div class="reflink">
                        <p class="reflink__title"><?=$item['title'] ?></p>
                        <div class="reflink__box">
                            <a class="reflink__link" onclick="event.preventDefault();" href="<?=$item['link'] ?>"><?=$item['link'] ?></a>
                            <button class="reflink__button">Скопировать</button>
                        </div>
                    </div>

                <?php endforeach;  ?>
            </div>
        </div>
    </section>
</div>

<script>
    $('.reflink__box').click(e=>{
        $('.reflink__box').removeClass( 'active' )
        $('.reflink__box .reflink__button').removeClass( 'active' ).text('Скопировать')

        let button = e.currentTarget.querySelector('.reflink__button')
        let link =  e.currentTarget.querySelector('.reflink__link').getAttribute('href')

        e.currentTarget.classList.add('active')
        button.classList.add('active')
        button.innerHTML = 'Скопировано'

        navigator.clipboard.writeText(link)

    })
</script>