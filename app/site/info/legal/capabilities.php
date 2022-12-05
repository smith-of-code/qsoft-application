<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Возможности");
?>

<?php
$APPLICATION->IncludeComponent(
    'bitrix:breadcrumb',
    '',
    [
        'PATH' => '',
        'SITE_ID' => '',
        'START_FROM' => '0',
    ],
);?>

<div class="content__main">
    <section class="section">
        <div class="section__header">
            <h2 class="section__title">
                Возможности
            </h2>
        </div>
    </section>
</div>


<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");