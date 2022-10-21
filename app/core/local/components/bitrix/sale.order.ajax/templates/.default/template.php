<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

?>

<?php if (Application::getInstance()->getContext()->getRequest()->get('ORDER_ID')):
	include(Application::getDocumentRoot() . "$templateFolder/confirm.php");
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET']):
	include(Application::getDocumentRoot() . "$templateFolder/empty.php");
else:?>
    <form action="/checkout/" method="POST" name="ORDER_FORM" id="bx-soa-order-form" enctype="multipart/form-data">
        <input type="text" placeholder="Фамилия" value="<?=$arResult['USER']['LAST_NAME']?>" />
        <input type="text" placeholder="Имя" value="<?=$arResult['USER']['FIRST_NAME']?>" />
        <select >
            <option>Способ доставки</option>
            <?php foreach($arResult['DELIVERY'] as $delivery):?>
                <option
                    value="<?=$delivery['ID']?>"
                    <?=$arResult['USER_VALS']['DELIVERY_ID'] === (int) $delivery['ID'] ? 'selected' : ''?>
                ><?=$delivery['NAME']?></option>
            <?php endforeach;?>
        </select>
        <input type="text" placeholder="Дата доставки" value="Доступно с <?=$arResult['ORDER_DELIVERY_DATE']?>" disabled />
        <select >
            <option>Город</option>
            <?php foreach($arResult['CITIES'] as $city):?>
                <option
                    value="<?=$city['XML_ID']?>"
                    <?=$arResult['USER']['CITY'] === $city['VALUE'] ? 'selected' : ''?>
                ><?=$city['VALUE']?></option>
            <?php endforeach;?>
        </select>
        <select >
            <option>Адрес доставки</option>
            <?php foreach($arResult['ADDRESSES'] as $address):?>
                <option value="<?=$address?>"><?=$address?></option>
            <?php endforeach;?>
        </select>
        <input type="text" placeholder="Email" value="<?=$arResult['USER']['EMAIL']?>" />
        <input type="text" placeholder="Комментарий" value="" />
        <div>
            <p>Количество товаров - <?=$arResult['BASKET_POSITIONS']?></p>
            <p>Сумма НДС - <?=$arResult['ORDER_TAX']?></p>
            <p>Сумма заказа - <?=$arResult['PRICE_WITHOUT_DISCOUNT_VALUE']?></p>
            <p>Экономия - <?=$arResult['DISCOUNT_PRICE']?></p>
            <?php if ($arResult['USER']['IS_CONSULTANT']):?>
                <p>Будет начислено - <?=$arResult['ORDER_BONUSES']?></p>
            <?php endif;?>
            <p>Итого к оплате - <?=$arResult['ORDER_PRICE']?></p>
        </div>
    </form>
<?php endif;?>