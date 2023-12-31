<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\Localization\Loc;

$loginLink = '/login/';

$isAuthorized = $arResult['IS_AUTHORIZED'];
?>

<main class="page__faq faq">
    <div class="breadcrumbs">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item">
                <a href="/" class="breadcrumbs__link">Главная</a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--active">
                <a class="breadcrumbs__link">FAQ</a>
            </li>
        </ul>
    </div>

    <h1 class="page__heading faq__heading"><?=Loc::getMessage('FAQ_TITLE')?></h1>

    <div class="content__main faq__content">
        <div class="faq__wrapper">
            <section class="faq__questions questions">
                <?php foreach ($arResult['GROUPS'] as $group) : ?>
                <p><a name="<?=strtolower(substr($group['XML_ID'], strlen('GROUP_')))?>"></a></p>
                <div class="questions__item">
                    <div class="question">
                        <h3 class="question__theme"><?=$group['VALUE']?></h3>
                        <div class="question__accordeon accordeon">
                            <?php $i = 1;
                            foreach ($group['questions'] as $question) : ?>
                            <div class="accordeon__item box box--rounded-sm box--hovering" data-accordeon data-accordeon-toggle>
                                <div class="accordeon__header">
                                    <h5 class="question__accordeon-title accordeon__title">
                                        <span class="question__accordeon-number"><?=$i?>.</span>
                                        <?=$question['UF_QUESTION']?>
                                    </h5>

                                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white" >
                                                <span class="accordeon__toggle-icon button__icon">
                                                    <svg class="icon icon--arrow-down">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                    </svg>
                                                </span>
                                    </button>

                                </div>

                                <div class="accordeon__body accordeon__body--bordered" data-accordeon-content>
                                    <?=$question['UF_ANSWER']?>
                                </div>
                            </div>
                            <?php $i++;
                            endforeach;?>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </section>
            <div class="faq__setask setask">
                <div class="setask__image">
                    <svg class="setask__image-picture icon icon--cat-think">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-think"></use>
                    </svg>
                </div>
                <p class="setask__text"><?=Loc::getMessage('FAQ_SUPPORT_NOT_FOUND')?></p>
                <p class="setask__subtext"><?=Loc::getMessage('FAQ_SUPPORT_MESSAGE_US')?></p>
                <a class="setask__button button button--rounded button--covered button--green button--full"
                <?=$isAuthorized
                   ? 'href="javascript:" data-fancybox data-type="ajax" data-modal-type="modal" aria-label="' . Loc::getMessage('FAQ_SUPPORT_ASK_US') . '" 
                   data-src="/ajax/popup/popup-support.php"'
                   : 'onClick="window.location.href = \'/login/\';"'?>
                   >
                    <span class="page__headline-button-text" data-src="/ajax/popup/popup-support.php">
                        <?= Loc::getMessage('FAQ_SUPPORT_ASK_US') ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</main>
