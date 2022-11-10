<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Engine\Contract\Controllerable;
use QSoft\Entity\User;


/**
 * Компонент контроля форм обращения в тех поддержку.
 */
class TechsupportFormHandlerComponent extends CBitrixComponent implements Controllerable
{
    /**
     * id обращения
     *
     * @var int
     */
    private int $ticketId;
    
    /**
     * Тип справочника "категории".
     * CATEGORY_DICTIONARY_TYPE
     *
     * @var string
     */
    private const CATEGORY_DICTIONARY_TYPE = 'C';

    /**
     * TICKET_TYPES категории обращений
     *
     * @var array
     */
    private const TICKET_TYPES = [
        'REFUND_ORDER' => 'REFUND_ORDER',
        'SUPPORT' => 'SUPPORT',
        'CHANGE_MENTOR' => 'CHANGE_MENTOR',
        'OTHER' => 'OTHER',
    ];
    
    /**
     * Проверка токенов, защита от CSRF атак
     *
     * @return array
     * 
     */
    public function configureActions(): array
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

	/**
	 * TODO: пока не нужен.
	 *
	 * @return void
	 * 
	 */
	public function executeComponent(): void
	{
        if ($this->StartResultCache(false)) {
            $this->checkRequiredModules();
            $this->prepareResult();
            $this->SetResultCacheKeys(["POSITION"]);
            $this->IncludeComponentTemplate();
        }
	}
    
    /**
     * Подклучение модулей
     *
     * @return void
     * 
     */
    protected function checkRequiredModules(): void
    {
        if (!CModule::IncludeModule("iblock")) {
            ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        }
        if (!CModule::IncludeModule("support")) {
            ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        }
    }

    /**
     * Подготовка данных для вставки.
     *
     * @return string
     * 
     */
    public function loadAction(): string
    {
        $this->checkRequiredModules();
        $this->prepareResult();

        return json_encode([
            'data' => $this->arResult,
        ]);
    }

    /**
     * Событие создания тикета
     *
     * @param array $fields
     * 
     * @return string
     * 
     */
    public function sendTicketAction(array $fields): string
    {
        $this->checkRequiredModules();
        $this->sendTicket($fields);

        return json_encode([
            'ticket_id' => $this->ticketId,
        ]);
    }

    /**
     * Получение нужных данных о пользователе
     *
     * @return void
     * 
     */
    public function prepareResult(): void
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

    /**
     * Выбираем нужный пресет обращения
     *
     * @param array $fields
     * 
     * @return array
     * 
     */
    private function prepareFields(array $fields): array
    {
        $arFields = $this->getFields($fields);

        switch ($fields['TICKET_TYPE']) {
            case self::TICKET_TYPES['REFUND_ORDER']:
                $result = $arFields[self::TICKET_TYPES['REFUND_ORDER']];
                break;
            case self::TICKET_TYPES['SUPPORT']:
                $result = $arFields[self::TICKET_TYPES['SUPPORT']];
                break;
            case self::TICKET_TYPES['CHANGE_MENTOR']:
                $result = $arFields[self::TICKET_TYPES['CHANGE_MENTOR']];
                break;
            case self::TICKET_TYPES['OTHER']:
                $result = $arFields[self::TICKET_TYPES['OTHER']];
                break;
            default:
                $result = $arFields[self::TICKET_TYPES['OTHER']];
                break;
        }

        return $result;
    }

    /**
     * Пресеты тикетов
     * Примечание: Текст прижат к левому краю для избежания пробелов в текстовом окне в обращении
     *
     * @param array $fields
     * 
     * @return array
     * 
     */
    private function getFields(array $fields): array
    {
        return [
            self::TICKET_TYPES['REFUND_ORDER'] => [
               'TITLE' => 'Создано обращение по возврату товара',
               'MESSAGE' => 'Возврат заказа № ' . $fields['ORDER_NUMBER'] . '
С коментарием: ' . $fields['MESSAGE'],
               'OWNER_SID' => $fields['EMAIL'],
               'CATEGORY_SID' => self::TICKET_TYPES['REFUND_ORDER'],
               'CRITICALITY_SID' => '',
               'STATUS_SID' => '',
               'MARK_ID' => '',
               'RESPONSIBLE_USER_ID' => '',
               'UF_DATA' => '',
               'UF_ACCEPT_REQUEST' => '',
            ],
            self::TICKET_TYPES['SUPPORT'] => [
               'TITLE' => 'Создано обращение по поводу нерабочего функционала',
               'MESSAGE' => $fields['MESSAGE'],
               'OWNER_SID' => $fields['EMAIL'],
               'CATEGORY_SID' => self::TICKET_TYPES['REFUND_ORDER'],
               'CRITICALITY_SID' => '',
               'STATUS_SID' => '',
               'MARK_ID' => '',
               'RESPONSIBLE_USER_ID' => '',
               'UF_DATA' => '',
               'UF_ACCEPT_REQUEST' => '',
            ],
            self::TICKET_TYPES['CHANGE_MENTOR'] => [
               'TITLE' => 'Создано обращение по поводу смены наставника',
               'MESSAGE' => 'Пользователь желает сменить наставника по причине "' . $fields['COUSES'] . '
ID старого наставника: ' . $fields['MENTOR_ID'] . '
ID нового наставника: ' . $fields['NEW_MENTOR_ID'] . '.',
               'OWNER_SID' => $fields['EMAIL'],
               'CATEGORY_SID' => self::TICKET_TYPES['REFUND_ORDER'],
               'CRITICALITY_SID' => '',
               'STATUS_SID' => '',
               'MARK_ID' => '',
               'RESPONSIBLE_USER_ID' => '',
               'UF_DATA' => '',
               'UF_ACCEPT_REQUEST' => '',
            ],
            self::TICKET_TYPES['OTHER'] => [
               'TITLE' => 'Создано обращение с пометкой "Другое"',
               'MESSAGE' => $fields['MESSAGE'],
               'OWNER_SID' => $fields['EMAIL'],
               'CATEGORY_SID' => self::TICKET_TYPES['REFUND_ORDER'],
               'CRITICALITY_SID' => '',
               'STATUS_SID' => '',
               'MARK_ID' => '',
               'RESPONSIBLE_USER_ID' => '',
               'UF_DATA' => '',
               'UF_ACCEPT_REQUEST' => '',
            ],
        ];
    }
}
