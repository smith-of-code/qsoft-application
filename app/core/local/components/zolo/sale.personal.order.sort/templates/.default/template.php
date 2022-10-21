<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

<select id="sortBy">
    <? foreach ($arResult['SORT'] as  $code => $name) {
        ?><option value="<?=$code?>"><?=$name?></option><?
    }?>
</select>

<select id="sortDirection">
    <? foreach ($arResult['DIRECTION'] as $code => $name) {
        ?><option value="<?=$code?>"><?=$name?></option><?
    }?>
</select>
