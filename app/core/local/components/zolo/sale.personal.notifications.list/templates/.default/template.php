<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<script>
    let offset = <?=$arResult['OFFSET']?>;
    let filter = {'period': 30};
    let limit = offset;
    const BASE_LIMIT = offset;
</script>

<h1 class="page__heading">Личный кабинет</h1>
<div class="content__main">
    <div class="private__row">
        <div class="private__col private__col--limited">
            <?php
                $APPLICATION->IncludeComponent(
                    'zolo:personal.main.profile.navigation_menu',
                    '',
                );
            ?>
        </div>
        <div class="private__col private__col--full">
            <div class="notifications">
                <h3 class="notifications__title">Уведомления</h3>
                <div class="notifications__cards cards-notify">
                    <ul class="notifications__list cards-notify__list">
                    <?php foreach ($arResult['NOTIFICATIONS'] as $notification): ?>
                        <li class="cards-notify__item">
                            <article class="card-notify card-notify--<?=$notification['STATUS'] == 'прочитано' ? "green" : "orange"?>">
                                <a href="#" class="card-notify__link"></a>
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
                                        <time class="card-notify__send" datetime="2022-07-27 13:24">
                                            <span class="card-notify__send-status">Отправлено</span>
                                            <span class="card-notify__send-date"><?=$notification['DATE']?></span>
                                            <span class="card-notify__send-time"><?=$notification['TIME']?></span>
                                        </time>

                                        <div class="card-notify__status">
                                                    <span class="card-notify__status-mark">
                                                        <svg class="card-notify__status-icon icon icon--tick-circle-bold">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle-bold"></use>
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
                        <?php endforeach;?>
                    </ul>
                    <button type="button" class="notifications__button-more button button--full button--rounded button--covered button--white-green">
                        Показать больше
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--content-->