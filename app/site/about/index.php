<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent(
    'bitrix:breadcrumb',
    '',
    [
        'PATH' => '',
        'SITE_ID' => '',
        'START_FROM' => '0',
    ],
    false
);?>

<h1 class="page__heading">AmeБизнес</h1>
<div class="content__main">
    <div class="about__wrapper">
        <section class="about__hero section section--margin-xl">
        <?php
        $APPLICATION->IncludeComponent(
                'bitrix:main.include',
        '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => '/include/about/hero.php',
        ]);?>
        </section>

    <section class="about__appreciate section section--margin-xl">
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            [
                'AREA_FILE_SHOW' => 'file',
                'PATH' => '/include/about/appreciate.php',
            ]);?>
    </section>

    <section class="about__goals section section--margin-xl">
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            [
                'AREA_FILE_SHOW' => 'file',
                'PATH' => '/include/about/goals.php',
            ]);?>
    </section>

        <section class="about__advantages section section--margin-xl">
            <?php
            $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                [
                    'AREA_FILE_SHOW' => 'file',
                    'PATH' => '/include/about/advantages.php',
                ]);?>
    </section>


        <section class="about__cert section section--margin-xl">
            <?php
            $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                [
                    'AREA_FILE_SHOW' => 'file',
                    'PATH' => '/include/about/cert.php',
                ]);?>
        </section>

        <section class="about__business section section--margin-xl">
            <?php
            $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                [
                    'AREA_FILE_SHOW' => 'file',
                    'PATH' => '/include/about/business.php',
                ]);?>
        </section>


        <section class="about__preview section section--margin-xl">
            <?php
            $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                [
                    'AREA_FILE_SHOW' => 'file',
                    'PATH' => '/include/about/preview.php',
                ]);?>
        </section>

        <section class="about__howbecome section section--margin-xl">
            <?php
            $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                [
                    'AREA_FILE_SHOW' => 'file',
                    'PATH' => '/include/about/howbecome.php',
                ]);?>
        </section>

        <section class="about__contacts section section--margin-xl">
            <?php
            $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                [
                    'AREA_FILE_SHOW' => 'file',
                    'PATH' => '/include/about/contacts.php',
                ]);?>
        </section>

        <section class="about__info section section--margin-xl">
            <?php
            $APPLICATION->IncludeComponent(
                'bitrix:main.include',
                '',
                [
                    'AREA_FILE_SHOW' => 'file',
                    'PATH' => '/include/about/info.php',
                ]);?>
        </section>

    </div>
</div>
</main>
</div>
</div>
<!--content-->
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");