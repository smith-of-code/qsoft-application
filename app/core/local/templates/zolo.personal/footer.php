<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
            </div>
        </main>
    </div>
</div>
<!--content-->

<!--Футер-->
<footer class="page__footer footer">
    <div class="footer__container container">
        <nav class="footer__nav">
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "dogs_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/for_dogs.php",
                    'COLUMN_ADDITIONAL_CLASS' => 'footer__list--dogs'
                ]
            );
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "cats_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/for_cats.php",
                    'COLUMN_ADDITIONAL_CLASS' => 'footer__list--cats'
                ]
            );
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "consumers_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/consumers.php",
                    'COLUMN_ADDITIONAL_CLASS' => 'footer__list--customers'
                ]
            );
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "company_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/company.php",
                    'COLUMN_ADDITIONAL_CLASS' => 'footer__list--company'
                ]
            );
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "contacts_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/contacts.php",
                    'COLUMN_ADDITIONAL_CLASS' => 'footer__list--contacts'
                ]
            );
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom_home_main",
                [
                    "ROOT_MENU_TYPE" => "legal_bottom",
                    "MAX_LEVEL" => "1",
                    "HEAD_PATH" => "/include/legal.php",
                    'COLUMN_ADDITIONAL_CLASS' => 'footer__list--info'
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
            <div class="footer__logo logo">
                <a target="_blank" class="logo__link" href="https://qsoft.ru">
                    <img class="logo__pic" src="/local/templates/.default/images/icons/qsoft-logo.svg" alt="logo">
                </a>
            </div>
        </div>
    </div>
</footer>
<!--/Футер-->

</body>

</html>
