<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true);

use QSoft\Entity\User;
use \Bitrix\Main\ORM\Query\Filter\ConditionTree;
use \Bitrix\Main\ORM\Query\Query;
use \Bitrix\Main\Engine\Contract\Controllerable;
use \Bitrix\Main\Engine\ActionFilter;
?>

<?php

class NotificationListComponent extends CBitrixComponent implements Controllerable
{
    private const NOTIFICATIONS_LIMIT = 2;

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
        $notificationTable = (new User())->notification::getDataClass();
        $notifications = $notificationTable::getList([
                'select' => [
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
            $parameters['limit'] = max($parameters['size'], self::NOTIFICATIONS_LIMIT);
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
}
