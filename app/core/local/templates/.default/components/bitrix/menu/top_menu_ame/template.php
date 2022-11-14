<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
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
                            <a href="<?=$menuTab['LINK'] ?>" class="navigation__button button button--simple button--red">
                                <?php if ($menuTab['PARAMS']['IMAGE']): ?>
                                    <span class="button__icon">
                                        <svg class="icon icon--discount">
                                            <use xlink:href="<?=$menuTab['ADDITIONAL_LINKS']['SVG'] ?>"></use>
                                        </svg>
                                    </span>
                                <?php endif; ?>
                                <span class="button__text"><?=$menuTab['TEXT'] ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
<?php endif; ?>