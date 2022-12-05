<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->setTitle("О компании");

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
        <?php
        $APPLICATION->IncludeComponent(
                'bitrix:main.include',
        '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => '/include/about/hero.php',
        ]);
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => '/include/about/appreciate.php',
        ]);
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => '/include/about/goals.php',
        ]);
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => '/include/about/advantages.php',
        ]);
        $APPLICATION->IncludeComponent('zolo:about.cert', '');
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => '/include/about/business.php',
        ]);
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => '/include/about/preview.php',
        ]);
        $APPLICATION->IncludeComponent('zolo:about.howbecome', '');
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => '/include/about/contacts.php',
        ]);
        $APPLICATION->IncludeComponent('zolo:about.info', '');?>
    </div>
</div>
</main>
</div>
</div>
<!--content-->
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
