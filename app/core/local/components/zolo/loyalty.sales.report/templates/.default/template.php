<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<div
    id="salesReportPage"
    prop-consultant-loyalty-levels='<?=phpToVueObject($arResult['consultant_loyalty_levels'])?>'
    prop-buyer-loyalty-levels='<?=phpToVueObject($arResult['buyer_loyalty_levels'])?>'
    prop-consultant-accounting-periods='<?=phpToVueObject($arResult['consultants_accounting_periods'])?>'
    prop-buyer-accounting-periods='<?=phpToVueObject($arResult['buyers_accounting_periods'])?>'
    prop-current-user='<?=phpToVueObject($arResult['current_user'])?>'
    prop-current-accounting-period='<?=phpToVueObject($arResult['current_accounting_period'])?>'
    prop-team='<?=phpToVueObject($arResult['user_team'])?>'
></div>