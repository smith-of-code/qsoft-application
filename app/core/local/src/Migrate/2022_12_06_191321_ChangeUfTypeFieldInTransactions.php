<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use QSoft\Migration\Migration;

class ChangeUfTypeFieldInTransactions extends Migration
{
    private array $enumValues = [
        'from' => [
            'n1' => [
                'XML_ID' => 'TRANSACTION_TYPE_PURCHASE',
                'VALUE' => 'покупка',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'TRANSACTION_TYPE_INVITE',
                'VALUE' => 'приглашение',
                'DEF' => 'N',
                'SORT' => 20,
            ],
            'n3' => [
                'XML_ID' => 'TRANSACTION_TYPE_REFERRAL',
                'VALUE' => 'переход',
                'DEF' => 'N',
                'SORT' => 30,
            ],
            'n4' => [
                'XML_ID' => 'TRANSACTION_TYPE_UPGRADE',
                'VALUE' => 'повышение уровня',
                'DEF' => 'N',
                'SORT' => 40,
            ],
        ],
        'to' => [
            'n1' => [
                'XML_ID' => 'TRANSACTION_TYPE_GROUP_PURCHASE',
                'VALUE' => 'Покупка группы',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'TRANSACTION_TYPE_PURCHASE',
                'VALUE' => 'Личная покупка',
                'DEF' => 'N',
                'SORT' => 20,
            ],
            'n3' => [
                'XML_ID' => 'TRANSACTION_TYPE_PURCHASE_WITH_PERSONAL_PROMOTION',
                'VALUE' => 'Покупка товара по персональной акции',
                'DEF' => 'N',
                'SORT' => 30,
            ],
            'n4' => [
                'XML_ID' => 'TRANSACTION_TYPE_REFERRAL',
                'VALUE' => 'Приглашение консультанта',
                'DEF' => 'N',
                'SORT' => 40,
            ],
            'n5' => [
                'XML_ID' => 'TRANSACTION_TYPE_UPGRADE_TO_K2',
                'VALUE' => 'Переход на K2',
                'DEF' => 'N',
                'SORT' => 50,
            ],
            'n6' => [
                'XML_ID' => 'TRANSACTION_TYPE_UPGRADE_TO_K3',
                'VALUE' => 'Переход на K3',
                'DEF' => 'N',
                'SORT' => 60,
            ],
            'n7' => [
                'XML_ID' => 'TRANSACTION_TYPE_HOLD_ON_K3',
                'VALUE' => 'Удержание на K3',
                'DEF' => 'N',
                'SORT' => 70,
            ],
        ],
    ];

    public function up()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }
        $userFieldEnum = new CUserFieldEnum;
        $userTypeEntity = new CUserTypeEntity;

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['TABLE_NAME' => 'transaction']]);

        $fieldId = $userTypeEntity->GetList([], [
            'ENTITY_ID' => "HLBLOCK_$hlBlock[ID]",
            'FIELD_NAME' => 'UF_TYPE',
        ])->Fetch()['ID'];

        $userFieldEnum->DeleteFieldEnum($fieldId);
        $userFieldEnum->SetEnumValues($fieldId, $this->enumValues['to']);
    }

    public function down()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }
        $userFieldEnum = new CUserFieldEnum;
        $userTypeEntity = new CUserTypeEntity;

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['TABLE_NAME' => 'transaction']]);

        $fieldId = $userTypeEntity->GetList([], [
            'ENTITY_ID' => "HLBLOCK_$hlBlock[ID]",
            'FIELD_NAME' => 'UF_TYPE',
        ])->Fetch()['ID'];

        $userFieldEnum->DeleteFieldEnum($fieldId);
        $userFieldEnum->SetEnumValues($fieldId, $this->enumValues['from']);
    }

}