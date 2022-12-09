<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<section class="about__cert section section--margin-xl">
    <div class="about__cert-box section__box box">
        <h3 class="about__cert-title section__title section__title--closer section__title--small">
            <?=$arResult['title']?>
        </h3>

        <div class="about__cert-list documents">
            <?php foreach ($arResult['documents'] as $document):?>
                <div class="about__cert-item documents__item">
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
</section>