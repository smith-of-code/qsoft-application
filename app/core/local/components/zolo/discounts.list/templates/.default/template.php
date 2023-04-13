<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Localization\Loc;
?>
<main class="page__sales sales">
<?php
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
<h1 class="page__heading"><?=Loc::getMessage('DISCOUNTS')?></h1>
<div class="content__main">
    <div class="sales__wrapper">
        <div class="sales__section">
            <div class="sales__cards cards-sale">

                <ul class="cards-sale__list">
                    <?php foreach ($arResult['ITEMS'] as $item): ?>
                    <li class="cards-sale__item">
                        <article class="card-compilation card-compilation--sale card-compilation--gigantic card-compilation--grey box box--hovering box--circle">
                            <a href="<?=$item['CATALOG']?>" class="card-compilation__link"></a>
                            <div class="card-compilation__inner">

                                <div class="card-compilation__banner">
                                    <img
                                    src="<?=$item['PICTURE']?>"
                                    alt="<?=Loc::getMessage('NO_PICTURE_TEXT')?>"
                                    class="card-compilation__banner-image"/>
                                </div>

                                <?php if ($item['DISCOUNT']):?>
                                    <div class="card-compilation__label label label--primary label--red">
                                        <?=Loc::getMessage('DISCOUNT', ['#VALUE#' => $item['DISCOUNT']])?>
                                    </div>
                                <?php endif;?>

                                <div class="card-compilation__content">
                                    <p class="card-compilation__text">
                                      <span class="card-compilation__text-accent"><?=$item['ACCENT']?></span>
                                      <span class="sale-text"><?=$item['TEXT']?></span>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php if (! $arResult['LAST']) { ?>
            <button type="button" class="button button--show button--rounded-big button--outlined button--green">
                <?=Loc::getMessage('SHOW_MORE')?>
            </button>
            <? } ?>
        </div>
    </div>
</div>
</main>
</div>
</div>
<!--content-->
<script>
    let offset = <?=$arResult['OFFSET']?>;
</script>