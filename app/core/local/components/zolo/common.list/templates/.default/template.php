<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var $APPLICATION **/
/** @var $arResult **/

use Bitrix\Main\Localization\Loc;

$APPLICATION->IncludeComponent(
    'bitrix:breadcrumb',
    '',
    [
        'PATH' => '',
        'SITE_ID' => '',
        'START_FROM' => '0',
    ],
);?>

<div class="content__main content__main--separated">
    <section class="section common_section">
        <div class="section__header">
            <h2 class="section__title">
            </h2>
        </div>

        <div class="cards-article">
            <ul class="cards-article__list">
                <?php foreach ($arResult['ITEMS'] as $item) :?>
                <li class="cards-article__item">
                    <article class="card-article card-article--green box box--hovering box--circle">
                        <a href="<?=$item['DETAIL_URL']?>" class="card-article__link"></a>

                        <div class="card-article__inner">
                            <div class="card-article__banner">
                                <img
                                    src="<?=$item['PICTURE']?>"
                                    alt="<?=Loc::getMessage('ALT_PICTURE')?>"
                                    class="card-article__banner-image"
                                />
                            </div>

                            <div class="card-article__label label label--secondary label--<?=$item['MARKER_COLOR']?>">
                                <?=$item['MARKER_NAME']?>
                            </div>

                            <div class="card-article__content">

                                <h2 class="card-article__title">
                                    <?=$item['NAME']?>
                                </h2>

                                <p class="card-article__text">
                                    <?=$item['PREVIEW_TEXT']?>
                                </p>

                                <time class="card-article__send" datetime="<?=$item['PUBLISHED_AT']?>">
                                    <?=$item['PUBLISHED_AT']?>
                                </time>
                            </div>

                        </div>
                    </article>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php if (! $arResult['LAST']) :?>
        <button type="button" class="common-button button button--show button--rounded-big button--outlined button--green">
            <?=Loc::getMessage('SHOW_MORE_BUTTON')?>
        </button>
        <?php endif; ?>
    </section>
</div>
</main>
</div>
</div>

<script>
    const IBLOCK_ID = <?=$arResult['IBLOCK_ID']?>;
    offset = <?=json_encode($arResult['OFFSET'])?>;

    let templateType = {
        <?=IBLOCK_NEWS?>: {
            style: 'news',
            title: '<?=Loc::getMessage('TITLE_NEWS')?>',
        },
        <?=IBLOCK_EVENT?>: {
            style: 'events',
            title: '<?=Loc::getMessage('TITLE_EVENTS')?>',
        },
        <?=IBLOCK_EXPERT_ADVICE?>: {
            style: 'expert-advice',
            title: '<?=Loc::getMessage('TITLE_ADVICES')?>',
        },
    }
</script>


