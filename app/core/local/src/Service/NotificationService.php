<?php

namespace QSoft\Service;

use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Entity;
use Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\ORM\Query\Join;
use QSoft\Entity\User;
use QSoft\ORM\NotificationTable;
use \Bitrix\Main\ORM\Fields\IntegerField;
use \Bitrix\Main\ORM\Fields\StringField;
use \Bitrix\Main\ORM\Fields\Relations\Reference;
use \Bitrix\Main\ORM\Fields\Relations\OneToMany;
use \Bitrix\Main\Entity\ExpressionField;

Loader::includeModule('highloadblock');

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

    /**
     * @return DataManager|string
     */
    public function getDataClass(): string
    {
        $hlEntity = NotificationTable::getEntity();

        $propsEnumEntity = Entity::compileEntity('PROPS',
            [
                (new IntegerField('ID'))
                    ->configurePrimary(),

                (new StringField('VALUE')),

                (new Reference(
                    'NOTIFICATION_STATUS',
                    $hlEntity,
                    Join::on('this.ID', 'ref.UF_STATUS')
                )),
            ],
            [
                'namespace' => 'NotificationsListEnumEntity',
                'table_name' => 'b_user_field_enum',
            ]);

        $manyToOneFields = [
            (new OneToMany(
                'STATUS_NAME',
                $propsEnumEntity,
                'NOTIFICATION_STATUS'
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
        ];

        foreach ($manyToOneFields as $field) {
            $hlEntity->addField($field);
        }

        return $hlEntity->getDataClass();
    }

    /**
     * @return EntityObject|false
     */
    public function getById(int $notificationId)
    {
        $notification = NotificationTable::getList([
            'select' => ['ID', 'UF_STATUS'],
            'filter' => [
                'UF_USER_ID' => $this->user->id,
                'ID' => $notificationId,
            ],
        ])->fetchObject();
        return $notification && $notification->isFilled('ID') ? $notification : false;
    }

    public function getPropValueById(int $propertyId): string
    {
        $propsEnumEntity = Entity::compileEntity('PROPS',
            [
                (new IntegerField('ID'))
                    ->configurePrimary(),
                (new StringField('VALUE')),
            ],
            [
                'namespace' => 'NotificationsListEnumEntity',
                'table_name' => 'b_user_field_enum',
            ]);

        return $propsEnumEntity->getDataClass()::getRow([
            'select' => ['ID', 'VALUE'],
            'filter' => ['ID' => $propertyId]
        ])['VALUE'];
    }
}