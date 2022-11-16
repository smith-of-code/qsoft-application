<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<?php if (!empty($arResult)): ?>
    <div class="menu__division">
        <ul class="menu__list">
            <?php foreach ($arResult as $menuTab): ?>
                <li class="menu__item menu__item--small">
                    <a href="<?=$menuTab['LINK'] ?>" class="menu__item-link button button--simple button--red"><?=$menuTab['TEXT'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>