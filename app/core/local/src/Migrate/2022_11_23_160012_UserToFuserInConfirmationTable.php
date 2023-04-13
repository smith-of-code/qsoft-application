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
use Illuminate\Database\Schema\Blueprint;

class UserToFuserInConfirmationTable extends Migration
{
    public function up()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }
        $userTypeEntity = new CUserTypeEntity;

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['TABLE_NAME' => 'confirmation']]);

        $fieldId = $userTypeEntity->GetList([], [
            'ENTITY_ID' => "HLBLOCK_$hlBlock[ID]",
            'FIELD_NAME' => 'UF_USER_ID',
        ])->Fetch()['ID'];
        $userTypeEntity->Delete($fieldId);

        $userTypeEntity->Add([
            'ENTITY_ID' => "HLBLOCK_$hlBlock[ID]",
            'FIELD_NAME' => 'UF_FUSER_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_FUSER_ID',
            'SORT' => 100,
            'MULTIPLE' => 'N',
            'SHOW_FILTER' => 'I',
            'IS_SEARCHABLE' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'FUser ID'],
            'LIST_COLUMN_LABEL' => ['ru' => 'FUser ID'],
            'LIST_FILTER_LABEL' => ['ru' => 'FUser ID'],
        ]);
    }

    public function down()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }
        $userTypeEntity = new CUserTypeEntity;

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['TABLE_NAME' => 'confirmation']]);

        $fieldId = $userTypeEntity->GetList([], [
            'ENTITY_ID' => "HLBLOCK_$hlBlock[ID]",
            'FIELD_NAME' => 'UF_FUSER_ID',
        ])->Fetch()['ID'];
        $userTypeEntity->Delete($fieldId);

        $userTypeEntity->Add([
            'ENTITY_ID' => "HLBLOCK_$hlBlock[ID]",
            'FIELD_NAME' => 'UF_USER_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_USER_ID',
            'SORT' => 100,
            'MULTIPLE' => 'N',
            'SHOW_FILTER' => 'I',
            'IS_SEARCHABLE' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'ID пользователя'],
            'LIST_COLUMN_LABEL' => ['ru' => 'ID пользователя'],
            'LIST_FILTER_LABEL' => ['ru' => 'ID пользователя'],
        ]);
    }

}