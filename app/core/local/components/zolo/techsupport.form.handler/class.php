<?

use Bitrix\Main\Engine\Contract\Controllerable;
use QSoft\Entity\User;

 if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class TechsupportFormHandlerComponent extends CBitrixComponent implements Controllerable
{
    public function configureActions()
    {
        return [
            'load' => [
                '-prefilters' => [
                    Csrf::class,
                ],
            ]
        ];
    }

    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

	public function executeComponent()
	{
        if ($this->StartResultCache(false)) {
            $this->checkRequiredModules();
            $this->prepareResult();
            $this->SetResultCacheKeys(["POSITION"]);
            $this->IncludeComponentTemplate();
        }
	}
    
    protected function checkRequiredModules(): void
    {
        if (!CModule::IncludeModule("iblock")) {
            ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        }
        if (!CModule::IncludeModule("support")) {
            ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        }
        if (!$this->arParams["IBLOCKS"] || $this->arParams["IBLOCKS"] <= 0) {
            ShowError(GetMessage("IBLOCK_MODULE_NOT_FOUND"));
        }
    }

    public function loadAction()
    {
        return json_encode([
            'data' => 'test'
        ]);
    }

    public function prepareResult()
    {
        $user = new User();
        $this->arResult['EMAIL'] = $user->email;
        $this->arResult['ID'] = $user->id;
        $this->arResult['ID'] = $user->id;
    }

    public function addTicket()
    {
        //
    }
}