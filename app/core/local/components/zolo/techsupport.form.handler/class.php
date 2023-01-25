<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\UserTable;
use QSoft\Entity\User;


/**
 * Компонент контроля форм обращения в тех поддержку.
 */
class TechsupportFormHandlerComponent extends CBitrixComponent implements Controllerable
{
    /**
     * TICKET_TYPES категории обращений
     *
     * @var array
     */
    private const TICKET_TYPES = [
        'CHANGE_OF_PERSONAL_DATA' => 'CHANGE_OF_PERSONAL_DATA',
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
            'sendTicket' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
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
        $ticketId = $this->createTicket($fields);

        return json_encode([
            'ticket_id' => $ticketId,
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
        if($user->isAuthorized) {
            $this->arResult['EMAIL'] = $user->email;
            $this->arResult['ID'] = $user->id;
            $this->arResult['MENTHOR_ID'] = $user->getMentor()->id ?? false;
            $this->arResult['NAME'] = $user->name;
            $this->arResult['LAST_NAME'] = $user->lastName;
            $this->arResult['SECOND_NAME'] = $user->secondName;
            $this->arResult['BIRTH_DATE'] = $user->birthday;
        }
    }

    public function createTicket($fields)
    {
        $arFields = $this->prepareFields($fields);
        $mid = 0;
        return (new CTicket())->set($arFields, $mid, '', 'N');
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
        $user = new User();
        $arFields = $this->getFields($fields);

        switch ($fields['TICKET_TYPE']) {
            case self::TICKET_TYPES['CHANGE_OF_PERSONAL_DATA']:
                $result = $arFields[self::TICKET_TYPES['CHANGE_OF_PERSONAL_DATA']];
                break;
            case self::TICKET_TYPES['REFUND_ORDER']:
                $result = $arFields[self::TICKET_TYPES['REFUND_ORDER']];
                break;
            case self::TICKET_TYPES['SUPPORT']:
                $result = $arFields[self::TICKET_TYPES['SUPPORT']];
                break;
            case self::TICKET_TYPES['CHANGE_MENTOR']:
                if ((int)$fields['NEW_MENTOR_ID'] === $user->id) {
                    throw new Exception('ID нового наставника совпадает с вашим');
                }
                try {
                    $mentor = new User($fields['NEW_MENTOR_ID']);
                } catch (RuntimeException $e) {
                    throw new Exception('Такого пользователя не существует');
                }
                if (!$mentor->active || !$mentor->groups->isConsultant() || in_array($mentor->id, $user->beneficiariesService->getTeamIds())) {
                    throw new Exception('Указанный пользователь не может быть Вашим наставником');
                }

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
        $user = new User();
        $data = [
            'NAME' => $fields['NAME'],
            'LAST_NAME' => $fields['LAST_NAME'],
            'SECOND_NAME' => $fields['SECOND_NAME'],
            'PERSONAL_BIRTHDAY' => $fields['PERSONAL_BIRTHDAY'],
            'MESSAGE' => $fields['MESSAGE'],
            'USER_ID' => $user->id,
        ];

        if ($fields['PERSONAL_PHOTO']) {
            $data['PERSONAL_PHOTO'] = CFile::MakeFileArray($fields['PERSONAL_PHOTO']);
        }

        return [
            self::TICKET_TYPES['CHANGE_OF_PERSONAL_DATA'] => [
                'TITLE' => 'Заявка на смену персональных данных',
                'MESSAGE' => 'Пользователь желает сменить персональные данные.
Комментарий: ' . $fields['MESSAGE'] . '.',
                'OWNER_SID' => $fields['EMAIL'],
                'CATEGORY_SID' => self::TICKET_TYPES['CHANGE_OF_PERSONAL_DATA'],
                'CRITICALITY_SID' => '',
                'STATUS_SID' => '',
                'MARK_ID' => '',
                'RESPONSIBLE_USER_ID' => '',
                'OWNER_USER_ID' => $user->id,
                'CREATED_USER_ID' => $user->id,
                'UF_DATA' => json_encode($data),
                'UF_ACCEPT_REQUEST' => '',
            ],
            self::TICKET_TYPES['REFUND_ORDER'] => [
               'TITLE' => 'Создано обращение по возврату товара',
               'MESSAGE' => 'Возврат заказа № ' . $fields['ORDER_NUMBER'] . '
С комментарием: ' . $fields['MESSAGE'],
               'OWNER_SID' => $fields['EMAIL'],
               'CATEGORY_SID' => self::TICKET_TYPES['REFUND_ORDER'],
               'OWNER_USER_ID' => $user->id,
               'CREATED_USER_ID' => $user->id,
               'CRITICALITY_SID' => '',
               'STATUS_SID' => '',
               'MARK_ID' => '',
               'RESPONSIBLE_USER_ID' => '',
               'UF_DATA' => json_encode( [
                            'IS_ORDER_REFUND' => true,
                            'ORDER_NUMBER' => $fields['ORDER_NUMBER'],
                            'MESSAGE' => $fields['MESSAGE'],
                            'USER_ID' => $user->id,
                        ]
                    ),
               'UF_ACCEPT_REQUEST' => '',
            ],
            self::TICKET_TYPES['SUPPORT'] => [
               'TITLE' => 'Создано обращение по поводу нерабочего функционала',
               'MESSAGE' => $fields['MESSAGE'],
               'OWNER_SID' => $fields['EMAIL'],
               'CATEGORY_SID' => self::TICKET_TYPES['SUPPORT'],
               'CRITICALITY_SID' => '',
               'STATUS_SID' => '',
               'MARK_ID' => '',
               'OWNER_USER_ID' => $user->id,
               'CREATED_USER_ID' => $user->id,
               'RESPONSIBLE_USER_ID' => '',
               'UF_DATA' => '',
               'UF_ACCEPT_REQUEST' => '',
            ],
            self::TICKET_TYPES['CHANGE_MENTOR'] => [
               'TITLE' => 'Создано обращение по поводу смены наставника',
               'MESSAGE' => 'Пользователь желает сменить наставника по причине "' . $fields['COUSES'] . '
ID старого наставника: ' . $user->mentorId . '
ID нового наставника: ' . $fields['NEW_MENTOR_ID'] . '.
Комментарий: ' . $fields['MESSAGE'] . '.'
,
               'OWNER_SID' => $fields['EMAIL'],
               'CATEGORY_SID' => self::TICKET_TYPES['CHANGE_MENTOR'],
               'CRITICALITY_SID' => '',
               'STATUS_SID' => '',
               'MARK_ID' => '',
               'RESPONSIBLE_USER_ID' => '',
               'OWNER_USER_ID' => $user->id,
               'CREATED_USER_ID' => $user->id,
               'UF_DATA' => json_encode([
                        'OLD_MENTOR_ID' => $user->mentorId,
                        'NEW_MENTOR_ID' => $fields['NEW_MENTOR_ID'],
                        'COUSES' => $fields['COUSES'],
                        'MESSAGE' => $fields['MESSAGE'],
                        'USER_ID' => $user->id,
                    ]
                ),
               'UF_ACCEPT_REQUEST' => '',
            ],
            self::TICKET_TYPES['OTHER'] => [
               'TITLE' => 'Создано обращение с пометкой "Другое"',
               'MESSAGE' => $fields['MESSAGE'],
               'OWNER_SID' => $fields['EMAIL'],
               'CATEGORY_SID' => self::TICKET_TYPES['OTHER'],
               'CRITICALITY_SID' => '',
               'STATUS_SID' => '',
               'MARK_ID' => '',
               'RESPONSIBLE_USER_ID' => '',
               'OWNER_USER_ID' => $user->id,
               'CREATED_USER_ID' => $user->id,
               'UF_DATA' => '',
               'UF_ACCEPT_REQUEST' => '',
            ],
        ];
    }
}
