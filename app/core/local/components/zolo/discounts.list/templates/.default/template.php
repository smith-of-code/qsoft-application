<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<div class="discounts"></div>
<button class="show-more">Показать еще</button>

<script>
    attach(<?=json_encode($arResult['ITEMS'])?>);
    let offset = <?=$arResult['OFFSET']?>;
</script>
