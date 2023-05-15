<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<?php if (!empty($arResult)): ?>
    <div class="header__row header__row--nav">
        <div class="container">
            <div class="header__wrapper">
                <nav class="navigation">
                    <ul class="navigation__list">
                        <?php foreach ($arResult as $menuTab): ?>
                            <li class="navigation__item">
                                <a
                                        href="<?= $menuTab['LINK'] ?>"
                                    <?= $menuTab['PARAMS']['IMAGE'] ? '' : '' ?>
                                        class="navigation__button button button--simple <?=
                                            $menuTab['PARAMS']['ADDITIONAL_CLASS_TAG'] ?? 'button--red'
                                        ?>"
                                >
                                    <?php if ($menuTab['PARAMS']['IMAGE']): ?>
                                        <span class="button__icon">
                                        <svg class="icon icon--discount">
                                            <use xlink:href="<?= $menuTab['PARAMS']['SVG'] ?>"></use>
                                        </svg>
                                    </span>
                                    <?php endif; ?>
                                    <span class="button__text"><?= $menuTab['TEXT'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <?php $APPLICATION->IncludeComponent("zolo:geolocation.city",[]) ?>
            </div>
        </div>
    </div>
<?php endif; ?>