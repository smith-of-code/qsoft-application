<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\InvalidOperationException;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\NotImplementedException;
use Bitrix\Main\ObjectNotFoundException;
use Bitrix\Main\Request;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Discount;
use Bitrix\Sale\Fuser;
use QSoft\Helper\BasketHelper;

class BasketLineController extends Controller
{
    private BasketHelper $basketHelper;

    /**
     * @throws LoaderException
     */
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->initModules();

        $this->basketHelper = new BasketHelper;
    }

    /**
     * @throws LoaderException
     */
    private function initModules(): void
    {
        Loader::includeModule('sale');
    }

    public function configureActions(): array
    {
        return [
            'getBasketTotals' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class,
                ],
            ],
            'increaseItem' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class,
                ],
            ],
            'decreaseItem' => [
                '-prefilters' => [
                    Authentication::class,
                    Csrf::class,
                ],
            ],
        ];
    }

    /**
     * @throws ArgumentNullException
     * @throws ArgumentTypeException
     * @throws ArgumentException
     * @throws NotImplementedException
     * @throws InvalidOperationException
     */
    public function getBasketTotalsAction(): array
    {
        $basket = $this->basketHelper->getBasket();
        $basketItems = $basket->toArray();
        return [
            'status' => 'success',
            'items' => array_combine(array_column($basketItems, 'PRODUCT_ID'), $basketItems),
            'basketPrice' => $basket->getPrice(),
        ];
    }

    /**
     * @param int $offerId
     * @param int $bonuses
     * @param int $quantity
     * @return string[]
     * @throws ArgumentException
     * @throws ArgumentNullException
     * @throws ArgumentOutOfRangeException
     * @throws ArgumentTypeException
     * @throws LoaderException
     * @throws NotImplementedException
     * @throws ObjectNotFoundException
     * @throws InvalidOperationException
     */
    public function increaseItemAction(int $offerId, int $bonuses, int $quantity = 1): array
    {
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);
        if ($item = $basket->getExistsItem('catalog', $offerId)) {
            $result = $item->setField('QUANTITY', $item->getQuantity() + 1);
        } else {
            $result = \Bitrix\Catalog\Product\Basket::addProduct([
                'PRODUCT_ID' => $offerId,
                'QUANTITY' => $quantity,
                'PROPS' => [
                    [
                        'NAME' => 'Бонусы',
                        'CODE' => 'BONUSES',
                        'VALUE' => $bonuses,
                    ],
                ],
            ]);
        }
        if (!$result->isSuccess()) {
            throw new RuntimeException($result->getErrorMessages());
        }
        return $this->getBasketTotalsAction();
    }

    /**
     * @param int $offerId
     * @param int $quantity
     * @return array|string[]
     * @throws ArgumentException
     * @throws ArgumentNullException
     * @throws ArgumentOutOfRangeException
     * @throws ArgumentTypeException
     * @throws NotImplementedException
     * @throws ObjectNotFoundException
     * @throws InvalidOperationException
     */
    public function decreaseItemAction(int $offerId, int $quantity = 1): array
    {
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);
        /** @var BasketItem $basketItem */
        foreach ($basket->getBasketItems() as $basketItem) {
            if ($basketItem->getProductId() === $offerId) {
                if ($basketItem->getQuantity() > $quantity) {
                    $basketItem->setField('QUANTITY', $basketItem->getQuantity() - $quantity);
                    $result = $basketItem->save();
                } else {
                    $basketItem->delete();
                    $result = $basket->save();
                }
                break;
            }
        }
        if (isset($result) && !$result->isSuccess()) {
            throw new RuntimeException($result->getErrorMessages());
        }
        return $this->getBasketTotalsAction();
    }
}