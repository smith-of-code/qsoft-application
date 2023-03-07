<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @var array $arResult
 */

use Bitrix\Main\Localization\Loc;

$APPLICATION->setTitle(Loc::getMessage("NOTIFICATIONS"));

const GREEN = "green", ORANGE = "orange";
?>

<div class="notifications">
    <h3 class="notifications__title"><?=Loc::getMessage("NOTIFICATIONS")?></h3>
    <div class="notifications__cards cards-notify">
        <ul class="notifications__list cards-notify__list">
        <?php foreach ($arResult['NOTIFICATIONS'] as $notification): ?>
            <li class="cards-notify__item">
                <article class="card-notify card-notify--<?=$notification['STATUS'] == Loc::getMessage("READ") ? GREEN : ORANGE?>">
                    <a href="<?=$notification['LINK']?>" id="<?=$notification['ID']?>" target="_blank" class="card-notify__link"></a>
                    <div class="card-notify__inner">
                        <header class="card-notify__header">
                            <div class="card-notify__mark">
                                <svg class="card-notify__mark-icon icon icon--notification">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                </svg>
                            </div>
                            <p class="card-notify__title">
                                <?=$notification['TITLE']?>
                            </p>
                        </header>
                        <div class="card-notify__message">
                            <p class="card-notify__text">
                                <?=$notification['MESSAGE']?>
                            </p>
                        </div>
                        <footer class="card-notify__footer">
                            <time class="card-notify__send">
                                <span class="card-notify__send-status"><?=Loc::getMessage("SEND")?></span>
                                <span class="card-notify__send-date"><?=$notification['DATE']?></span>
                                <span class="card-notify__send-time"><?=$notification['TIME']?></span>
                            </time>
                            <div class="card-notify__status">
                                <span class="card-notify__status-mark">
                                    <svg class="card-notify__status-icon icon icon--<?=$notification['STATUS'] == Loc::getMessage("READ") ? 'tick-circle-bold' : 'attention'?>">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-<?=$notification['STATUS'] == Loc::getMessage("READ") ? 'tick-circle-bold' : 'attention'?>"></use>
                                    </svg>
                                </span>
                                <p class="card-notify__status-text">
                                    <?=$notification['STATUS']?>
                                </p>
                            </div>
                        </footer>
                    </div>
                </article>
            </li>
        <?php endforeach?>
        </ul>
        <?php if (! $arResult['LAST']) {?>
            <button type="button" class="notifications__button-more button button--full button--rounded button--covered button--white-green">
                <?=Loc::getMessage("SHOW_MORE")?>
            </button>
        <? }?>
    </div>
</div>
        </div>
    </div>
</div>
<script>
    offset = <?=$arResult['OFFSET']?>;
    limit = offset;
    isLast = <?=json_encode($arResult['LAST'])?>;
</script>
