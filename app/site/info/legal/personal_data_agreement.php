<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Положение об обработке персональных данных");
?><?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"",
	Array(
		"PATH" => "",
		"SITE_ID" => "",
		"START_FROM" => "0"
	)
);?>
<div class="content__main">
 <section class="section">
	<div class="section__header">
		<h2 class="section__title">
		Политика в отношении обработки персональных данных </h2>
	</div>
 </section>
</div>
 <br>

<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");