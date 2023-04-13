<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class SalePersonalOrderSortComponent extends CBitrixComponent
{

    protected $sortFields = [
        'DATE_INSERT' => 'По дате создания',
        'PRICE' => 'По сумме заказа'
    ];

    protected $sortDirection = [
        'ASC' => 'ASC',
        'DESC' => 'DESC'
    ];


	public function executeComponent()
	{
        $this->initSort();
		$this->includeComponentTemplate();
	}

    protected function initSort()
    {
        $this->arResult['SORT'] = $this->sortFields;
        $this->arResult['DIRECTION'] = $this->sortDirection;
    }
}