<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @var array $arResult
 */

use Bitrix\Main\Localization\Loc;
?>

<div class="personal__item personal__item--hidden">
    <div class="dropdown dropdown--long" data-dropdown>
        <button type="button" class="button button--simple button--red button--vertical"
                data-dropdown-button>
                        <span class="button__icon button__icon--mixed">
                            <svg class="icon icon--notification">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                            </svg>

                            <?php if ($arResult['UNREAD_COUNT']):?>
                                <span class="button__icon-counter button__icon-counter--red"><?=$arResult['UNREAD_COUNT']?></span>
                            <?php endif;?>
                        </span>

            <span class="personal__button-text button__text"><?=Loc::getMessage('NOTIFICATION_BUTTON')?></span>
        </button>

        <!--выпадающий список уведомлений-->
        <div class="notice dropdown__box dropdown__box--shifted dropdown__box--scrolled box box--shadow"
                data-dropdown-block>


            <?php if (!empty($arResult['NOTIFICATIONS'])):?>
                <div class="notice__content" data-scrollbar>
                    <ul class="notice__list">
                        <?php foreach ($arResult['NOTIFICATIONS'] as $notification): ?>
                            <li class="notice__item">
                                <!--Статус-->
                                <article class="status">
                                    <a href="<?=$notification['LINK']?>" id="<?=$notification['ID']?>" class="status__link"></a>
                                    <div class="status__header">
                                        <svg class="status__header-icon icon icon--notification">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                        </svg>

                                        <p class="status__header-heading heading heading--tiny"><?=$notification['TITLE']?></p>
                                    </div>

                                    <p class="status__info"><?=$notification['MESSAGE']?></p>

                                    <div class="status__footer">
                                        <span class="status__date"><?=$notification['DATE']?></span>
                                        <span class="status__time"> <?=$notification['TIME']?></span>
                                    </div>
                                </article>
                                <!--Статус-->
                            </li>
                        <?php endforeach?>
                    </ul>
                </div>

                <div class="notice__action">
                    <a href="<?=$arResult['NOTIFICATIONS_URL']?>"
                       class="button button--rounded-big button--bold button--outlined button--green button--full">
                        <?=Loc::getMessage('SHOW_ALL')?>
                    </a>
                </div>

            <?php else: ?>
            <div class="notice__no-message">
                <h5 class="notice__no-message-text">Новых уведомлений нет</h5>
            </div>
            <?php endif; ?>

        </div>
        <!--выпадающий список уведомлений-->
    </div>
</div>