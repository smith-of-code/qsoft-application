<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Технические работы");?>

<div class="page__error error">
    <div class="error__content">

        <div class="error__image">
            <picture>
                <source media="(min-width: 768px)" srcset="/local/templates/.default/images/cat-maintenance.png">
                <img src="/local/templates/.default/images/cat-maintenance-mobile.png" alt="cat-maintenance" class="error__image-picture">
            </picture>
        </div>

        <p class="error__status">
            Технические работы
        </p>

        <div class="error__message">

            <p class="error__text">
                Сегодня до 12:00 мы проводим технические работы, чтобы наш сайт работал лучше.
            </p>

            <p class="error__text">
                Пока Вы ждете, предлагаем почитать новую статью на нашем канале.
            </p>

            <p class="error__text">
                <a href="/info/expert-advice/detail/1331/" class="error__link button button--simple button--red button--over">Как подобрать корм для стерилизованных кошек</a>
            </p>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
