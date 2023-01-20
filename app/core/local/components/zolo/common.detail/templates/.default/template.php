<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetTitle($arResult['ITEM']['NAME']);
$APPLICATION->AddChainItem($arResult['ITEM']['NAME']);

$APPLICATION->IncludeComponent(
    'bitrix:breadcrumb',
    '',
    [
        'PATH' => '',
        'SITE_ID' => '',
        'START_FROM' => '0',
    ],
    false
);
?>

<div class="content__main content__main--separated detail-articles__content">
    <section class="section events__section">
        <div class="detail-articles__header section__header">
            <h2 class="detail-articles__title section__title">
                <?=$arResult['ITEM']['NAME']?>
            </h2>
            <div class="detail-articles__date"><?=$arResult['ITEM']['PUBLISHED_AT']?></div>
        </div>

        <div class="detail-articles__image detail-articles__image--main">
            <div class="detail-articles__label label label--secondary label--<?=$arResult['ITEM']['MARKER_COLOR']?>">
                <?=$arResult['ITEM']['MARKER_NAME']?>
            </div>
            <img class="detail-articles__image-picture" src="<?=$arResult['ITEM']['DETAIL_PICTURE']?>" alt="">
        </div>

        <p>
            <?=$arResult['ITEM']['PREVIEW_TEXT']?>
        </p>
        <p>
            <?=$arResult['ITEM']['DETAIL_TEXT']?>
        </p>
    </section>
</div>
