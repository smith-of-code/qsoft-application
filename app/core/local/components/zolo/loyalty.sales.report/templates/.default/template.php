<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<div
    id="loyaltySalesReport"
    prop-user='<?=phpToVueObject($arResult['user'])?>'
    prop-orders-report='<?=phpToVueObject($arResult['orders_report'])?>'
    prop-current-accounting-period='<?=phpToVueObject($arResult['current_accounting_period'])?>'
    prop-accounting-periods='<?=phpToVueObject($arResult['accounting_periods'])?>'
    prop-loyalty-status='<?=phpToVueObject($arResult['loyalty_status'])?>'
    prop-bonuses-income='<?=phpToVueObject($arResult['bonuses_income'])?>'
></div>