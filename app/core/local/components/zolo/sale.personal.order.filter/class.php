<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

class SalePersonalOrderFilterComponent extends CBitrixComponent
{

    protected $sortFields = [
        'POSTED' => 'Размещен',
        'CANCELED' => 'Отменен',
        'DELIVERED' => 'Доставлен'
    ];

    protected $paymentStatus = [
        'PAID' => 'Оплачен',
        'NOT_PAID' => 'Не оплачен'
    ];

	public function executeComponent()
	{
        $this->checkModules();
        $this->initFilter();

		$this->includeComponentTemplate();
	}

    public function checkModules()
    {
        if (!Loader::includeModule('sale')) {
            throw new SystemException(Loc::GetMessage('SPOL_SALE_MODULE_NOT_INSTALL'));
        }
    }

    protected function initFilter()
    {
        $orders = \Bitrix\Sale\Order::getList([
            'filter' => [
                'USER_ID' => $GLOBALS['USER']->GetID()
            ],
            'select' => ['STATUS_ID'],
        ]);
        while ($order = $orders->fetch()) {
            if (in_array($order['STATUS_ID'], ['F', 'OD'])) {
                $this->arResult['STATUS']['DELIVERED'] = 'Доставлен';
            } elseif ($order['STATUS_ID'] == 'OC') {
                $this->arResult['STATUS']['CANCELED'] = 'Отменен';
            } else {
                $this->arResult['STATUS']['POSTED'] = 'Размещен';
            }
        }

        $this->arResult['PAYMENT'] = $this->paymentStatus;
    }
}
