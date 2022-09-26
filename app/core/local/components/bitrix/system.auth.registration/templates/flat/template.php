<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die;

/**
 * Bitrix vars
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

?>

<?php foreach (scandir(__DIR__ . '/steps') as $stepTemplate): ?>
    <div
        class="step-container <?=str_replace('.php', '', $stepTemplate)?>"
        <?=$stepTemplate !== "$arResult[currentStep].php" ? 'style="display: none"' : ''?>
    >
        <?php include "steps/$stepTemplate"; ?>
    </div>
<?php endforeach; ?>

<script>
    var registrationData = <?=CUtil::PhpToJSObject($arResult)?>;
</script>