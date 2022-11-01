<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<div
    id="loyaltySalesReport"
    prop-user='<?=phpToVueObject($arResult['user'])?>'
    prop-loyalty-status='<?=phpToVueObject($arResult['loyalty_status'])?>'
    prop-bonuses-income='<?=phpToVueObject($arResult['bonuses_income'])?>'
></div>