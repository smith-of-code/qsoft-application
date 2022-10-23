<?php

namespace QSoft\Service;

use Bitrix\Main\ORM\Entity;
use Bitrix\Main\ORM\Query\Join;
use QSoft\Entity\User;
use QSoft\ORM\NotificationTable;
use Bitrix\Highloadblock\HighloadblockTable;

use \Bitrix\Main\ORM\Fields;
use \Bitrix\Main\ORM\Fields\Relations\Reference;
use \Bitrix\Main\ORM\Fields\Relations\OneToMany;



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

    public function getDataClass()
    {
        \Bitrix\Main\Loader::includeModule('highloadblock');

        $hlEntity = HighloadBlockTable::compileEntity(HIGHLOAD_BLOCK_HLNOTIFICATION);

        $propsEnumEntity = Entity::compileEntity('PROPS',
            [
                (new Fields\IntegerField('ID'))
                    ->configurePrimary(),

                (new Fields\StringField('VALUE')),

                (new Reference(
                    'NOTIFICATION_STATUS',
                    $hlEntity,
                    Join::on('this.ID', 'ref.UF_STATUS')
                )),

                (new Reference(
                    'NOTIFICATION_TYPE',
                    $hlEntity,
                    Join::on('this.ID', 'ref.UF_TYPE')
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
            (new OneToMany(
                'TYPE_NAME',
                $propsEnumEntity,
                'NOTIFICATION_TYPE'
            ))
        ];

        foreach ($manyToOneFields as $field) {
            $hlEntity->addField($field);
        }

        return $hlEntity->getDataClass();
    }
}