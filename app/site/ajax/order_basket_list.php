<?php require_once("$_SERVER[DOCUMENT_ROOT]/bitrix/modules/main/include/prolog_before.php");

$arResult = $_REQUEST['data'];
?>

<ul class="table-list__list">

    <?php foreach ($arResult as $productId => $product): ?>
        <!-- <?//=$product['DETAIL_PAGE_URL']?> - ссылка для детальной страницы товара -->
        <li class="table-list__item">

            <article class="product-line">
                <div class="product-line__inner">
                    <div class="product-line__info">
                        <div class="product-line__image">
                            <img src="<?=$product['IMAGE_SRC']?>" alt="#" class="product-line__image-picture">
                        </div>
                        <div class="product-line__wrapper">
                            <h2 class="product-line__title">
                                <?=$product['NAME']?>
                            </h2>
                            <p class="product-line__subtitle">
                                Арт. <?=$product['ARTICLE'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="product-line__characteristic">
                        <ul class="product-line__list">
                            <li class="product-line__params product-line__params--span">
                                <p class="product-line__text">
                                    <span class="product-line__params-name">
                                        Цена:
                                    </span>
                                    <span class="product-line__params-value">
                                <?=number_format($product['PRICE'], 2, '.', ' ')?> ₽
                                    </span>
                                </p>
                            </li> 
                            <li class="product-line__params">
                                <p class="product-line__text">
                                    <span class="product-line__params-name">
                                        Количество:
                                    </span>
                                    <span class="product-line__params-value">
                                <?=$product['QUANTITY']?>
                                    </span>
                                </p>
                            </li> 
                            <li class="product-line__params product-line__params--bold">
                                <p class="product-line__text">
                                    <span class="product-line__params-name">
                                        Сумма баллов:
                                    </span>
                                    <span class="product-line__params-value">
                                    <?=$product['POINTS'] ?? 0?> ББ
                                    </span>
                                </p>
                            </li> 
                        </ul>
                    </div>
                </div>
            </article>

        </li>
    <?php endforeach; ?>
</ul>