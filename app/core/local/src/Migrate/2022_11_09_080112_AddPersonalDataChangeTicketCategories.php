<?php

use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use QSoft\Migration\Migration;

class AddPersonalDataChangeTicketCategories extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $this->initModule();

        $categories = [
            [
                "C_TYPE" => "C",
                "SID" => "CHANGE_OF_LEGAL_ENTITY_DATA",
                "SET_AS_DEFAULT" => "N",
                "C_SORT" => "100",
                "NAME" => "Изменение юридических данных",
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
                "SID" => "CHANGE_MENTOR",
                "SET_AS_DEFAULT" => "N",
                "C_SORT" => "100",
                "NAME" => "Смена ментора",
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
    public function down(): void
    {
        $this->initModule();
        
        $arrayFilter = ['CHANGE_OF_LEGAL_ENTITY_DATA', 'CHANGE_MENTOR'];

        $DBResult = CTicketDictionary::GetList([],[],['SID' => implode('|',$arrayFilter)]);

        while ($catecory = $DBResult->GetNext()) {
           CTicketDictionary::delete($catecory['ID'], 'N');
        }
    }

    /**
     * @return void
     * @throw SystemException
     */
    private function initModule(): void
    {
        if (!Loader::includeModule('support')) {
            throw new SystemException('Не подключен модуль ТП');
        }
    }
}
