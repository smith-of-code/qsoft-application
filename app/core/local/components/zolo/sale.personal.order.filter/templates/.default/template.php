<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

<input id="filter_id" placeholder="Я ищу">

<select id="filter_status">
    <? foreach ($arResult['STATUS'] as  $code => $name) {
        ?><option value="<?=$code?>"><?=$name?></option><?
    }?>
</select>

<select id="filter_payment">
    <? foreach ($arResult['PAYMENT'] as $code => $name) {
        ?><option value="<?=$code?>"><?=$name?></option><?
    }?>
</select>
