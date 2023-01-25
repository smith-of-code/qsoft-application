<?php if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$APPLICATION->IncludeComponent(
    "zolo:techsupport.form.handler",
    "script",
    [],
    false
);?>
        </main>
    </div>
</div>
<!--content-->

<!--cookie popup-->
    <div id="cookie" class="cookie" style="display: none">
        <div class="container">
            <div class="cookie__row">
                <div class="cookie__col">
                    <div class="cookie__image">
                        <img class="cookie__image-picture" src="/local/templates/.default/images/cookies.png" alt="cookie">
                    </div>
                </div>
                <div class="cookie__col">
                    <div class="cookie__text">
                        Мы используем файлы cookie для Вашего удобства пользования сайтом. Продолжая использовать наш сайт, Вы даете согласие на обработку файлов cookie
                    </div>
                </div>
                <div class="cookie__col">
                    <div class="cookie__actions">
                        <a href="#" class="cookie__actions-button cookie__actions-accept button button--rounded button--outlined button--red">
                            Узнать больше
                        </a>
                        <button type="button" class="cookie__actions-button cookie__actions-more button button--rounded button--covered button--red" data-cookie-accept>
                            Принять
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--cookie popup-->

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
