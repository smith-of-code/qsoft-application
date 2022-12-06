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
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Fuser;
use QSoft\Entity\User;
use QSoft\Helper\BasketHelper;
use \QSoft\Service\ProductService;
use Bitrix\Sale\Order;
use Bitrix\Main\Error;

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
            'repeatOrder' => [
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
    public function getBasketTotalsAction(string $withPersonalPromotions = 'false'): array
    {
        $basket = $this->basketHelper->getBasket($withPersonalPromotions === 'true');
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
    public function increaseItemAction(
        int $offerId,
        ?string $detailPage = null,
        string $nonreturnable = 'false',
        string $withPersonalPromotions = 'false',
        int $quantity = 1
    ): array {
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);
        if ($item = $this->getExistBasketItem($basket, $offerId)) {
            $result = $item->setField('QUANTITY', $item->getQuantity() + $quantity);
            $basket->save();
        } else {
            $result = \Bitrix\Catalog\Product\Basket::addProduct([
                'PRODUCT_ID' => $offerId,
                'QUANTITY' => $quantity,
                'PROPS' => [
                    [
                        'NAME' => 'Детальная страница',
                        'CODE' => 'DETAIL_PAGE',
                        'VALUE' => $detailPage,
                    ],
                    [
                        'NAME' => 'Невозвратный товар',
                        'CODE' => 'NONRETURNABLE',
                        'VALUE' => $nonreturnable === 'true',
                    ],
                ],
            ]);
        }
        if (!$result->isSuccess()) {
            $this->errorCollection = $result->getErrorCollection();
            return [];
        }
        return $this->getBasketTotalsAction($withPersonalPromotions);
    }

    private function getExistBasketItem(BasketBase $basket, int $offerId): ?BasketItem
    {
        /** @var BasketItem $basketItem */
        foreach ($basket->getBasketItems() as $basketItem) {
            if ($basketItem->getProductId() === $offerId) {
                return $basketItem;
            }
        }
        return null;
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
    public function decreaseItemAction(int $offerId, string $withPersonalPromotions = 'false', int $quantity = 1): array
    {
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);
        /** @var BasketItem $basketItem */
        foreach ($basket->getBasketItems() as $basketItem) {
            if ($basketItem->getProductId() === $offerId) {
                if ($quantity && $basketItem->getQuantity() > $quantity) {
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
        return $this->getBasketTotalsAction($withPersonalPromotions);
    }

    public function repeatOrderAction(int $orderId): array
    {
        //объект заказа
        $orderOld = Order::load($orderId);

        if ($orderOld == null) {
            $this->errorCollection[] = new Error('Заказ с номером ' . $orderId . ' не найден');
            return [];
        }

        $basketOld = $orderOld->getBasket();

        if ($basketOld->isEmpty()) {
            $this->errorCollection[] = new Error('Заказ с номером ' . $orderId . ' имеет пустую корзину');
            return [];
        }

        $ids = array_map(static fn($item) => $item->getProductId(), $basketOld->getBasketItems());

        $offers = (new ProductService(new User($orderOld->getUserId())))->getOffersByRepeatedIds($ids);

        $missing = [];//позиции старой корзины, которые не добавятся в новую корзину
        foreach ($basketOld as $basketItem) {
            $offer = $offers[$basketItem->getProductId()];
            $requiredQuantity = $basketItem->getQuantity();
            $availableQuantity = $offer['CATALOG_QUANTITY'];
            if ($availableQuantity == 0) {
                $missing[] = [
                    'ID' => $offer['ID'],
                    'NAME' => $offer['NAME'],
                ];
                continue;
            }

            $props = $basketItem->getPropertyCollection()->getPropertyValues();

            $this->increaseItemAction(
                $offer['ID'],
                $props['DETAIL_PAGE']['VALUE'],
                $props['NONRETURNABLE']['VALUE'],
                'false',
                min($requiredQuantity, $availableQuantity),
            );
        }
        $result = $this->getBasketTotalsAction();
        $result['missing'] = $missing;
        return $result;
    }
}
