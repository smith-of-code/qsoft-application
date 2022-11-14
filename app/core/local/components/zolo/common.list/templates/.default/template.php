<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

dump($arResult);
?>

<?php
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
    <section class="section news__section">
        <div class="section__header">
            <h2 class="section__title">
                Новости
            </h2>
        </div>

        <div class="cards-article">
            <ul class="cards-article__list">
                <?php foreach ($arResult['ITEMS'] as $item) :?>
                <li class="cards-article__item">
                    <article class="card-article card-article--green box box--hovering box--circle">
                        <a href="<?="detail/" . $item['ID']?>" class="card-article__link"></a>

                        <div class="card-article__inner">
                            <div class="card-article__banner">
                                <img
                                        src="<?=$item['PICTURE']?>"
                                        alt="Изображение - анонс новости"
                                        class="card-article__banner-image"
                                />
                            </div>

                            <div class="card-article__label label label--secondary label--green">
                                <?=$item['MARKER']?>
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
        <button type="button" class="news__more news__button button button--show button--rounded-big button--outlined button--green">
            Показать больше
        </button>
        <?php endif; ?>
    </section>
</div>
</main>
</div>
</div>
<!--content-->
<script>
    const IBLOCK_ID = <?=$arResult['IBLOCK_ID']?>;
    let offset = <?=$arResult['OFFSET']?>;
<script>

