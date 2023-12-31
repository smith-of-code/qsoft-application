<?php use Bitrix\Main\Application;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die;

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

<h1 class="content__heading content__heading--separated">Регистрация</h1>

<div class="registration">
    <section class="section">
        <ul class="steps-counter <?=$arResult['type'] === 'buyer' ? 'steps-counter--buyer' : 'steps-counter--consult'?>">
            <?php foreach ($arResult['steps'] as $step):?>
                <?php if ($step['code'] === $arResult['currentStep']) $isCurrentStepPassed = true;?>
                <li
                        class="
                                steps-counter__item
                                <?=$step['code'] === $arResult['currentStep'] ? 'steps-counter__item--current' : ''?>
                                <?=!$isCurrentStepPassed ? 'steps-counter__item--passed' : ''?>
                            "
                        data-steps-item
                >
                    <div
                            class="
                                    steps-counter__circle
                                    steps-counter__circle--<?=$step['index']?>
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

        <?php if (in_array($stepTemplate,['.','..']) || ($stepTemplate === 'choose_mentor.php' && Application::getInstance()->getSession()->has('mentor_user_id'))): ?>


        <?php else: ?>
            <section
                    class="section section--limited-big step-container <?=str_replace('.php', '', $stepTemplate)?>"
                <?=$stepTemplate !== "$arResult[currentStep].php" ? 'style="display: none"' : ''?>
            >
                <?php include "steps/$stepTemplate"; ?>
            </section>
        <?php endif; ?>


    <?php endforeach; ?>
</div>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    var registrationData = <?=CUtil::PhpToJSObject($arResult)?>;
</script>