<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<section class="about__info section section--margin-xl">
    <h2 class="about__info-title section__title section__title--medium">
        Правовая информация
    </h2>

    <div class="section__box box">
        <div class="accordeon">
            <?php foreach ($arResult as $title => $documents):?>
                <div class="accordeon__item box box--rounded-sm box--hovering" data-accordeon data-accordeon-toggle>
                    <div class="accordeon__header">
                        <h3 class="accordeon__title">
                            <?=$title?>:
                        </h3>

                        <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white" >
                            <span class="accordeon__toggle-icon button__icon">
                                <svg class="icon icon--arrow-down">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                </svg>
                            </span>
                        </button>

                    </div>

                    <div class="accordeon__body accordeon__body--simple" data-accordeon-content>
                        <div class="documents">
                            <?php foreach ($documents as $document):?>
                                <div class="documents__item">
                                    <div class="document document--column">
                                        <a href="<?=$document['src']?>" class="document__link" download>
                                            <div class="document__icon">
                                                <svg class="icon icon--pdf">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
                                                </svg>
                                            </div>
                                            <div class="document__text">
                                                <span class="document__text-name"><?=$document['name']?></span>
                                                <span class="document__text-size">(<?=$document['size']?>)</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</section>