<?

use Bitrix\Main\Engine\Contract\Controllerable;
use QSoft\Entity\User;

 if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class TechsupportFormHandlerComponent extends CBitrixComponent implements Controllerable
{
    private int $ticketId;
    
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
    }

    public function loadAction()
    {
        $this->checkRequiredModules();
        $this->prepareResult();
        $this->SetResultCacheKeys(["POSITION"]);

        return json_encode([
            'data' => $this->arResult,
        ]);
    }

    public function sendTicketAction($fields)
    {
        $this->checkRequiredModules();
        $this->sendTicket($fields);

        return json_encode([
            'data' => $this->ticketId,
        ]);
    }

    public function prepareResult()
    {
        $user = new User();
        $this->arResult['EMAIL'] = $user->email;
        $this->arResult['ID'] = $user->id;
        $this->arResult['MENTHOR_ID'] = $user->menthor->id ?? false;
        $this->arResult['NAME'] = $user->name;
        $this->arResult['LAST_NAME'] = $user->lastName;
        $this->arResult['SECOND_NAME'] = $user->secondName;
        $this->arResult['BIRTH_DATE'] = $user->birthday;
    }

    public function sendTicket($fields)
    {
        $arFields = $this->prepareFields($fields);

        $this->ticketId = (new CTicket())->set($arFields, $MID, '', 'N', 'Y', 'Y');
    }

    private function prepareFields($fields)
    {
        return [
            'TITLE' => 'Создано обращение',
            'MESSAGE' => 'сообщение',
            'OWNER_SID' => $fields['EMAIL'],
            'CATEGORY_SID' => '',
            'CRITICALITY_SID' => '',
            'STATUS_SID' => '',
            'MARK_ID' => '',
            'RESPONSIBLE_USER_ID' => '',
            'UF_DATA' => 'json data',
            'UF_ACCEPT_REQUEST' => '',
        ];
    }
}