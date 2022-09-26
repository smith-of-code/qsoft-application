<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die;
/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */
?>

Personal data step
<div class="register-form">
    <input type="text" class="input1" name="input1" value="<?=$arResult['input1']?>">
</div>

<button type="button" class="change-step" data-direction="next">Next step</button>