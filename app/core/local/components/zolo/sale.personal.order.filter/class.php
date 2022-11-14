<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Sale\Registry;

/**
 * Компонент, реализации вывода фильтров.
 */
class SalePersonalOrderFilterComponent extends CBitrixComponent
{
    /**
     * Свойство регистра.
     *
     * @var Registry
     */
    protected Registry $registry;

    /**
     * Статичный массив статуса оплаты.
     *
     * @var array
     */
    protected array $paymentStatus = [
        'Y' => 'Оплачен',
        'N' => 'Не оплачен'
    ];

	/**
	 * Выполнение компонента
	 *
	 * @return void
	 * 
	 */
	public function executeComponent(): void
	{
        if ($this->StartResultCache(false)) {
            $this->checkModules();
            $this->initRegistry();
            $this->initFilter();

            $this->SetResultCacheKeys([]);
            $this->includeComponentTemplate();
        }
	}

    /**
     * Подключение модуля sale
     *
     * @return void
     * @throws SystemException
     */
    public function checkModules(): void
    {
        if (!Loader::includeModule('sale')) {
            throw new SystemException(Loc::GetMessage('SPOL_SALE_MODULE_NOT_INSTALL'));
        }
    }

    /**
     * Инициализация фильтров
     *
     * @return void
     * 
     */
    protected function initFilter(): void
    {
        $orderStatusClassName = $this->registry->getOrderStatusClassName();
        $listStatusNames = $orderStatusClassName::getAllStatusesNames(LANGUAGE_ID);

        foreach($listStatusNames as $key => $data)
        {
            $this->arResult['STATUS'][$key] = $data;
        }

        $this->arResult['PAYMENT'] = $this->paymentStatus;
    }

    /**
     * Подключения регистра классов модуля sale
     *
     * @return void
     * 
     */
    private function initRegistry(): void
    {
		$this->registry = Registry::getInstance(Registry::REGISTRY_TYPE_ORDER);
    }
}
