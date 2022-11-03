<<<<<<< HEAD
<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
global $APPLICATION;
?>
=======
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
        </main>
>>>>>>> 0428f864cada760fa25a87cd6123cade447a2ac2
    </div>
</div>
<!--content-->

<!--Футер-->
<footer class="page__footer footer">
    <div class="footer__container container">
        <nav class="footer__nav">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                "bottom_home_main",
                    [
                        "ROOT_MENU_TYPE" => "dogs_bottom",
                        "MAX_LEVEL" => "1",
                        "HEAD_PATH" => "/include/for_dogs.php",
                    ]
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "cats_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/for_cats.php",
                ]
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "consumers_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/consumers.php",
                ]
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "company_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/company.php",
                ]
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "contacts_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/contacts.php",
                ]
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "legal_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/legal.php",
                ]
            );?>
        </nav>
        <div class="footer__social social">
            <ul class="social__list">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom_home_social",
                    [
                        "ROOT_MENU_TYPE" => "social_bottom",
                        "MAX_LEVEL" => "1",
                    ]
                );?>
            </ul>
        </div>
        <div class="footer__bottom">
            <p class="footer__copyright">
                &copy; AmeAppetite, 2022
            </p>
        </div>
    </div>
</footer>
<!--/Футер-->
</body>

</html>
