<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $USER;
$APPLICATION->SetTitle("404");?>

    <div class="page__error error">
        <div class="error__content">

            <div class="error__image">
                <picture>
                    <source media="(min-width: 768px)" srcset="/local/templates/.default/images/cat-404.png">
                    <img src="/local/templates/.default/images/cat-404-mobile.png" alt="cat-404" class="error__image-picture">
                </picture>
            </div>

            <p class="error__status">
                Error 404
            </p>

            <div class="error__message">
                <p class="error__text">Приносим извинения, такой страницы не существует.</p>
                <p class="error__text">Если Вы не нашли то, что ищете, обратитесь в нашу службу поддержки. Мы постараемся Вам помочь.</p>
            </div>

            <!--
                Кнопка "Обратиться в техподдержку" -
                при клике открывается модальное окно с формой поддержки.
                Если пользователь не авторизован, то открывается
                станица с Формой авторизации.
             -->

            <?php if ($USER->IsAuthorized()) {?>
                <button type="button" class="error__button button button--rounded button--covered button--red" data-fancybox data-modal-type="modal" data-src="#technical-support" data-selected="OTHER">
                    Обратиться в техподдержку
                </button>
            <?php } else { ?>
                <a href="/auth/" class="button">
                    <button type="button" class="error__button button button--rounded button--covered button--red">
                        Обратиться в техподдержку
                    </button>
                </a>
            <?php }?>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>