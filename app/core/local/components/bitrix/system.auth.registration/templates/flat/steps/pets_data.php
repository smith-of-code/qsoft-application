<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die;
/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */
?>

Pets data step

<div class="register-form">
    <input type="text" class="input2" name="input2" value="<?=$arResult['input2']?>">
    <input type="file" class="input3" name="input3" value="<?=$arResult['input3']?>">
</div>


<button type="button" class="change-step" data-direction="previous">Previous step</button>
<button type="button" class="send-code">Send phone code</button>
<button type="button" class="verify-code">Verify phone code (from $(.input2))</button>
<button type="button" class="register">Register</button>
