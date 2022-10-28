<?php

namespace QSoft\Service;

use Bitrix\Main\ORM\Data\UpdateResult;
use Bitrix\Main\ORM\Entity;
use Bitrix\Main\ORM\Query\Filter\ConditionTree;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\ORM\Query\Query;
use QSoft\Entity\User;
use QSoft\ORM\NotificationTable;
use \Bitrix\Main\ORM\Fields\IntegerField;
use \Bitrix\Main\ORM\Fields\StringField;
use \Bitrix\Main\ORM\Fields\Relations\Reference;
use \Bitrix\Main\ORM\Fields\ExpressionField;

class NotificationService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function getUnreadNotify(): int
    {
        return NotificationTable::getList([
            'filter' => [
                'UF_USER_ID' => $userId,
                'UF_STATUS' => 'NOTIFICATION_STATUS_UNREAD',
            ],
        ])->getSelectedRowsCount();
    }

    public function getNotifications(array $filter, int $offset = null, int $limit = null): array
    {
        return NotificationTable::getList([
            'select' => [
                'ID',
                'TITLE' => 'UF_TITLE',
                'MESSAGE' => 'UF_MESSAGE',
                'LINK' => 'UF_LINK',
                'STATUS' => 'STATUS_NAME.VALUE',
                'DATE',
                'TIME',
            ],
            'filter' => self::createCondition($filter),
            'offset' => $offset,
            'limit' => $limit,
            'order' => ["UF_DATE_TIME" => "desc"],
            'runtime' => [
                (new Reference(
                    'STATUS_NAME',
                    self::getUserFieldEnumTable(),
                    Join::on('this.UF_STATUS', 'ref.ID')
                )),
                (new ExpressionField(
                    'DATE',
                    'DATE_FORMAT(%s, GET_FORMAT(DATE,\'EUR\'))',
                    ['UF_DATE_TIME']
                )),
                (new ExpressionField(
                    'TIME',
                    'DATE_FORMAT(%s, GET_FORMAT(TIME,\'ISO\'))',
                    ['UF_DATE_TIME']
                )),
                //Поле для фильтрации вывода уведомлений пользователя за последние X дней: DATE_DIFF <= X дней'
                (new ExpressionField(
                    'DATE_DIFF',
                    'DATEDIFF(CURDATE(), %s)',
                    ['UF_DATE_TIME']
                ))
            ],
        ])->fetchAll();
    }

    private static function getUserFieldEnumTable(): string
    {
        return Entity::compileEntity('PROPS',
            [
                (new IntegerField('ID'))
                    ->configurePrimary(),
                (new StringField('VALUE')),
            ],
            ['table_name' => 'b_user_field_enum',]
        )->getDataClass();
    }

    private function createCondition(array $filter): ConditionTree
    {
        $condition = Query::filter();
        if ($filter['period']) {
            //Уведомление будет выбрано, если после его создания прошло меньше или столько же дней, сколько в $filter['day_interval']
            $condition->where('DATE_DIFF', '<=', $filter['period']);
        }
        if ($filter['status']) {
            $condition->where('STATUS', $filter['status']);
        }
        return $condition->where('UF_USER_ID', $this->user->id);
    }

    public function has(int $notificationId): bool
    {
        $result = NotificationTable::getRow([
            'select' => ['ID'],
            'filter' => [
                'UF_USER_ID' => $this->user->id,
                'ID' => $notificationId,
            ],
        ]);
        return isset($result) && count($result) == 1;
    }

    public function read(int $notificationId): UpdateResult
    {
        return NotificationTable::update(
            $notificationId,
            ['UF_STATUS' => NotificationTable::STATUSES['read']]
        );
    }

    public function getStatusValueById(int $statusId)
    {
        return \CUserFieldEnum::GetList([], ['ID' => $statusId])->GetNext()['VALUE'];
    }
}
