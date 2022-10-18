<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */
$cartStyle = 'bx-basket';
$cartId = "bx_basket" . $this->randString();
$arParams['cartId'] = $cartId;

//if ($arParams['POSITION_FIXED'] == 'Y')
//{
//	$cartStyle .= "-fixed {$arParams['POSITION_HORIZONTAL']} {$arParams['POSITION_VERTICAL']}";
//	if ($arParams['SHOW_PRODUCTS'] == 'Y')
//		$cartStyle .= ' bx-closed';
//}
//else
//{
//	$cartStyle .= ' bx-opener';
//}


?>
<div class="personal__item" id="<?= $cartId ?>">
    <button type="button" class="button button--simple button--red button--vertical">
        <span class="button__icon button__icon--mixed">
            <svg class="icon icon--basket">
                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
            </svg>

            <span class="button__icon-counter button__icon-counter--dark">12</span>
        </span>
        <span class="personal__button-text button__text">16 842 ₽</span>
    </button>
</div>

<script>
    let <?= $cartId ?> = new BitrixSmallCart;
</script>
<script type="text/javascript">
    <?=$cartId?>.siteId = '<?=SITE_ID?>';
    <?=$cartId?>.cartId = '<?=$cartId?>';
    <?=$cartId?>.activate();
</script>