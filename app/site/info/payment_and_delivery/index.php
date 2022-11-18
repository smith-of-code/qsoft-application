<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оплата и доставка");
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
                    Оплата и доставка
                </h2>
            </div>
        </section>
    </div>


<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");;