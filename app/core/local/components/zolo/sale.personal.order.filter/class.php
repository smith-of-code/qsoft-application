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

        if ($this->getStatuses(["STATUS_ID" => ["F", "OD"]])) {
            $this->arResult['STATUS']['DELIVERED'] = 'Доставлен';
        }


        if ($this->getStatuses(["STATUS_ID" => ["OC"]])) {
            $this->arResult['STATUS']['CANCELED'] = 'Отменен';
        }


        if ($this->getStatuses(["!STATUS_ID" => ["F", "OC",]])) {
            $this->arResult['STATUS']['POSTED'] = 'Размещен';
        }

        $this->arResult['PAYMENT'] = $this->paymentStatus;
    }

    protected function getStatuses(array $filter)
    {
        $userFilter = array_merge(["USER_ID" => $GLOBALS['USER']->GetID()], $filter);

        return \Bitrix\Sale\Order::getList([
            'filter' => $userFilter,
        ])->fetch();
    }
}
