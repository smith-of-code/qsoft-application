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
    private User $user;
    private BasketHelper $basketHelper;

    /**
     * @throws LoaderException
     */
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->initModules();

        $this->user = new User;
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
            'itemsCount' => array_sum($basket->getQuantityList()),
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
        $this->basketHelper->increase($offerId, $detailPage, $nonreturnable === 'true', $quantity);
        return $this->getBasketTotalsAction($withPersonalPromotions);
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
        $currentBasket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);

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

        $offers = (new ProductService(new User($orderOld->getUserId())))->getOffersByIds($ids);

        $missing = [];//позиции старой корзины, которые не добавятся в новую корзину
        foreach ($basketOld as $basketItem) {
            $offer = $offers[$basketItem->getProductId()];
            $requiredQuantity = $basketItem->getQuantity();
            $availableQuantity = $offer['CATALOG_QUANTITY'];
            if ($availableQuantity == 0) {
                $missing[] = [
                    'id' => $offer['ID'],
                    'name' => $offer['NAME'],
                    'article' => $offer['PROPERTY_ARTICLE_VALUE'],
                    'picture' => $offer['PREVIEW_IMAGE_SRC'] ?: NO_IMAGE_PLACEHOLDER_PATH,
                ];
                continue;
            }

            $props = $basketItem->getPropertyCollection()->getPropertyValues();

            $existingBasketItem = $this->getExistBasketItem($currentBasket, $basketItem->getProductId());
            if ($existingBasketItem) {
                $requiredQuantity -= $existingBasketItem->getQuantity();
            }

            if ($requiredQuantity > 0) {
                $this->increaseItemAction(
                    $offer['ID'],
                    $props['DETAIL_PAGE']['VALUE'],
                    $props['NONRETURNABLE']['VALUE'],
                    'false',
                    min($requiredQuantity, $availableQuantity),
                );
            }
        }

        return array_merge($this->getBasketTotalsAction(), ['missedProducts' => $missing]);
    }
}
