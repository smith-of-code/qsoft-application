<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true);

use QSoft\Entity\User;
use \Bitrix\Main\ORM\Query\Filter\ConditionTree;
use \Bitrix\Main\ORM\Query\Query;
use \Bitrix\Main\Engine\Contract\Controllerable;
use \Bitrix\Main\Engine\ActionFilter;
use \QSoft\Service\NotificationService;
use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Error;
use \Bitrix\Main\Errorable;
use QSoft\ORM\NotificationTable;

class NotificationListComponent extends CBitrixComponent implements Controllerable, Errorable
{
    private const NOTIFICATIONS_LIMIT = 2;
    protected ErrorCollection $errorCollection;

    public function configureActions()
    {
        return [
            'loadNotifications' => [
                '-prefilters' => [
                    ActionFilter\Csrf::class,
                    ]
                ]
            ];
    }
    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();
    }

    public function executeComponent()
    {
        $this->arResult = $this->loadNotificationsAction();
        $this->includeComponentTemplate();
    }

    public function loadNotificationsAction(array $parameters = []): array
    {
        self::prepareParameters($parameters);
        return self::loadNotificationsData($parameters, self::createFilter($parameters));
    }

    private static function loadNotificationsData(array $parameters, ConditionTree $filter): array
    {
        $notificationTable = (new User())->notification->getDataClass();
        $notifications = $notificationTable::getList([
                'select' => [
                    'ID',
                    'TITLE' => 'UF_TITLE',
                    'STATUS' => 'STATUS_NAME.VALUE',
                    'TEXT' => 'UF_MESSAGE',
                    'LINK' => 'UF_LINK',
                    'DATE',
                    'TIME',
                ],
                'filter' => $filter,
                'offset' => $parameters['offset'],
                'limit' => $parameters['limit'],
                'order' => ["UF_DATE_TIME" => "desc"]
            ]
        )->fetchAll();
        return [
            'NOTIFICATIONS' => $notifications,
            'OFFSET' => $parameters['offset'] + count($notifications),
        ];
    }

    private static function prepareParameters(array &$parameters): void
    {
        if(empty($parameters)) {
            $parameters['offset'] = 0;
            $parameters['limit'] = self::NOTIFICATIONS_LIMIT;
            return;
        }
        if(!$parameters['offset']) {
            $parameters['limit'] = $parameters['size'];
        } else {
            $parameters['limit'] = self::NOTIFICATIONS_LIMIT;
        }
    }

    private static function createFilter(array $filterParameters): ConditionTree
    {
        $filter = Query::filter();
        if($filterParameters['filter']['day_interval']) {
            $filter->where('DATE_DIFF', '<=', $filterParameters['filter']['day_interval']);
        }
        if($filterParameters['filter']['status']) {
            $filter->where('STATUS', $filterParameters['filter']['status']);
        }

        $filter->where('UF_USER_ID', (new User())->id);

        return $filter;
    }

    public function readMessageAction(int $messageId): array
    {
        $service = new NotificationService(new User());
        if (! $service->has($messageId)) {
            $this->errorCollection[] = new Error(Loc::getMessage('NOTIFICATION_NOT_FOUND'));
            return [];
        }
        $newStatusXmlId = NotificationTable::STATUSES['read'];
        $newStatusResult = NotificationTable::update(
            $messageId,
            ['UF_STATUS' => $newStatusXmlId]
        );
        if ($newStatusResult->isSuccess()) {
            return ['status' => CUserFieldEnum::GetList([], ['XML_ID' => $newStatusXmlId])->Fetch()['VALUE']];
        } else {
            $this->errorCollection = $newStatusResult->getErrorCollection();
            return [];
        }
    }

    public function getErrors()
    {
        return $this->errorCollection->toArray();
    }

    public function getErrorByCode($code)
    {
        return $this->errorCollection->getErrorByCode($code);
    }
}
