<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateBeneficiaryTable extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'Beneficiary',
        'TABLE_NAME' => 'beneficiary',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'Получатели выгоды от покупок (менторы)',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_USER_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_USER_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'ID пользователя'],
            'LIST_COLUMN_LABEL' => ['ru' => 'ID пользователя'],
            'LIST_FILTER_LABEL' => ['ru' => 'ID пользователя'],
        ],
        [
            'FIELD_NAME' => 'UF_BENEFICIARY_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_BENEFICIARY_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'ID получателя выгоды'],
            'LIST_COLUMN_LABEL' => ['ru' => 'ID получателя выгоды'],
            'LIST_FILTER_LABEL' => ['ru' => 'ID получателя выгоды'],
        ],
    ];

}