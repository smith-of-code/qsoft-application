<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die;

/**
 * Bitrix vars
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

$isCurrentStepPassed = false;
?>
<link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css" />

<main class="page__content content">
    <div class="content__container container">
        <div class="registration">
            <section class="section">
                <ul class="steps-counter">
                    <?php foreach ($arResult['steps'] as $step):?>
                        <?php if ($step['code'] === $arResult['currentStep']) $isCurrentStepPassed = true;?>
                        <li class="steps-counter__item steps-counter__item--current" data-steps-item>
                            <div
                                class="
                                    steps-counter__circle
                                    <?=$step['code'] === $arResult['currentStep'] ? 'steps-counter__circle--current' : ''?>
                                    <?=!$isCurrentStepPassed ? 'steps-counter__circle--passed' : ''?>
                                "
                                data-steps-indicator
                            >
                                <span class="steps-counter__circle-text"><?=$step['name']?></span>
                            </div>
                        </li>
                    <?php endforeach;?>
                </ul>
            </section>

            <?php foreach (scandir(__DIR__ . '/steps') as $stepTemplate): ?>
                <div
                    class="step-container <?=str_replace('.php', '', $stepTemplate)?>"
                    <?=$stepTemplate !== "$arResult[currentStep].php" ? 'style="display: none"' : ''?>
                >
                    <?php include "steps/$stepTemplate"; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<script src="/local/templates/.default/js/script.js"></script>

<script>
    var registrationData = <?=CUtil::PhpToJSObject($arResult)?>;
</script>