<?php

use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use QSoft\Migration\Migration;

class NewCategoryForTechSupport extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->initModule();

        $categories = [
            [
                "C_TYPE" => "C",
                "SID" => "REGISTRATION",
                "SET_AS_DEFAULT" => "N",
                "C_SORT" => "100",
                "NAME" => "Регистрация",
                "DESCR" => "",
                "RESPONSIBLE_USER_ID" => "1",
                "EVENT1" => "",
                "EVENT2" => "",
                "EVENT3" => "",
                'arrSITE' => [
                    "s1"
                ]
            ],
		    [
                "C_TYPE" => "C",
                "SID" => "SUPPORT",
                "SET_AS_DEFAULT" => "N",
                "C_SORT" => "100",
                "NAME" => "Техподдержка",
                "DESCR" => "",
                "RESPONSIBLE_USER_ID" => "1",
                "EVENT1" => "",
                "EVENT2" => "",
                "EVENT3" => "",
                'arrSITE' => [
                    "s1"
                ]
            ],
            [
                "C_TYPE" => "C",
                "SID" => "CHANGE_OF_PERSONAL_DATA",
                "SET_AS_DEFAULT" => "N",
                "C_SORT" => "100",
                "NAME" => "Изменение личных данных",
                "DESCR" => "",
                "RESPONSIBLE_USER_ID" => "1",
                "EVENT1" => "",
                "EVENT2" => "",
                "EVENT3" => "",
                'arrSITE' => [
                    "s1"
                ]
            ],
            [
                "C_TYPE" => "C",
                "SID" => "CHANGE_ROLE",
                "SET_AS_DEFAULT" => "N",
                "C_SORT" => "100",
                "NAME" => "Смена роли",
                "DESCR" => "",
                "RESPONSIBLE_USER_ID" => "1",
                "EVENT1" => "",
                "EVENT2" => "",
                "EVENT3" => "",
                'arrSITE' => [
                    "s1"
                ]
            ],
        ];

        foreach ($categories as $categoryFields) {
           CTicketDictionary::Add($categoryFields);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $arrayFilter = ['CHANGE_ROLE', 'CHANGE_OF_PERSONAL_DATA', 'SUPPORT', 'REGISTRATION'];

        $DBResult = CTicketDictionary::GetList([],[],['SID' => implode('|',$arrayFilter)]);

        while ($catecory = $DBResult->GetNext()) {
           CTicketDictionary::delete($catecory['ID'], 'N');
        }
    }

    private function initModule()
    {
        if (!Loader::includeModule('support')) {
            throw new SystemException('Не подключен модуль ТП');
        }
    }
}
