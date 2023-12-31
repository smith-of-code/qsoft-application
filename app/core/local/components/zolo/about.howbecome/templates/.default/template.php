<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<section class="about__howbecome section section--margin-xl">
    <div class="about__howbecome-box section__box box">
        <h3 class="section__title section__title--small">
            Как стать консультантом
        </h3>
        <div class="about__howbecome-list">
            <div class="about__howbecome-row">
                <div class="about__howbecome-col">
                    <div class="about__howbecome-item">
                        <div class="about__howbecome-card">
                            <div class="about__howbecome-card-wrapper">
                                <div class="about__howbecome-card-picture">
                                    <img class="about__howbecome-card-images" src="/local/templates/.default/images/about-howbecome-mobile.png" alt="">
                                </div>
                            </div>
                            <h4 class="about__howbecome-card-title">
                                Команда профессионалов
                            </h4>
                            <p class="about__howbecome-card-text">
                                В нашей команде работают специалисты по питанию кошек и собак и ветеринарные эксперты. Мы стремимся работать с профессионалами и теми, кто близок нам по духу и любит свое дело. Надеемся, что Вы будете в их числе.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="about__howbecome-col about__howbecome-col--column">

                    <?php foreach ($arResult['documents'] as $index => $document):?>
                        <div class="about__howbecome-item about__howbecome-item--mini">
                            <div class="about__howbecome-card about__howbecome-card--mini">
                                <div class="about__howbecome-card-wrapper">
                                    <div class="document document--big">
                                        <a href="<?=$document['document']['src']?>" class="about__howbecome-card-document document__link" download>
                                            <div class="document__icon">
                                                <svg class="icon icon--pdf">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
                                                </svg>
                                            </div>
                                            <div class="document__text">
                                                <span class="document__text-name">Открыть</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="about__howbecome-card-content">
                                    <h4 class="about__howbecome-card-title">
                                        <?=$document['title']?>
                                    </h4>
                                    <p class="about__howbecome-card-text">
                                        <?=$index ? 'Выберите своего консультанта' : 'Ознакомьтесь подробнее с условиями сотрудничества'?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>

        <div class="about__howbecome-banner banner">
            <div class="banner__image">
                <img class="banner__image-picture" src="/local/templates/.default/images/howbecome-banner.png" alt="">
            </div>
            <div class="banner__inner">
                <p class="banner__text">
                    Получите все привилегии <br> AmeБизнес, став консультантом
                </p>
                <a href="<?=$arResult['is_authorized'] ? '/become_consultant' : '/login?register=yes&type=consultant'?>" class="banner__link button button--rounded button--covered button--red">
                    Стать консультантом
                </a>
            </div>
        </div>
    </div>
</section>